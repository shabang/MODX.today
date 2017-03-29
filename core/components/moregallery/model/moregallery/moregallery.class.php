<?php
$alpackaPath = MODX_CORE_PATH . 'components/alpacka/';
$loaderPath = $alpackaPath . 'vendor/autoload.php';

if (file_exists($loaderPath)) {
    require_once $loaderPath;
}
else {
    global $modx;
    $modx->log(modX::LOG_LEVEL_ERROR, 'UNABLE TO INSTANTIATE MOREGALLERY SERVICE CLASS due to missing autoloader, expected in ' . $loaderPath . ' - make sure Alpacka is installed and up to date.');
    class moreGallery {
        public function __toString()
        {
            return 'Unable to instantiate MoreGallery due to missing autoloader - make sure Alpacka is installed and up to date.';
        }
    }
    return;
}

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

/**
 * moreGallery Service Class
 * @package moreGallery
 */
class moreGallery extends \modmore\Alpacka\Alpacka {
    protected $namespace = 'moregallery';
    public $cacheOptions = array(
        xPDO::OPT_CACHE_KEY => 'moregallery'
    );
    public $debug = false;
    protected $_resources = array();
    protected $_memoryLimitIncreased = false;
    protected $_imagine = null;

    /**
     * This array keeps track of renamed file uploads in order to make sure image links don't break when
     * something like FileSluggy is active on the site as well.
     *
     * @var array
     */
    public $renames = array();

    /**
     * moreGallery constructor.
     *
     * @param modX $instance
     * @param array $config
     */
    public function __construct($instance, array $config = array()) {
        parent::__construct($instance, $config);
        $this->setVersion(1, 5, 8, 'pl');

        if (isset($config['resource']) && is_numeric($config['resource']))
        {
            $resource = $this->getResource($config['resource']);
            if ($resource instanceof modResource) {
                $this->setResource($resource);
            }
        }

        $assetsUrl = $this->modx->getOption('moregallery.assets_url', $config, $this->modx->getOption('assets_url').'components/moregallery/');
        $assetsPath = $this->modx->getOption('moregallery.assets_path', $config, $this->modx->getOption('assets_path').'components/moregallery/');
        $this->config = array_merge($this->config, array(
            'templates_path' => $this->config['elements_path'] . 'chunks/',
            'assets_path' => $assetsPath,
            'js_url' => $assetsUrl.'js/',
            'css_url' => $assetsUrl.'css/',

            'source' => $this->getOption('moregallery.source', null, $this->modx->getOption('default_media_source'), true),
            'source_relative_url' => $this->getOption('moregallery.source_relative_url', null, 'assets/galleries/'),
            'content_position' => $this->getOption('moregallery.content_position', null, 'above'),
            'crops' => $this->getOption('moregallery.crops', null, ''),
            'use_rte_for_images' => $this->getOption('moregallery.use_rte_for_images', null, true),
            'memory_limit' => $this->_getMemoryLimit(),
            'permissions' => array(),

            'version_string' => '?mgv=' . $this->version,
        ),$config);

        $permissions = array(
            'view_gallery', 'upload', 'import', 'video', 'resource_settings',
            'image_active', 'image_delete', 'image_edit', 'image_tags', 'image_tags_new', 'image_crop_edit',
        );
        foreach ($permissions as $key) {
            $this->config['permissions'][$key] = $this->modx->context->checkPolicy('moregallery_' . $key);
        }
        $this->config['permissions_json'] = json_encode($this->config['permissions']);

        $modelPath = $this->config['model_path'];

        $this->modx->loadClass('mgResource', $modelPath . 'moregallery/');
        $this->modx->loadClass('mgImage', $modelPath . 'moregallery/');

        $this->debug = $this->getOption('moregallery.debug', null, false);
    }


    /**
     * Loads the Imagick or GD based Imagine service.
     *
     * @return bool|\Imagine\Gd\Imagine|\Imagine\Imagick\Imagine|null
     */
    public function getImagine()
    {
        if ($this->_imagine) {
            return $this->_imagine;
        }

        $classes = array('\Imagine\Imagick\Imagine', 'Imagine\Gd\Imagine');
        if ($this->modx->getOption('moregallery.imagine_prefer_gd', null, false)) {
            $classes = array_reverse($classes);
        }

        $imagine = false;
        foreach ($classes as $class) {
            try {
                $imagine = new $class();
            } catch (\Imagine\Exception\RuntimeException $e) {
                $this->modx->log(modX::LOG_LEVEL_WARN, '[MoreGallery] Unable of instantiating ' . $class . ' Imagine driver ' . $e->getMessage() . '.');
            }
            if ($imagine instanceof \Imagine\Image\ImagineInterface) {
                break;
            }
        }

        if ($imagine) {
            $this->_imagine =& $imagine;
            return $this->_imagine;
        }

        $this->modx->log(modX::LOG_LEVEL_ERROR, '[MoreGallery] Unable of loading an Imagine instance for handling thumbnails, neither Imagick or GD extensions are available in the proper versions.');
        return false;
    }

    public function mg()
    {
        // Only run if we're in the manager
        if (!$this->modx->context || $this->modx->context->get('key') !== 'mgr') {
            return;
        }

        // Get the public key from the .pubkey file contained in the package directory
        $pubKeyFile = $this->config['core_path'] . '.pubkey';
        $key = file_exists($pubKeyFile) ? file_get_contents($pubKeyFile) : '';
        $domain = $this->modx->getOption('http_host');
        if (strpos($key, '@@') !== false) {
            $pos = strpos($key, '@@');
            $domain = substr($key, 0, $pos);
            $key = substr($key, $pos + 2);
        }

        $check = false;
        // No key? That's a really good reason to check :)
        if (empty($key)) {
            $check = true;
        }

        // Doesn't the domain in the key file match the current host? Then we should get that sorted out.
        if ($domain !== $this->modx->getOption('http_host')) {
            $check = true;
        }

        // the .pubkey_c file contains a unix timestamp saying when the pubkey was last checked
        $modified = file_exists($pubKeyFile . '_c') ? file_get_contents($pubKeyFile . '_c') : false;
        if (!$modified ||
            $modified < (time() - (60 * 60 * 24 * 7)) ||
            $modified > time()) {
            $check = true;
        }

        if ($check) {
            $provider = false;
            $c = $this->modx->newQuery('transport.modTransportPackage');
            $c->where(array(
                'signature:LIKE' => 'moregallery-%',
            ));
            $c->sortby('installed', 'DESC');
            $c->limit(1);
            $package = $this->modx->getObject('transport.modTransportPackage', $c);
            if ($package instanceof modTransportPackage) {
                $provider = $package->getOne('Provider');
            }
            if (!$provider) {
                $provider = $this->modx->getObject('transport.modTransportProvider', array(
                    'service_url' => 'https://rest.modmore.com/'
                ));
            }
            if ($provider instanceof modTransportProvider) {
                $this->modx->setOption('contentType', 'default');

                // The params that get sent to the provider for verification
                $params = array(
                    'key' => $key,
                    'package' => 'moregallery',
                );

                // Fire it off and see what it gets back from the XML..
                $response = $provider->request('license', 'GET', $params);
                $xml = $response->toXml();

                $valid = (int)$xml->valid;
                // If the key is found to be valid, set the status to true
                if ($valid) {
                    // It's possible we've been given a new public key (typically for dev licenses or when user has unlimited)
                    // which we will want to update in the pubkey file.
                    $updatePublicKey = (bool)$xml->update_pubkey;
                    if ($updatePublicKey > 0) {
                        file_put_contents($pubKeyFile,
                            $this->modx->getOption('http_host') . '@@' . (string)$xml->pubkey);
                    }
                    file_put_contents($pubKeyFile . '_c', time());
                    return;
                }

                // If the key is not valid, we have some more work to do.
                $message = (string)$xml->message;
                $age = (int)$xml->case_age;
                $url = (string)$xml->case_url;
                $warning = false;
                if ($age >= 7) {
                    $warning = <<<HTML
    var warning = '<li style="width: 100%;border: 1px solid #dd0000;background-color: #F9E3E3;padding: 1em;border-radius: 5px;margin-top: 1em; font-weight: bold;">';
    warning += '<a href="$url" style="float:right; margin-left: 1em;" target="_blank">Fix the license</a>The MoreGallery license on this site is invalid. Please click the button on the right to correct the problem. Error: {$message}';
    warning += '</li>';
HTML;
                } elseif ($age >= 2) {
                    $warning = <<<HTML
    var warning = '<li style="width: 100%;border: 1px solid #dd0000;background-color: #F9E3E3;padding: 1em;border-radius: 5px;margin-top: 1em;">';
    warning += '<a href="$url" style="float:right; margin-left: 1em;" target="_blank">Fix the license</a>Oops, there is an issue with the MoreGallery license. Perhaps your site recently moved to a new domain, or the license was reset? Either way, please click the button on the right or contact your development team to correct the problem.';
    warning += '</li>';
HTML;
                }
                if ($warning) {
                    $output = <<<HTML
    <script type="text/javascript">
    {$warning}
    function showWarning() {
        setTimeout(function() {
            if (typeof window.mg$ != 'undefined' && mg$('.mgresource-toolbar').length) {
                mg$('.mgresource-toolbar').find('ul').append(warning);
            }
            else {
                setTimeout(showWarning, 300);
            }
        }, 300);
    }
    showWarning();
    </script>
HTML;
                    if ($this->modx->controller instanceof modManagerController) {
                        $this->modx->controller->addHtml($output);
                    } else {
                        $this->modx->regClientHTMLBlock($output);
                    }
                }
            }
            else {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'UNABLE TO VERIFY MODMORE LICENSE - PROVIDER NOT FOUND!');
            }
        }
    }


    /**
     * Gets a list of id => tag
     *
     * @return array|mixed
     */
    public function getTagIds()
    {
        $tagNames = $this->modx->cacheManager->get('tags/ids', $this->cacheOptions);
        if (empty($tagNames)) {
            $tagNames = array();
            foreach ($this->modx->getIterator('mgTag') as $tag) {
                $display = $tag->get('display');
                $display = trim($display);
                if ($display === '') {
                    $tag->remove();
                    continue;
                }
                /** @var mgTag $tag */
                $tagNames[$tag->get('id')] = $tag->get('display');
            }
            $this->modx->cacheManager->set('tags/ids', $tagNames, 0, $this->cacheOptions);
        }
        return $tagNames;
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
    public function sanitizeFileName($name)
    {
        return $this->sanitize($name);
    }

    /**
     * @param modResource|null $resource
     * @return array
     */
    public function getCrops($resource = null)
    {
        $crops = false;
        if (is_numeric($resource)) {
            $resource = $this->modx->getObject('modResource', (int)$resource);
        }
        if ($resource instanceof modResource) {
            $crops = $resource->getProperty('crops', 'moregallery', 'inherit');
        }
        if (empty($crops) || $crops === 'inherit') {
            $crops = $this->getOption('moregallery.crops', null, '');
        }
        return $this->parseCrops($crops);
    }

    /**
     * Gets the custom fields. If a resource is set ($this->setResource) it will look through that resource its
     * properties for a moregallery.custom_fields object as well.
     *
     * @return array
     */
    public function getCustomFields()
    {
        $fields = false;
        if ($this->resource) {
            $fields = $this->resource->getProperty('custom_fields', 'moregallery', false);
        }

        if (empty($fields) || $fields === 'inherit') {
            $fields = $this->getOption('moregallery.custom_fields', null, '{}');
        }

        $fields = $this->modx->fromJSON($fields);
        if (!$fields || empty($fields)) {
            return array();
        }

        return $fields;
    }

    /**
     * Grab information about a specific crop by its key
     *
     * @param $crop
     * @param int|modResource $resource
     * @return array|bool
     */
    public function getCropInfo($crop, $resource = null)
    {
        $crops = $this->getCrops($resource);
        if (isset($crops[$crop])) {
            return $crops[$crop];
        }
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
            if (empty($crop)) {
                continue;
            }

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

    public function setMemoryLimit()
    {
        if ($this->_memoryLimitIncreased) {
            return;
        }
        $before = ini_get('memory_limit');
        $unit = strtoupper(substr($before, -1));
        $number = substr($before, 0, -1);
        $newLimit = $this->getOption('moregallery.upload_memory_limit', null, '256M');
        $newLimitNumber = substr($newLimit, 0, -1);
        if ($unit !== 'G' && $number < $newLimitNumber) {
            @ini_set('memory_limit', $newLimit);
            $after = ini_get('memory_limit');

            if ($before === $after) {
                $this->modx->log(modX::LOG_LEVEL_ERROR,
                    '[moregallery] Attempted to up the memory limit from ' . $before . ' to ' . $newLimit . ', but failed. You may run out of memory while resizing the uploaded image.');
            }
        }
        $this->_memoryLimitIncreased = true;
    }

    public function writePdfAsImageAndReturnContent($content, $extension = 'png')
    {
        $imagine = $this->getImagine();

        // First we write the PDF
        $tmpFile = MODX_CORE_PATH . 'cache/moregallery/tmp_upload_' . uniqid('mgt', $extension) . '.pdf';
        $h = fopen($tmpFile, 'w+');
        fwrite($h, $content);
        fclose($h);
        
        // We open the PDF from file
        $pdf = $imagine->open($tmpFile);
        
        // Then create the image based on it
        // @todo figure out how to get this to not overlap pages
        $tmpImageFile = MODX_CORE_PATH . 'cache/moregallery/tmp_upload_' . uniqid('mgt', $extension) . '.' . $extension;
        $pdf->save($tmpImageFile);
        
        // Get the raw content of the generated image file
        $content = file_get_contents($tmpImageFile);
        
        // Clean up again
        unlink($tmpFile);
        unlink($tmpImageFile);

        // Return the raw content
        return $content;
    }
}
