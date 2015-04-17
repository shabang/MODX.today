<?php
@include 'versionobject.class.php';
/**
 * The base class for Redactor.
 *
 * @package redactor
 */
class Redactor {
    /**
     * @var modX A reference to the modX object.
     */
    public $modx = null;
    /**
     * @var array An array of configuration options
     */
    public $config = array();
    /**
     * @var array An array of version data
     */
    public $version;
    /**
     * @var array An array of variables to use in path resolving.
     */
    public $pathVariables = array('id' => '', 'pagetitle' => '', 'alias' => '');
    /**
     * @var int If any, the resource ID.
     */
    public $resource = 0;
    /**
     * @var array An array of configuration options
     */
    public $chunks = array();
    /**
     * @var bool A flag to prevent double script registering
     */
    public $assetsLoaded = false;
    /**
     * @var string Redactors asset url
     */
    public $assetsUrl = false;
    /**
     * @var bool True in MODX version is less than 2.3.0-pl
     */
    public $degradeUI = false;
    /**
     * @var bool Whether or not it's Rebecca Meyer's Birthday #rebeccapurple
     */
    public $rebeccaDay = false;
    /**
     * @var bool Whether or not to load ace javascript code editor
     */
    public $loadAce = true;

    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;

        $corePath = $this->modx->getOption('redactor.core_path',$config,$this->modx->getOption('core_path').'components/redactor/');
        $this->assetsUrl = $this->modx->getOption('redactor.assets_url',$config,$this->modx->getOption('assets_url').'components/redactor/');

        $this->config = array_merge(array(
            'corePath' => $corePath,
            'templatePath' => $corePath.'templates/',
            'assetsUrl' => $this->assetsUrl,
            'connectorUrl' => $this->assetsUrl . 'connector.php'
        ),$config);
        
        $this->version = new VersionObject(1, 6, 0, 'dev5');

        $this->modx->lexicon->load('redactor:default');
        
        $vd = $this->modx->getVersionData();
        $this->degradeUI = (bool)(version_compare($vd['full_version'],'2.3.0-pl') === -1);
        $this->rebeccaDay = (bool)((bool)($this->modx->getOption('redactor.commemorateRebecca', null, false)) && date('m') == '06' && (date('d') == '07'));
        $this->loadAce = (bool)$this->modx->getOption('redactor.plugin_syntax', null,true);
    }

    /**
     * Gets all the options as an array as they are defined by settings.
     *
     * @return array
     */
    public function getGlobalOptions() {
        $options = array('assetsUrl' => $this->assetsUrl);

        /**
         * Options related to the display of Redactor
         */
        $options['direction'] = $this->modx->getOption('redactor.direction', null, 'ltr');
        $options['lang'] = $this->modx->getOption('redactor.lang', null, $this->modx->getOption('manager_language'), true);
        $options['lang'] = str_replace(array('../','//','./','.'), '', $options['lang']);

        $options['minHeight'] = (int)$this->modx->getOption('redactor.minHeight', null, 200);
        $options['autoresize'] = (bool)$this->modx->getOption('redactor.autoresize', null,true);
        $options['linkAnchor'] = (bool)$this->modx->getOption('redactor.linkAnchor', null, false);
        $options['linkEmail'] = (bool)$this->modx->getOption('redactor.linkEmail', null, false);
        $options['placeholder'] = (bool)$this->modx->getOption('redactor.placeholder', null, false, true);
        $options['visual'] = (bool)$this->modx->getOption('redactor.visual', null, true);

        $buttons = $this->modx->getOption('redactor.buttons', null, 'html,formatting,bold,italic,deleted,unorderedactorlist,orderedactorlist,outdent,indent,image,video,file,table,link,alignment,horizontalrule');
        $buttons = str_replace('fontcolor','',$buttons);
        $buttons = str_replace('backcolor','',$buttons);
        $options['buttons'] = $this->explode($buttons);

        $options['buttonSource'] = (bool)$this->modx->getOption('redactor.buttonSource', null,true);
        $options['linkNofollow'] = (bool)$this->modx->getOption('redactor.linkNofollow', null,false);

        $options['formattingTags'] = $this->explode($this->modx->getOption('redactor.formattingTags', null, 'p,blockquote,pre,h1,h2,h3,h4'));
        $options['colors'] = $this->explode($this->processColor($this->modx->getOption('redactor.colors', null, '#ffffff,#000000,#eeece1,#1f497d,#4f81bd,#c0504d,#9bbb59,#8064a2,#4bacc6,#f79646,#ffff00,#f2f2f2,#7f7f7f,#ddd9c3,#c6d9f0,#dbe5f1,#f2dcdb,#ebf1dd,#e5e0ec,#dbeef3,#fdeada,#fff2ca,#d8d8d8,#595959,#c4bd97,#8db3e2,#b8cce4,#e5b9b7,#d7e3bc,#ccc1d9,#b7dde8,#fbd5b5,#ffe694,#bfbfbf,#3f3f3f,#938953,#548dd4,#95b3d7,#d99694,#c3d69b,#b2a2c7,#b7dde8,#fac08f,#f2c314,#a5a5a5,#262626,#494429,#17365d,#366092,#953734,#76923c,#5f497a,#92cddc,#e36c09,#c09100,#7f7f7f,#0c0c0c,#1d1b10,#0f243e,#244061,#632423,#4f6128,#3f3151,#31859b,#974806,#7f6000')));        
        
        $options['typewriter'] = (bool)$this->modx->getOption('redactor.typewriter', null,false);
        $options['buttonsHideOnMobile'] = $this->modx->getOption('redactor.buttonsHideOnMobile', null,'');
        $options['toolbarOverflow'] = (bool)$this->modx->getOption('redactor.toolbarOverflow', null,false);
        $options['toolbarFixed'] = (bool)$this->modx->getOption('redactor.toolbarFixed', null,false);
        $options['toolbarFixedTarget'] = $this->modx->getOption('redactor.toolbarFixedTarget', null, '#modx-content > .x-panel-bwrap > .x-panel-body');
        
        $options['focus'] = (bool)$this->modx->getOption('redactor.focus', null,false);
        $options['focusEnd'] = (bool)$this->modx->getOption('redactor.focusEnd', null,false);
        $options['scrollTarget'] = $this->modx->getOption('redactor.scrollTarget', null,'');
        $options['enterKey'] = (bool)$this->modx->getOption('redactor.enterKey', null,true);
        $options['cleanStyleOnEnter'] = (bool)$this->modx->getOption('redactor.cleanStyleOnEnter', null,false);
        $options['linkTooltip'] = (bool)$this->modx->getOption('redactor.linkTooltip', null,true);
        $options['imageLink'] = (bool)$this->modx->getOption('redactor.imageResizable', null,true);
        $options['imagePosition'] = (bool)$this->modx->getOption('redactor.imagePosition', null,true);
        $options['buttonsHide'] = $this->modx->getOption('redactor.buttonsHide', null,'');
        $options['buttonsHideOnMobile'] = $this->modx->getOption('redactor.buttonsHideOnMobile', null,'');

        /**
         * Options related to underlying display stuff
         */
        $options['tabindex'] = (int)$this->modx->getOption('redactor.tabindex', null, '');
        if((bool)$this->modx->getOption('redactor.shortcuts', null,true) === false )$options['shortcuts'] = false;
        $options['linkProtocol'] = $this->modx->getOption('redactor.linkProtocol', null, 'http://');
        if (empty($options['linkProtocol'])) $options['linkProtocol'] = false;
        $options['prefetch_ttl'] = $this->modx->getOption('redactor.prefetch_ttl', null, '86400000');
        //$options['imageFloatMargin'] = $this->modx->getOption('redactor.imageFloatMargin', null, '10px');
        $options['tabSpaces'] = (bool)$this->modx->getOption('redactor.tabSpaces', null, false);
        
        $options['tabifier'] = (bool)$this->modx->getOption('redactor.buttonsHideOnMobile', null,false);

        /**
         * Options related to processing the inputs
         */
        $options['allowedTags'] = $this->explode($this->modx->getOption('redactor.allowedTags', null, false, true));
        $options['cleanup'] = (bool)$this->modx->getOption('redactor.cleanup', null, true);
        $options['convertDivs'] = (bool)$this->modx->getOption('redactor.convertDivs', null, true);
        $options['convertLinks'] = (bool)$this->modx->getOption('redactor.convertLinks', null, true);
        $options['deniedTags'] = $this->explode($this->modx->getOption('redactor.deniedTags', null, false, true));
        $options['linebreaks'] = (bool)$this->modx->getOption('redactor.linebreaks', null, false);
        $options['paragraphy'] = (bool)$this->modx->getOption('redactor.paragraphy', null, true);
        $options['linkSize'] = (bool)$this->modx->getOption('redactor.linkSize', null, 50);
        $options['advAttrib'] = (bool)$this->modx->getOption('redactor.advAttrib', null, false);
        $options['cleanSpaces'] = (bool)$this->modx->getOption('redactor.cleanSpaces', null, true);
        $options['definedLinks'] = $this->parsePathVariables($this->modx->getOption('redactor.predefinedLinks', null, '')); // #predefinedLinks
        
        if(!empty($this->modx->getOption('redactor.replaceTags', null,'')))  $options['replaceTags'] = $this->modx->getOption('redactor.replaceTags', null,'');
        if(!empty($this->modx->getOption('redactor.replaceStyles', null,''))) $options['replaceStyles'] = $this->modx->getOption('redactor.replaceStyles', null,'');
        $options['removeDataAttr'] = (bool)$this->modx->getOption('redactor.removeDataAttr', null,false);
        if(!empty($this->modx->getOption('redactor.removeAttr', null,''))) $options['removeAttr'] = $this->modx->getOption('redactor.removeAttr', null,'');
        if(!empty($this->modx->getOption('redactor.allowedAttr', null,''))) $options['allowedAttr'] = $this->modx->getOption('redactor.allowedAttr', null,'');
        $options['replaceDivs'] = (bool)$this->modx->getOption('redactor.replaceDivs', null,true);
        $options['preSpaces'] = is_numeric($this->modx->getOption('redactor.preSpaces', null,'4')) ? $this->modx->getOption('redactor.preSpaces', null,'4') : false;

        /**
         * File/image uploads and handling
         */
        $options['uploadFields'] = $this->modx->getOption('redactor.uploadFields', null, '');
        $options['autosave'] = (bool)$this->modx->getOption('redactor.autosave', null, false);
        $options['interval'] = (int)$this->modx->getOption('redactor.interval', null, 60);

        $resource = ($this->resource > 0) ? '&resource='.$this->resource : '';
        $options['fileManagerJson'] = $this->config['connectorUrl'] . '?action=media/browsefiles&HTTP_MODAUTH=' . $this->modx->user->getUserToken('mgr').$resource;
        $options['imageManagerJson'] = $this->config['connectorUrl'] . '?action=media/browse&HTTP_MODAUTH=' . $this->modx->user->getUserToken('mgr').$resource;
        $options['imageUpload'] = $this->config['connectorUrl'] . '?action=media/uploadimage&HTTP_MODAUTH=' . $this->modx->user->getUserToken('mgr').$resource;
        $options['fileUpload']  = $this->config['connectorUrl'] . '?action=media/upload&HTTP_MODAUTH=' . $this->modx->user->getUserToken('mgr').$resource;

        $options['clipboardUploadUrl'] = $options['imageUpload'];

        $options['marginFloatLeft'] = $this->modx->getOption('redactor.marginFloatLeft', null, '0 10px 10px 0');
        $options['marginFloatRight'] = $this->modx->getOption('redactor.marginFloatRight', null, '0 0 10px 10px');

        $options['linkResource'] = (bool)$this->modx->getOption('redactor.linkResource', null, true);
        $options['browseFiles'] = (bool)$this->modx->getOption('redactor.browse_files', null, false);
        $options['searchImages'] = (bool)$this->modx->getOption('redactor.searchImages', null, false);

        $options['dragUpload'] = (bool)$this->modx->getOption('redactor.dragUpload', null, false);
        $options['convertImageLinks'] = (bool)$this->modx->getOption('redactor.convertImageLinks', null, false);
        $options['convertVideoLinks'] = (bool)$this->modx->getOption('redactor.convertVideoLinks', null, false);
        
        $options['dragImageUpload'] = (bool)$this->modx->getOption('redactor.allowedAttr', null,true);
        $options['dragFileUpload'] = (bool)$this->modx->getOption('redactor.dragFileUpload', null,true);
        
        $options['imageEditable'] = (bool)$this->modx->getOption('redactor.imageEditable', null,true);
        $options['imageResizable'] = (bool)$this->modx->getOption('redactor.imageResizable', null,true);
        
        $options['limiter'] = (bool)$this->modx->getOption('redactor.limiter', null,false);
        
        $options['textexpander'] = ($this->modx->getOption('redactor.textexpander', null, ''));
        
        $options['speechVoice'] = ($this->modx->getOption('redactor.speechVoice', null, 'Vicki'));
        $options['speechRate'] = ($this->modx->getOption('redactor.speechRate', null, 1));
        $options['speechPitch'] = ($this->modx->getOption('redactor.speechPitch', null, 1));
        $options['speechVolume'] = ($this->modx->getOption('redactor.speechVolume', null, 1));
        $options['counterWPM'] = ($this->modx->getOption('redactor.counterWPM', null, 275));

        $clipsJson = $this->modx->getOption('redactor.clipsJson', null, '');
        $stylesJson = $this->modx->getOption('redactor.stylesJson',null,'');
        $formattingAddJson = $this->modx->getOption('redactor.formattingAdd', null,'');
        $shortcutsAddJson = $this->modx->getOption('redactor.shortcutsAdd', null, '');

         // make it picky and not breaky
        if($this->modx->fromJSON($clipsJson)) {
            $options['clipsJson'] = $clipsJson;
        }
        if($this->modx->fromJSON($stylesJson)) {
            $options['stylesJson'] = $stylesJson;
        }
        if($this->modx->fromJSON($formattingAddJson)) {
            $options['formattingAdd'] = $formattingAddJson;
        }
        
        if($this->modx->fromJSON($shortcutsAddJson)) {
            $options['shortcutsAdd'] = $shortcutsAddJson;
        }        

        $plugins = array();
        $pluginFiles = array($this->assetsUrl . "lib/typeahead.js");
        
        if($this->modx->getOption('redactor.buttonFullScreen',null, true)) {
            $plugins[] = 'fullscreen';
            $pluginFiles[] = $this->assetsUrl . 'lib/fullscreen.js';
        }
        
        if(!empty($this->modx->getOption('redactor.predefinedLinks',null, ''))) {
            $plugins[] = 'definedlinks';
            $pluginFiles[] = $this->assetsUrl . 'lib/definedlinks.js';
        }
        
        if(!empty($this->modx->getOption('redactor.textexpander',null, ''))) {
            $plugins[] = 'textexpander';
            $pluginFiles[] = $this->assetsUrl . 'lib/textexpander.js';
        }
        
        if((bool)$this->modx->getOption('redactor.wym', null,false)) {
            $plugins[] = 'wym';
        }

        $options['plugin_files'] = '';

        if(isset($options['clipsJson'])) {
            $plugins[] = 'clips';
            $pluginFiles[] = $this->assetsUrl . 'lib/clips.js';
        }
        if(isset($options['stylesJson'])) {
            $plugins[] = 'styles';
            $pluginFiles[] = $this->assetsUrl . 'lib/styles.js';
        }
        
        if($this->loadAce) {
            $plugins[] = 'syntax'; 
            $pluginFiles[] = $this->assetsUrl . 'lib/syntax.js';
            $options['aceTheme'] = ($this->modx->getOption('redactor.syntax_aceTheme', null, 'ace/theme/monokai'));
            $options['aceMode'] = ($this->modx->getOption('redactor.syntax_aceMode', null, 'ace/mode/html'));
        }

        // 3pc plugins we allow to be easily included via system settings
        $ps = array('counter','filemanager','fontcolor','fontfamily','fontsize','imagemanager','limiter','table','textdirection','video','speek','contrast','download','zoom');
        foreach($ps as $p) {
            if((bool)$this->modx->getOption("redactor.plugin_$p", null, false)) {
                $pluginFiles[] = $this->assetsUrl . "lib/$p.js";
                $plugins[] = $p;
            }
        }
        
        if((bool)$this->modx->getOption('redactor.plugin_replacer', null, true)) {
            $pluginFiles[] = $this->assetsUrl . 'lib/replacer.js';
            $plugins[] = 'replacer';
        }
        
        $additionalPlugins = $this->explode($this->modx->getOption('redactor.additionalPlugins', null, ''));
        if (!empty($additionalPlugins)) {
            foreach ($additionalPlugins as $pluginDefinition) {
                $pluginDefinition = explode(':', $pluginDefinition);
                if (isset($pluginDefinition[0])) $plugins[] = $pluginDefinition[0];
                if (isset($pluginDefinition[1])) $pluginFiles[] = implode(':', array_slice($pluginDefinition,1 ));
            }
        }
        
        $plugins = array_unique($plugins);
        $plugins = array_filter(array_map('trim',$plugins));

        if (!empty($pluginFiles)) {
            foreach ($pluginFiles as $file) {
                $options['plugin_files'] .= '<script type="text/javascript" src="'.$file.'"></script>';
            }
        }
        
        //$options['toolbarFixedTopOffset'] = ($this->degradeUI) ? 78 : 55; 
        $plugins[] = 'modmore';
        if(count($plugins) > 0) $options['plugins'] = $plugins;
        return $options;
    }

    /**
     * Loads the various required assets into the controller.
     */
    public function initialize() {
        if (!$this->assetsLoaded) {
            $this->modx->controller->addLexiconTopic('redactor:default');
            $this->modx->controller->addCSS($this->config['assetsUrl'].'redactor-1.6.0.min.css');
            if($this->degradeUI) $this->modx->controller->addCSS($this->config['assetsUrl'].'buttons-legacy.min.css');
            if($this->rebeccaDay) $this->modx->controller->addCSS($this->config['assetsUrl'].'rebecca.min.css');
            $this->modx->controller->addJavascript($this->config['assetsUrl'].'redactor-1.6.0.min.js');
            if($this->loadAce) $this->modx->controller->addJavascript('https://cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js');
        }
        $this->assetsLoaded = true;
    }
    
    /**
    * Parses supported Redactor Path Tags into their appropriate values
    */
    public function parsePathVariables($path) {
        $path = str_replace('[[+year]]', date('Y'), $path);
        $path = str_replace('[[+month]]', date('m'), $path);
        $path = str_replace('[[+date]]', date('d'), $path);
        $path = str_replace('[[+day]]', date('d'), $path);
        $path = str_replace('[[+user]]', $this->modx->getUser()->get('id'), $path);
        $path = str_replace('[[+username]]', $this->modx->getUser()->get('username'), $path);
        $path = str_replace('[[++assets_url]]', $this->modx->getOption('assets_url', null, 'assets/'), $path);
        $path = str_replace('[[++site_url]]', $this->modx->getOption('site_url', null, ''), $path);

        foreach ($this->pathVariables as $key => $value) {
            $path = str_replace('[[+'.$key.']]', $value, $path);
        }
        return $path;
    }
    
    /**
    * Parses supported CSS 4 color shortcuts, such as rebeccapurple
    */
    public function processColor($color) {
        $color = str_replace('rebeccapurple','#663399',$color);
        return $color;
    }

    /**
     * Explodes a string into an array based on the $separator, trimming the array as well.
     *
     * @param string $string The string to split up.
     * @param string $separator The separator between items. Defaults to a comma.
     *
     * @return array
     */
    public function explode($string, $separator = ',') {
        if ($string === false) return $string;
        $array = explode($separator, $string);
        return array_map('trim', $array);
    }

    /**
    * Gets a file-based template.
    *
    * @author Shaun McCormick
    * @access public
    * @param string $name The name of the Chunk
    * @param array $properties The properties for the Chunk
    * @return string The processed content of the Chunk
    */
    public function getTpl($name,$properties = array()) {
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
     * Returns a <style> tag for the custom styles.
     *
     * @return bool|string
     */
    public function getCustomStyles() {
        $stylesJson = $this->modx->getOption('redactor.stylesJson',null,'');
        $styles = $this->modx->fromJSON($stylesJson);
        if(!$styles || (count($styles) < 1))  return false;

        $inlineStyle = '<style type="text/css">';
        foreach($styles as $style) {
            $className = $style['className'];
            $cssProps = $style['style'];
            $inlineStyle .= ".redactor_dropdown .$className { $cssProps }";
        }
        $inlineStyle .= '</style>'; 

        return $inlineStyle;
    }

    /**
     * Prepares a <script> tag for custom styles, or returns false.
     *
     * @return bool|string
     */
    public function getCustomStylesJson() {
        $stylesJson = $this->modx->getOption('redactor.stylesJson',null,'');
        $styles = $this->modx->fromJSON($stylesJson);
        if(!$styles || (count($styles) < 1))  return false;
        
        return '<script>var redStylesJSON = '.$stylesJson.';</script>';
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
    private function _getTplChunk($name,$postFix = '.tpl') {
        $chunk = false;
        $f = $this->config['templatePath'].strtolower($name).$postFix;
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
     * Gets the HTML that needs to be injected into the page for instantiating Redactor.
     *
     * @param array $options
     *
     * @return string
     */
    public function getHtml(array $options = array())
    {
        $options = array_merge($this->config, $this->getGlobalOptions(), $options);
        $options['optionsJson'] = $this->modx->toJSON($options);

        /**
         * Inject stuff in to the head to call Redactor.
         */
        $this->modx->controller->addLexiconTopic('redactor:default');

        if (!empty($options['lang']) && ($options['lang'] != 'en')) {
            $options['langFile'] = $this->config['assetsUrl'] . 'lang/' . $options['lang'] . '.js';
        } else { $options['langFile'] = ''; }

        $html = $this->getTpl('editor', $options);
        $styles = $this->getCustomStyles();
        $stylesJSON = $this->getCustomStylesJson();

        return $html.$styles.$stylesJSON;
    }

    /**
     * @param int|modResource $resource
     */
    public function setResource($resource)
    {
        if (is_numeric($resource)) {
            $resource = $this->modx->getObject('modResource', $resource);
        }

        if ($resource instanceof modResource) {
            $this->resource = $resource->get('id');
            $this->setPathVariables(array(
                'id' => $resource->get('id'),
                'pagetitle' => $resource->get('pagetitle'),
                'alias' => $resource->get('alias'),
                'context_key' => $resource->get('context_key')
            ));
            if((bool)$this->modx->getOption('redactor.parse_parent_path',null,true) && $parent = $resource->getOne('Parent')) {
                $this->setPathVariables(array(
                    'parent' => $parent->get('id'),
                    'parent_alias' => $parent->get('alias'),
                ));
                $pids = $this->modx->getParentIds($resource->get('id'), (int)$this->modx->getOption('redactor.parse_parent_path_height', null,10), array('context' => $resource->get('context_key')));
                $ultimateParent = $this->modx->getObject('modResource', $pids[count($pids)-2]);

                if(isset($ultimateParent)) {
                    $this->setPathVariables(array(
                        'ultimate_parent' => $ultimateParent->get('id'),
                        'ultimate_alias' => $ultimateParent->get('alias'),
                    ));
                } else {
                    $this->setPathVariables(array(
                        'ultimate_parent' => '',
                        'ultimate_alias' => ''
                    ));
                }
            } else {
                $this->setPathVariables(array(
                    'parent' => '',
                    'alias' => '',
                    'ultimate_parent' => '',
                    'ultimate_alias' => ''
                ));
            }
        }
    }

    /**
     * Sets path variables which are processed in the upload/browse paths.
     * @param array $array
     */
    public function setPathVariables(array $array = array())
    {
        $this->pathVariables = array_merge($this->pathVariables, $array);
    }
}
