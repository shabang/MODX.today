<?php
/**
 * ContentBlocks
 *
 * Copyright 2013 by Mark Hamstra <hello@markhamstra.com>
 *
 * This file is part of ContentBlocks.
 *
 * @package contentblocks
*/

class ContentBlocks {
    /**
     * @var modX|null $modx
     */
    public $modx = null;
    /**
     * @var modResource|null $resource
     */
    public $resource = null;
    /**
     * @var array
     */
    public $config = array();
    /**
     * @var int
     */
    public $uniqueIdx = 0;
    /**
     * @var array
     */
    public $chunks = array();
    /**
     * @var null|array
     */
    public $fields;
    /**
     * @var bool
     */
    public $debug = false;
    /**
     * @var array
     */
    public $inputs = array();
    /**
     * @var bool
     */
    public $inputsLoaded = false;
    /**
     * @var array
     */
    public $coreInputs = array(
        'chunk',
        'chunk_selector',
        'code',
        'gallery',
        'file',
        'heading',
        'hr',
        'image',
        'image_with_title',
        'layout',
        'link',
        'list',
        'ordered_list',
        'quote',
        'repeater',
        'richtext',
        'snippet',
        'table',
        'textarea',
        'textfield',
        'video',
    );
    /**
     * @var array
     */
    public $cacheOptions = array(
        xPDO::OPT_CACHE_KEY => 'contentblocks',
    );

    /** @var modParser $normalParser */
    public $normalParser;

    public $version = '1.2.2-pl';

    /**
     * @param \modX $modx
     * @param array $config
     */
    function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;

        $corePath = $this->modx->getOption('contentblocks.core_path',$config,$this->modx->getOption('core_path').'components/contentblocks/');
        $assetsUrl = $this->modx->getOption('contentblocks.assets_url',$config,$this->modx->getOption('assets_url').'components/contentblocks/');
        $assetsPath = $this->modx->getOption('contentblocks.assets_path',$config,$this->modx->getOption('assets_path').'components/contentblocks/');
        $customIconPath = $this->modx->getOption('contentblocks.custom_icon_path',$config,false);
        $customIconUrl = $this->modx->getOption('contentblocks.custom_icon_url',$config,false);
        $this->config = array_merge(array(
            'basePath' => $corePath,
            'corePath' => $corePath,
            'modelPath' => $corePath.'model/',
            'processorsPath' => $corePath.'processors/',
            'controllersPath' => $corePath.'controllers/',
            'elementsPath' => $corePath.'elements/',
            'templatesPath' => $corePath.'templates/',
            'assetsPath' => $assetsPath,
            'customIconPath' => $customIconPath,
            'customIconUrl' => $customIconUrl,
            'jsUrl' => $assetsUrl.'js/',
            'cssUrl' => $assetsUrl.'css/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl.'connector.php',
            'linkDetectionPattern' => $this->modx->getOption('contentblocks.link_detection_pattern'),
            'hideLogo' => (bool)$this->modx->getOption('contentblocks.hide_logo', null, false),
        ),$config);

        // Get all contentblocks settings
        $c = $this->modx->newQuery('modSystemSetting');
        $c->where(array(
            'namespace' => 'contentblocks'
        ));
        foreach ($this->modx->getIterator('modSystemSetting', $c) as $setting) {
            /** @var modSystemSetting $setting */
            $key = substr($setting->key, strlen('contentblocks.'));
            if (!isset($this->config[$key])) $this->config[$key] = $setting->value;
        }

        $this->modx->addPackage('contentblocks',$this->config['modelPath']);
        $this->modx->lexicon->load('contentblocks:default');

        $this->config['debug'] = $this->debug = (bool)$this->modx->getOption('contentblocks.debug',null,false);
    }

    /**
     * @param modResource $resource
     * @return bool
     */
    public function useContentBlocks(modResource $resource)
    {
        // Default settings
        $disabled = (int)$this->modx->getOption('contentblocks.disabled', null, false);
        $acceptedResourceTypes = $this->modx->getOption('contentblocks.accepted_resource_types', null, 'modDocument,mgResource');

        // Fake the wctx variable for loading the working context to get settings
        if (!isset($_GET['wctx'])) $_GET['wctx'] = $resource->get('context_key');

        // If we got the working context, get some settings
        if ($this->modx->controller && $this->modx->controller->loadWorkingContext()) {
            $disabled = (int)$this->modx->controller->workingContext->getOption('contentblocks.disabled', $disabled);
            $acceptedResourceTypes = $this->modx->controller->workingContext->getOption('contentblocks.accepted_resource_types', $acceptedResourceTypes);
        }

        $acceptedType = false;
        $acceptedResourceTypes = explode(',', $acceptedResourceTypes);
        foreach ($acceptedResourceTypes as $type) {
            if ($resource instanceof $type) $acceptedType = true;
        }

        // If contentblocks is disabled or this is not an accepted resource, we can stop here.
        if ($disabled || !$acceptedType) return false;
        return true;
    }

    /**
    * Gets a Chunk and caches it; defaults to file based chunks.
    *
    * @access public
    * @param string $name The name of the Chunk
    * @param array $properties The properties for the Chunk
    * @return string The processed content of the Chunk
    * @author Shaun "splittingred" McCormick
    */
    public function getChunk($name,$properties = array()) {
        $chunk = null;
        if (!isset($this->chunks[$name])) {
            $chunk = $this->_getTplChunk($name);
            if (empty($chunk)) {
                $chunk = $this->modx->getObject('modChunk',array('name' => $name),true);
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
    * @access private
    * @param string $name The name of the Chunk. Will parse to name.chunk.tpl
    * @param string $postFix The postfix to append to the name
    * @return modChunk/boolean Returns the modChunk object if found, otherwise false.
    * @author Shaun "splittingred" McCormick
    */
    private function _getTplChunk($name, $postFix = '.tpl') {
        $chunk = false;
        $f = $this->config['templatesPath'] . strtolower($name) . $postFix;
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
     * Gets fields and layouts ready to be used in the manager javascript
     *
     * @param modResource|null $resource
     * @return array
     */
    public function getObjectsForCanvas($resource = null) {
        $customIconUrl = $this->config['customIconUrl'];
        $coreIconUrl = $this->config['assetsUrl'].'img/icons/';
        // Load input classes
        $this->loadInputs();
        // make sure the parser is available, so we can process tags later on if needed
        $this->modx->getParser();

        $fields = array(); ;
        $c = $this->modx->newQuery('cbField');
        $c->sortby('sortorder', 'ASC');
        foreach ($this->modx->getIterator('cbField') as $field) {
            /** @var cbField $field */
            $key = '_' . $field->get('id');
            $input = $field->get('input');
            $icon_type = $field->get('icon_type');
            $icon_base_url = ($icon_type == 'core' || $icon_type == '') ? $coreIconUrl : $customIconUrl;
            $fields[$key] = $field->get(array('id', 'input', 'name', 'description', 'sortorder', 'icon', 'icon_type', 'properties', 'availability', 'layouts', 'settings', 'times_per_layout', 'times_per_page', 'process_tags'));
            $fields[$key]['icon'] =  $icon_base_url . $field->get('icon') . '--DPR--.png';
            $fields[$key]['properties'] = $this->modx->fromJSON($fields[$key]['properties']);
            $fields[$key]['available'] = ($resource) ? $this->isAvailable($fields[$key]['availability'], $resource) : true;
            $fields[$key]['layouts'] = (!empty($fields[$key]['layouts'])) ? array_map('intval', explode(',', $fields[$key]['layouts'])) : array();
            $fields[$key]['settings'] = $this->modx->fromJSON($fields[$key]['settings']);
            if (is_array($fields[$key]['settings'])) {
                foreach ($fields[$key]['settings'] as $idx => $setting) {
                    if($setting['process_tags']) {
                        $this->modx->parser->processElementTags('', $setting['fieldoptions']);
                    }
                    $fields[$key]['settings'][$idx]['fieldoptions'] = explode("\n", $setting['fieldoptions']);
                }
            }
            if ($this->inputs[$input] instanceof cbBaseInput) {
                $topics = $this->inputs[$input]->getLexiconTopics();
                foreach ($topics as $topic) $this->modx->controller->addLexiconTopic($topic);
            }
        }

        $c = $this->modx->newQuery('cbLayout');
        $c->sortby('sortorder', 'ASC');
        $layouts = array(); ;
        foreach ($this->modx->getIterator('cbLayout', $c) as $layout) {
            /** @var cbLayout $layout */
            $key = '_' . $layout->get('id');
            $icon_type = $layout->get('icon_type');
            $icon_base_url = ($icon_type == 'core' || $icon_type == '') ? $coreIconUrl : $customIconUrl;
            $layouts[$key] = $layout->get(array('id', 'name', 'description', 'sortorder', 'icon', 'columns', 'availability', 'settings', 'times_per_page', 'layout_only_nested'));
            $layouts[$key]['icon'] =  $icon_base_url . $layout->get('icon') . '--DPR--.png';
            $layouts[$key]['available'] = ($resource) ? $this->isAvailable($layouts[$key]['availability'], $resource) : true;
            $layouts[$key]['settings'] = $this->modx->fromJSON($layouts[$key]['settings']);
            if (is_array($layouts[$key]['settings'])) {
                foreach ($layouts[$key]['settings'] as $idx => $setting) {
                    if($setting['process_tags']) {
                        $this->modx->parser->processElementTags('', $setting['fieldoptions']);
                    }
                    $layouts[$key]['settings'][$idx]['fieldoptions'] = explode("\n", $setting['fieldoptions']);
                }
            }
        }

        $c = $this->modx->newQuery('cbTemplate');
        $c->sortby('sortorder', 'ASC');
        $templates = array();
        foreach ($this->modx->getIterator('cbTemplate', $c) as $template) {
            /** @var cbTemplate $template */
            $key = '_' . $template->get('id');
            $icon_type = $template->get('icon_type');
            $icon_base_url = ($icon_type == 'core' || $icon_type == '') ? $coreIconUrl : $customIconUrl;
            $templates[$key] = $template->get(array('id', 'name', 'description', 'sortorder', 'icon', 'content', 'availability'));
            $templates[$key]['icon'] =  $icon_base_url . $template->get('icon') . '--DPR--.png';
            $templates[$key]['available'] = ($resource) ? $this->isAvailable($templates[$key]['availability'], $resource) : true;
            $templates[$key]['content'] = $this->modx->fromJSON($templates[$key]['content']);
        }

        return array(
            'fields' => $fields,
            'layouts' => $layouts,
            'templates' => $templates,
        );
    }

    public function getAssets()
    {
        $cbv = $this->version;
        $version = '?cbv=' . $cbv;
        $assetsUrl = $this->config['assetsUrl'];
        $js = array();
        if (!$this->debug) {
            $js[] = $assetsUrl . 'js/contentblocks-min.js'.$version;
        }
        else {
            $js[] = $assetsUrl . 'js/vendor/jquery.latest.js'.$version;
            $js[] = $assetsUrl . 'js/vendor/tinyrte/tinyrte.js'.$version;
            $js[] = $assetsUrl . 'js/vendor/jquery.autogrowtextarea.js'.$version;
            $js[] = $assetsUrl . 'js/vendor/jquery.powertip-1.2.0/jquery.powertip.js'.$version;
            $js[] = $assetsUrl . 'js/vendor/jqueryui/jquery-ui-1.10.3.custom.min.js'.$version;
            $js[] = $assetsUrl . 'js/vendor/jquery.iframe-transport.js'.$version;
            $js[] = $assetsUrl . 'js/vendor/jquery.fileupload.js'.$version;
            $js[] = $assetsUrl . 'js/vendor/tmpl/js/tmpl.js'.$version;
            $js[] = $assetsUrl . 'js/vendor/bloodhound.min.js'.$version;
            $js[] = $assetsUrl . 'js/vendor/hogan-2.0.0.js'.$version;
            $js[] = $assetsUrl . 'js/vendor/typeahead.js'.$version;
            $js[] = $assetsUrl . 'js/contentblocks.js'.$version;
        }
        $assets = $this->getAssetsForInputs();
        $assets['css'][] = $assetsUrl . 'css/contentblocks.css';

        foreach ($assets['js'] as $file) {
            $file .= ((strpos($file, '?')) ? '&' : '?') . 'cbv=' . $cbv;
            $js[] = $file;
        }
        $js = array_unique($js);

        $output = array();
        foreach ($js as $jsFile) {
            $output[] = '<script type="text/javascript" src="' . $jsFile . '"></script>';
        }
        $output = implode("\n", $output);

        // Add tpl
        $output .= $assets['tpl'];

        // Add CSS
        $css = array();
        foreach ($assets['css'] as $file) {
            $css[] = '<link href="' . $file . '" rel="stylesheet" type="text/css" />';
        }
        $css = implode("\n", $css);
        $output = $css . "\n\n" . $output;


        $newContentField = $this->modx->newObject('modChunk', array(
            'content' => file_get_contents($this->config['corePath'] . 'templates/prerender.tpl'),
        ));
        $replacement = $newContentField->process(array(
            'assetsUrl' => $assetsUrl
        ));

        $output = $replacement . "\n\n" . $output;
        return $output;
    }

    /**
     * @param array $vcContent
     * @return string
     */
    public function generateHtml(array $vcContent = array(), $globalPhs = array())
    {
        // Load the custom cbParser that only processes placeholders
        $this->loadParser();
        try {
            $this->loadInputs();
            $allFields = $this->getFields();
            $layouts = $this->getLayouts();
            $layoutTemplates = array();
            foreach ($layouts as $id => $layout) {
                $layoutTemplates[$id] = $layout['template'];
            }

            // All parsed content will go into the $content variable
            $content = array();

            // Some options for clean output
            $implosion = ($this->modx->getOption('contentblocks.implode_string', null, "\n\n"));

            $layoutIdx = 0;
            foreach ($vcContent as $layout) {
                $columns = $globalPhs;
                foreach ($layout['content'] as $column => $fields) {
                    $columns[$column] = array();
                    $fieldIdx = 0;
                    foreach ($fields as $fieldData) {
                        // add idx placeholder
                        $fieldData['idx'] = ++$fieldIdx;
                        $fieldData['unique_idx'] = ++$this->uniqueIdx;

                        // add placeholders for layout and column
                        $fieldData['layout_id'] = $layout['layout'];
                        $fieldData['layout_column'] = $column;
                        $fieldData['layout_idx'] = $layoutIdx;
                
                        /** @var cbField|false $field */
                        $field = (isset($allFields[$fieldData['field']])) ? $allFields[$fieldData['field']] : false;                        

                        $columns[$column][] = $this->generateFieldHtml($fieldData, $field, $fieldIdx);
                    }
                    $columns[$column] = implode($implosion, $columns[$column]);
                }

                $tmpLayout = isset($layouts[$layout['layout']]) ? $layouts[$layout['layout']] : array();
                if (isset($tmpLayout['settings']) && !empty($tmpLayout['settings'])) {
                    $settings = $this->modx->fromJSON($tmpLayout['settings']);
                    foreach ($settings as $set) {
                        $columns[$set['reference']] = $set['default_value'];
                    }
                }
                if (isset($layout['settings']) && is_array($layout['settings'])) {
                    foreach ($layout['settings'] as $id => $value) {
                        $columns[$id] = $value;
                    }
                }

                // Add layout idx placeholder
                $columns['idx'] = ++$layoutIdx;
                $columns['unique_idx'] = ++$this->uniqueIdx;

                $tpl = isset($layoutTemplates[$layout['layout']]) ? $layoutTemplates[$layout['layout']] : 'Template not found for Layout.';
                $content[] = $this->parse($tpl, $columns);
            }
            $content = implode($implosion, $content);

            // Restore the normal parser
            $this->restoreParser();
            return $content;
        } catch (Exception $e) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[ContentBlocks.generateHtml] Exception while attempting to generate html. vcContent Data: ' . $vcContent);

            // Restore the normal parser
            $this->restoreParser();
            return '<p class="error">Uh oh, something went wrong generating the page content. </p>';
        }
    }

    /**
     * @param array $fieldData
     * @param bool|\cbField $field
     * @param int $idx
     * @return string
     */
    
    public function generateFieldHtml($fieldData, $field = false, $idx) {
        // Load the default settings as placeholders
        $settingTypes = array();
        if ($field) {
            $defSettings = $field->get('settings');
            $defSettings = $this->modx->fromJSON($defSettings);
            if (is_array($defSettings) && count($defSettings) > 0) {
                foreach ($defSettings as $defSet) {
                    $settingTypes[$defSet['reference']] = $defSet['fieldtype'];
                    $fieldData[$defSet['reference']] = $defSet['default_value'];
                }
            }
        }

        // Load defined settings as placeholders
        $settings = (isset($fieldData['settings']) && is_array($fieldData['settings'])) ? $fieldData['settings'] : false;
        if (is_array($settings)) {
            foreach ($settings as $key => $value) {
                if (isset($settingTypes[$key]) && $settingTypes[$key] == 'link' && $value != '') {
                    $fieldData[$key . '_raw'] = $value;
                    
                    // if it's numeric, it's a resource
                    if(preg_replace("/\D/", "", $value) == $value) {
                        $value = "[[~$value]]";
                        $fieldData[$key . '_linkType'] = 'resource';
                    }
                    
                    // maybe it's an email address
                    else if(preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\\.[A-Z]{2,4}$/i', $value)) {
                        $value = "mailto:$value";
                        $fieldData[$key . '_linkType'] = 'email';
                    }
                }
                $fieldData[$key] = $value;
            }
        }

        /** @var string|false $it */
        $it = $field ? $field->get('input') : false;
        if ($it && isset($this->inputs[$it])) {
            /** @var cbInput $input */
            $input = $this->inputs[$it];
            $output = $input->process($field, $fieldData);
        }
        else if($fieldData['field'] == '') {
            // the dummy content field is in play. it has no fieldname.
            $output = $fieldData['value'];
        }
        else {
            $output = $fieldData['value'];
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[ContentBlocks] Could not find input ' . $fieldData['field'] . ' for parsing.');
        }
        return $output;      
    }

    /**
     * @param $tpl
     * @param $phs
     * @return mixed
     */
    public function parse ($tpl, $phs) {
        // First do a simple search/replace. This will catch nested tags that may be left off
        // in other situations, while it will also typically be faster than parsing simple
        // placeholders (without output modifiers) compared to the actual parser.
        foreach ($phs as $key => $value) {
            if (is_scalar($value)) {
                $tpl = str_replace('[[+' . $key . ']]', $value, $tpl);
            }
        }

        // If we have more placeholders, run it through the parser
        if (strpos($tpl, '[[+') !== -1) {
            $oldphs = $this->modx->placeholders;
            // Prevent settings from being parsed, for using system settings w/ context overrides
            foreach ($this->modx->placeholders as $key => $value) {
                if (substr($key, 0, 1) == '+') {
                    unset($this->modx->placeholders[$key]);
                }
            }            
            $this->modx->toPlaceholders($phs, '', '.', true);
            $this->modx->parser->processElementTags('', $tpl, false, false, '[[', ']]', array('+'), 1);
            $this->modx->placeholders = $oldphs;
        }
        return $tpl;
    }

    /**
     * As of 0.9.2, this method is no longer necessary to prepare placeholders/templates for parsing.
     *
     * It's temporarily left in (will be removed around ContentBlocks 1.1) to prevent custom inputs breaking
     * if they call it.
     *
     * @param $value
     * @return array|mixed
     * @deprecated
     */
    public function prepareSafeParse($value)
    {
        return $value;
    }

    /**
     * Get the fields
     *
     * @return array|null
     */
    public function getFields() {
        if (!$this->fields) {
            $this->fields = $this->modx->getCollection('cbField');
        }
        return $this->fields;
    }

    /**
     * @return array
     */
    public function getLayouts()
    {
        $layouts = array(
            0 => array('template' => '[[+main]]')
        );
        /** @var cbLayout $layout */
        foreach ($this->modx->getIterator('cbLayout') as $layout) {
            $layouts[$layout->get('id')] = $layout->toArray();
        }
        return $layouts;
    }

    /**
     * @return bool
     */
    public function loadInputs() {
        if (!$this->inputsLoaded) {
            $this->modx->loadClass('cbInput', $this->config['modelPath'].'contentblocks/', true, true);
            $core = $this->coreInputs;
            foreach ($core as $name) {
                $cn = implode('', array_map('ucfirst', explode('_', $name))) . 'Input';
                $path = $this->config['elementsPath'] . '/inputs/';
                if (!$this->modx->loadClass($cn, $path, true, true)) {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, 'Loading failed for ' . $cn . ' in ' . $path);
                }
                else {
                    $this->inputs[$name] = new $cn($this);
                }
            }

            $erp = $this->modx->invokeEvent('ContentBlocks_RegisterInputs', array(
                'contentBlocks' => $this
            ));
            if (is_array($erp)) {
                foreach ($erp as $msg) {
                    if (is_array($msg)) $this->inputs = array_merge($this->inputs, $msg);
                    else {
                        $this->modx->log(modX::LOG_LEVEL_ERROR,'[ContentBlocks] Expecting an array event output, got ' . gettype($msg) . ': ' . print_r($msg, true));
                    }
                }
            }
            // Prevent output from ContentBlocks_RegisterInputs plugins bubbling through to OnDocFormRender
            if ($this->modx->event) {
                $this->modx->event->_output = null;
            }
            $this->inputsLoaded = true;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getAssetsForInputs() {
        $this->loadInputs();

        $inputs = array();
        foreach ($this->getFields() as $field) {
            /** @var cbField $field */
            $inputs[] = $field->get('input');
            $dependencies = $field->getDependantInputs();
            if (!empty($dependencies) && is_array($dependencies)) {
                $inputs = array_merge($inputs, $dependencies);
            }
        }
        $inputs = array_unique($inputs);
        $js = array();
        $css = array();
        $tpl = array();

        /**
         * Load minimum required stuff
         */
        if ($this->debug) {
            $js[] = $this->config['assetsUrl'] . 'js/inputs/all-dev.js';
        }
        else {
            $js[] = $this->config['assetsUrl'] . 'js/inputs/all-min.js';
        }
        $tpl[] = $this->getCoreInputTpl('textarea');
        $tpl[] = $this->getCoreInputTpl('richtext');

        foreach ($inputs as $key) {
            if (isset($this->inputs[$key]) && ($this->inputs[$key] instanceof cbBaseInput)) {
                $tjs = $this->inputs[$key]->getJavaScripts();
                if (!empty($tjs)) $js = array_merge($js, $tjs);

                $tpls = $this->inputs[$key]->getTemplates();
                if (!empty($tpls)) $tpl = array_merge($tpl, $tpls);

                $tcss = $this->inputs[$key]->getCss();
                if (!empty($tcss)) $css = array_merge($css, $tcss);
            }
            else {
                $this->modx->log(modX::LOG_LEVEL_ERROR, '[ContentBlocks] Input type ' . $key . ' not found. ');
            }
        }

        $js = array_unique($js);
        $css = array_unique($css);
        $tpl = implode("\n", $tpl);

        return array(
            'js' => $js,
            'css' => $css,
            'tpl' => $tpl
        );
    }

    /**
     * @param $input
     * @return bool|string
     */
    public function getCoreInputTpl($input)
    {
        $file = $this->config['templatesPath'] . 'inputs/' . $input . '.tpl';
        if (file_exists($file)) {
            return $this->wrapInputTpl($input, file_get_contents($file));
        }
        return '<p>Template for input ' . $input . ' not found.</p>';
    }

    /**
     * Wrap an input type template with a list item and the proper script
     * tag for the tmpl library.
     *
     * @param $input
     * @param $content
     * @return string
     */
    public function wrapInputTpl($input, $content) {
        $content = '<li data-field="{%=o.field%}" id="{%=o.generated_id%}" class="contentblocks-field-outer"><div class="contentblocks-field-wrap">
        ' . $content
        . '</div><div class="contentblocks-add-content-here"><a href="javascript:void(0);" class="contentblocks-add-content-here-link">+</a></div>
        </li>';
        return $this->wrapTpl('contentblocks-field-' . $input, $content);
    }

    /**
     * Wrap the template content into a script tag for the tmpl library
     *
     * @param $id
     * @param $content
     * @return string
     */
    public function wrapTpl($id, $content) {
        return '<script type="text/x-tmpl" id="' . $id . '">
' . $content
. '</script>';
    }

    /**
     * @param string $name
     * @param string $id
     * @return bool|string
     */
    public function getCoreTpl($name, $id)
    {
        $file = $this->config['templatesPath'] . $name . '.tpl';
        if (file_exists($file)) {
            return $this->wrapTpl($id, file_get_contents($file));
        }
        return $this->wrapTpl($id, '<p>Template ' . $name . ' not found.</p>');
    }

    /**
     * @param $name
     * @return string
     */
    public function sanitize($name) {
        $iconv = function_exists('iconv');
        $charset = strtoupper((string) $this->modx->getOption('modx_charset', null, 'UTF-8'));
        $translit = $this->modx->getOption('contentblocks.translit', null, $this->modx->getOption('friendly_alias_translit', null, 'none'), true);
        $translitClass = $this->modx->getOption('contentblocks.translit_class', null, $this->modx->getOption('friendly_alias_translit_class', null, 'translit.modTransliterate'), true);
        $translitClassPath = $this->modx->getOption('contentblocks.translit_class_path', null, $this->modx->getOption('friendly_alias_translit_class_path', null, $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/'), true);
        switch ($translit) {
            case '':
            case 'none':
                // no transliteration
                break;

            case 'iconv':
                // if iconv is available, use the built-in transliteration it provides
                if ($iconv) {
                    $name = iconv($charset, 'ASCII//TRANSLIT//IGNORE', $name);
                }
                break;

            default:
                // otherwise look for a transliteration service class (i.e. Translit package) that will accept named transliteration tables
                if ($this->modx instanceof modX) {
                    if ($this->modx->getService('translit', $translitClass, $translitClassPath)) {
                        $name = $this->modx->translit->translate($name, $translit);
                    }
                }
                break;
        }

        $replace = $this->modx->getOption('contentblocks.sanitize_replace', null, '_');
        $pattern = $this->modx->getOption('contentblocks.sanitize_pattern', null, '/([[:alnum:]_\.-]*)/');
        $name = str_replace(str_split(preg_replace($pattern, $replace, $name)), $replace, $name);
        $name = preg_replace('/[\/_|+ -]+/', $replace, $name);
        $name = trim(trim($name, $replace));
        return $name;
    }


    /**
     * Parses through availability conditions to see if a field should be available or not.
     *
     * @param $availability
     * @param modResource $resource
     * @return bool
     */
    public function isAvailable($availability, modResource $resource)
    {
        $availability = $this->modx->fromJSON($availability);

        if (empty($availability)) {
            return true;
        }

        $available = false;
        foreach ($availability as $av) {
            $av['value'] = explode(',', $av['value']);
            switch ($av['field']) {
                case 'resource':
                    if (in_array($resource->get('id'), $av['value'])) {
                        $available = true;
                    }
                    break;

                case 'parent':
                    if (in_array($resource->get('parent'), $av['value'])) {
                        $available = true;
                    }
                    break;

                case 'template':
                    if (in_array($resource->get('template'), $av['value'])) {
                        $available = true;
                    }
                    break;

                case 'ultimateparent':
                    if (in_array($this->getUltimateParent($resource->get('id'), $resource->get('context_key')), $av['value'])) {
                        $available = true;
                    }
                    break;

                case 'class_key':
                    if (in_array($resource->get('class_key'), $av['value'])) {
                        $available = true;
                    }
                    break;

                case 'context':
                    if (in_array($resource->get('context_key'), $av['value'])) {
                        $available = true;
                    }
                    break;

                case 'usergroup':
                    if ($this->modx->user->isMember($av['value'])) {
                        $available = true;
                    }
                    break;
            }
        }
        return $available;
    }

    /**
     * @param int $resource
     * @param string $context
     * @return mixed
     */
    public function getUltimateParent($resource = 0, $context = '')
    {
        $parents = $this->modx->getParentIds($resource, 10, array('context' => $context));
        $parents = array_reverse($parents);
        return isset($parents[1]) ? $parents[1] : 0;
    }

    /**
     * @return cbParser|null|object
     */
    public function loadParser()
    {
        if ($this->modx->parser && (get_class($this->modx->parser) != 'cbParser')) {
            $this->normalParser = $this->modx->parser;
        }
        $this->modx->parser = $this->modx->getService('cbparser', 'cbParser', $this->config['modelPath'].'contentblocks/');
    }

    public function restoreParser()
    {
        $this->modx->parser = $this->normalParser;
    }

    /**
     * @param $vc
     * @return array
     */
    public function summarizeContent($vc)
    {
        $linear = array();
        $counts = array();
        foreach ($vc as $layout) {
            foreach ($layout['content'] as $column => $content) {
                foreach ($content as $field) {
                    $id = $field['field'];
                    $linear[] = $field;
                    $counts[$id] = (isset($counts[$id])) ? $counts[$id] + 1 : 1;
                }
            }
        }
        return array('linear' => $linear, 'fieldcounts' => $counts, 'summaryVersion' => '1.1');
    }

    public function setResource(modResource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @param bool $resource
     * @param string $content
     * @return array|mixed
     */
    public function getDefaultCanvas($resource = false, $content = '') {
        $default = $this->getDefaultTemplate($resource);
        $defaultLayout = $this->modx->getOption('contentblocks.default_layout', null, 1);
        $defaultLayoutPart = $this->modx->getOption('contentblocks.default_layout_part', null, 'main');
        $defaultField = $this->modx->getOption('contentblocks.default_field', null, 0);

        if ($default['template'] === 0 ||
            !$template = $this->modx->getObject('cbTemplate', $default['template'])
        ) {
            return array(
                array(
                    'layout' => $defaultLayout,
                    'content' => array(
                        $defaultLayoutPart => array(
                            array(
                                'field' => $defaultField,
                                'value' => $content
                            )
                        )
                    )
                )
            );
        }

        // Get the template definition with layouts/fields
        $templateContent = $template->get('content');
        $templateContent = $this->modx->fromJSON($templateContent);

        // This could really do with a more cleaner implementation..
        // Loop over the template until the requested field is found, and insert existing content
        if ($default['field'] > 0) {
            foreach ($templateContent as $layoutKey => $layout) {
                if($layout['layout'] == $default['layout']) {
                    foreach ($layout['content'] as $columnKey => $fields) {
                        if (empty($default['column']) || $columnKey == $default['column']) {
                            foreach ($fields as $fldKey => $fld) {
                                if ($fld['field'] == $default['field']) {
                                    $templateContent[$layoutKey]['content'][$columnKey][$fldKey]['value'] = $content;
                                    break 3;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $templateContent;
    }


    /**
     * @param bool|int|\modResource $resource
     * @return array
     */
    public function getDefaultTemplate($resource = false) {
        if (is_numeric($resource)) {
            $resource = $this->modx->getObject('modResource', $resource);
        }

        if (!$resource) {
            $resource = $this->resource;
        }

        $c = $this->modx->newQuery('cbDefault');
        $c->sortby('sortorder', 'ASC');
        $rules = $this->modx->getCollection('cbDefault', $c);

        /** @var cbDefault $rule */
        foreach ($rules as $rule) {
            if ($rule->get('constraint_field') == '' ||
                $this->doesRuleApply($resource, $rule->get('constraint_field'), $rule->get('constraint_value'))) {
                return array(
                    'template' => $rule->get('default_template'),
                    'layout' => $rule->get('target_layout'),
                    'field' => $rule->get('target_field'),
                    'column' => $rule->get('target_column')
                );
            }
        }

        return array(
            'template' => 0,
            'layout' => 0,
            'field' => 0,
            'column' => ''
        );
    }

    /**
     * @param modResource $resource
     * @param $constraintField
     * @param $constraintValue
     * @return bool
     */
    public function doesRuleApply(modResource $resource, $constraintField, $constraintValue) {
        $constraintValue = explode(',', $constraintValue);

        $value = false;

        switch (true) {
            case (array_key_exists($constraintField, $resource->_fieldMeta)):
                $value = $resource->get($constraintField);
                break;

            case $constraintField == 'ultimateparent':
                $value = $this->getUltimateParent($resource->get('id'), $resource->get('context_key'));
                break;

            case $constraintField == 'usergroup':
                $groupIds = $this->modx->user->getUserGroups();
                $groupNames = $this->modx->user->getUserGroupNames();

                foreach ($constraintValue as $cv) {
                    if (is_numeric($cv) && in_array($cv, $groupIds)) {
                        return true;
                    }
                    elseif (in_array($cv, $groupNames)) {
                        return true;
                    }
                }

                break;
        }

        if (in_array($value, $constraintValue)) {
            return true;
        }
        return false;

    }
}

