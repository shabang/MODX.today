<?php

/**
 * moreGallery Service Class
 * @package moreGallery
 */
class moreGallery {
    public $version = '1.3.0-rc1';

    public $cacheOptions = array(
        xPDO::OPT_CACHE_KEY => 'moregallery'
    );

    /** @var modX */
    public $modx;

    /** @var bool|modContext  */
    public $wctx = false;

    public $debug = false;

    public $chunks = array();

    protected $_resources = array();

    /**
     * @param \modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = array()) {
        $this->modx =& $modx;

        if (isset($config['resource']) && is_numeric($config['resource']))
        {
            $resource = $this->getResource($config['resource']);
            if ($resource instanceof modResource)
            {
                $this->setWorkingContext($resource->get('context_key'));
            }
        }

        $basePath = $this->modx->getOption('moregallery.core_path', $config, $this->modx->getOption('core_path').'components/moregallery/');
        $assetsUrl = $this->modx->getOption('moregallery.assets_url', $config, $this->modx->getOption('assets_url').'components/moregallery/');
        $assetsPath = $this->modx->getOption('moregallery.assets_path', $config, $this->modx->getOption('assets_path').'components/moregallery/');
        $this->config = array_merge(array(
            'base_bath' => $basePath,
            'core_path' => $basePath,
            'model_path' => $basePath.'model/',
            'processors_path' => $basePath.'processors/',
            'elements_path' => $basePath.'elements/',
            'templates_path' => $basePath.'templates/',
            'assets_path' => $assetsPath,
            'js_url' => $assetsUrl.'js/',
            'css_url' => $assetsUrl.'css/',
            'assets_url' => $assetsUrl,
            'connector_url' => $assetsUrl.'connector.php',

            'source' => $this->getOption('moregallery.source', null, $this->modx->getOption('default_media_source'), true),
            'source_relative_url' => $this->getOption('moregallery.source_relative_url', null, 'assets/galleries/'),
            'content_position' => $this->getOption('moregallery.content_position', null, 'above'),
            'crops' => $this->getOption('moregallery.crops', null, ''),
            'use_rte_for_images' => $this->getOption('moregallery.use_rte_for_images', null, true),
            'memory_limit' => $this->_getMemoryLimit(),

            'version_string' => '?mgv=' . $this->version,
        ),$config);

        $modelPath = $this->config['model_path'];

        $this->modx->addPackage('moregallery', $modelPath);
        $this->modx->lexicon->load('moregallery:default');

        $this->modx->loadClass('mgResource', $modelPath.'moregallery/');
        $this->modx->loadClass('mgImage', $modelPath.'moregallery/');

        $this->debug = $this->getOption('moregallery.debug', null, false);
    }

    /**
     * Grabs the setting by its key, looking at the current working context (see setWorkingContext) first.
     *
     * @param $key
     * @param null $options
     * @param null $default
     * @return mixed
     */
    public function getOption($key, $options = null, $default = null)
    {
        if ($this->wctx) {
            return $this->wctx->getOption($key, $default, $options);
        }
        return $this->modx->getOption($key, $options, $default);
    }

    /**
     * Set the internal working context for grabbing context-specific options.
     *
     * @param $key
     * @return bool|modContext
     */
    public function setWorkingContext($key)
    {
        if ($key instanceof modResource)
        {
            $key = $key->get('context_key');
        }

        if (empty($key))
        {
            return false;
        }

        $this->wctx = $this->modx->getContext($key);
        if (!$this->wctx) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error loading working context ' . $key, '', __METHOD__, __FILE__, __LINE__);
            return false;
        }

        return $this->wctx;
    }

    /**
     * Gets a list of id => tag
     *
     * @return array|mixed
     */
    public function getTagIds() {
        $tagNames = $this->modx->cacheManager->get('tags/ids', $this->cacheOptions);
        if (empty($tagNames)) {
            $tagNames = array();
            foreach ($this->modx->getIterator('mgTag') as $tag) {
                /** @var mgTag $tag */
                $tagNames[$tag->get('id')] = $tag->get('display');
            }
            $this->modx->cacheManager->set('tags/ids', $tagNames, 0, $this->cacheOptions);
        }
        return $tagNames;
    }

    /**
    * Gets a Chunk and caches it; also falls back to file-based templates
    * for easier debugging.
    *
    * @author Shaun McCormick
    * @access public
    * @param string $name The name of the Chunk
    * @param array $properties The properties for the Chunk
    * @return string The processed content of the Chunk
    */
    public function getChunk($name,$properties = array()) {
        $chunk = null;
        if (!isset($this->chunks[$name])) {
            $chunk = $this->modx->getObject('modChunk',array('name' => $name),true);
            if (empty($chunk)) {
                $chunk = $this->_getTplChunk($name);
                if ($chunk == false) return false;
            }
            $this->chunks[$name] = $chunk->getContent();
        } else {
            $o = $this->chunks[$name];
            $chunk = $this->modx->newObject('modChunk');
            $chunk->setContent($o);
        }
        $chunk->setCacheable(false);
        return $chunk->process($properties);
    }

    /**
    * Returns a modChunk object from a template file.
    *
    * @author Shaun McCormick
    * @access private
    * @param string $name The name of the Chunk. Will parse to name.chunk.tpl
    * @param string $postFix The postfix to append to the name
    * @return modChunk/boolean Returns the modChunk object if found, otherwise
    * false.
    */
    private function _getTplChunk($name,$postFix = '.chunk.tpl') {
        $chunk = false;
        $f = $this->config['elements_path'].'chunks/'.strtolower($name).$postFix;
        if (file_exists($f)) {
            $o = file_get_contents($f);
            /* @var modChunk $chunk */
            $chunk = $this->modx->newObject('modChunk');
            $chunk->set('name',$name);
            $chunk->setContent($o);
        }
        return $chunk;
    }

    /**
     * @return int|string
     */
    private function _getMemoryLimit()
    {
        try {
            $limit = @ini_get('memory_limit');
            if ( is_numeric( $limit ) ) {
                $memoryLimit = $limit;
            } else {
                $value_length = strlen( $limit );
                $qty = substr( $limit, 0, $value_length - 1 );
                $unit = strtolower( substr( $limit, $value_length - 1 ) );
                switch ( $unit ) {
                    case 'k':
                        $qty *= 1024;
                        break;
                    case 'm':
                        $qty *= 1048576;
                        break;
                    case 'g':
                        $qty *= 1073741824;
                        break;
                }
                $memoryLimit = $qty;
            }
        }
        catch (Exception $e) {
            // Pretend nothing happened and assume 24M
            $memoryLimit = 24 * 1048576;
        }

        return $memoryLimit;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function sanitizeFileName($name) {
        $replace = $this->getOption('moregallery.sanitize_replace', null, '_');
        $pattern = $this->getOption('moregallery.sanitize_pattern', null, '/([[:alnum:]_\.-]*)/');
        $name = str_replace(str_split(preg_replace($pattern, $replace, $name)), $replace, $name);
        return $name;
    }

    /**
     * @param modResource|null $resource
     * @return array
     */
    public function getCrops($resource = null)
    {
        $crops = false;
        if ($resource instanceof modResource)
        {
            $crops = $resource->getProperty('crops', 'moregallery', 'inherit');
        }

        if (empty($crops) || $crops == 'inherit')
        {
            $crops = $this->getOption('moregallery.crops', null, '');
        }
        return $this->parseCrops($crops);
    }

    /**
     * Grab information about a specific crop by its key
     *
     * @param $crop
     * @return bool|array
     */
    public function getCropInfo($crop)
    {
        $crops = $this->getCrops();
        if (isset($crops[$crop])) return $crops[$crop];
        return false;
    }

    /**
     * @param $cropString
     * @return array
     */
    public function parseCrops($cropString)
    {
        $crops = array();
        // Each different crop is separated by a | sign
        $cropString = array_map('trim', explode('|', $cropString));
        foreach ($cropString as $crop)
        {
            if (empty($crop)) continue;

            list ($name, $options) = explode(':', $crop);
            $opts = explode(',', $options);
            array_map('trim', $opts);

            $crops[$name] = array();

            foreach ($opts as $opt) {
                list ($key, $value) = explode('=', $opt);
                if (!empty($key)) {
                    $crops[$name][trim($key)] = trim($value);
                }
            }
        }
        return $crops;
    }

    /**
     * Grabs the resource specified by ID, cached locally if necessary.
     *
     * @param int $id
     * @return mixed
     */
    public function getResource($id = 0)
    {
        if (!isset($this->_resources[$id]))
        {
            $this->_resources[$id] = $this->modx->getObject('mgResource', $id);
        }
        return $this->_resources[$id];
    }
}
