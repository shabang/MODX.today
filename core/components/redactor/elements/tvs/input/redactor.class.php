<?php
/**
 * Redactor custom Template Variable
 *
 * Class RedactorInputRender
 */
class RedactorInputRender extends modTemplateVarInputRender {
    /** @var Redactor */
    public $redactor;

    /**
     * Get lexicon topics for this TV.
     * @return array
     */
    public function getLexiconTopics() {
        return array('redactor:default');
    }
    /**
     * @param string $value
     * @param array $params
     * @return void|mixed
     */
    public function render($value, array $params = array()) {
        /**
         * Get the Redactor service class.
         */
        $corePath = $this->modx->getOption('redactor.core_path', null, $this->modx->getOption('core_path').'components/redactor/');
        $this->redactor = $this->modx->getService('redactor', 'Redactor', $corePath . 'model/redactor/');
        if (!($this->redactor instanceof Redactor)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[Redactor] Error loading Redactor service class.');
            return parent::render($value, $params);
        }

        if ($this->modx->resource) {
            $this->redactor->setResource($this->modx->resource);
        }

        /**
         * Get the Redactor configuration on system level, and cleverly merge it with
         * the TV configuration for inheritance and default values.
         */
        $systemOptions = $this->redactor->getGlobalOptions();
        foreach ($params as $key => $value) {
            if (($value == 'inherit' || $value == '') && isset($systemOptions[$key])) {
                $params[$key] = $systemOptions[$key];
            } 

            $systemValue = (isset($systemOptions[$key])) ? $systemOptions[$key] : null;
            $params[$key] = $this->_fixValueType($params[$key], $systemValue);
        }
        $params = array_merge($systemOptions, $params);
        $params['imageGetJson'] = $params['imageGetJson'].'&tv=' . $this->tv->get('id');
        $params['fileGetJson'] = $params['fileGetJson'].'&tv=' . $this->tv->get('id');
        $params['imageUpload'] = $params['imageUpload'].'&tv=' . $this->tv->get('id');
        
        if(isset($params['clipboardUploadUrl'])) $params['clipboardUploadUrl'] = $params['clipboardUploadUrl'].'&tv=' . $this->tv->get('id');
        $params['fileUpload'] = $params['fileUpload'].'&tv=' . $this->tv->get('id');

		if(isset($params['clipsJson']) && !empty($params['clipsJson'])) $params['plugins'][] = "clips";
        else {
            if (in_array('clips', $params['plugins'])) unset($params['plugins'][array_search('clips', $params['plugins'])]);
        }
        
		if(isset($params['stylesJson']) && !empty($params['stylesJson'])) $params['plugins'][] = "styles";
        else {
            if (in_array('styles', $params['plugins'])) unset($params['plugins'][array_search('styles', $params['plugins'])]);
        }
        
		if(isset($params['buttonFullScreen']) && !empty($params['buttonFullScreen'])) $params['plugins'][] = "fullscreen";
        else {
            if (in_array('fullscreen', $params['plugins'])) unset($params['plugins'][array_search('fullscreen', $params['plugins'])]);
        }
        
        $params['plugins'] = array_unique($params['plugins']);
        /**
         * Set placeholders and register CSS/JS files.
         */
        if (!empty($params['lang']) && ($params['lang'] != 'en')) {
            $this->setPlaceholder('langFile', '<script type="text/javascript" src="' . $this->redactor->config['assetsUrl'] . 'lang/' . $params['lang'] . '.js"></script>');
        }
                
        $this->setPlaceholder('assetsUrl', $this->redactor->config['assetsUrl']);
        $this->setPlaceholder('params', $params);
        $this->setPlaceholder('params_json', $this->modx->toJSON($params));
        $this->registerStuff();

        return parent::render($value, $params);
    }

    /**
     * Returns the template path to load.
     * @return string
     */
    public function getTemplate() {
        $corePath = $this->modx->getOption('redactor.core_path', null, $this->modx->getOption('core_path').'components/redactor/');
        return $corePath . 'elements/tvs/tpl/input.tpl';
    }

    /**
     * Makes sure boolean values are boolean, and that array values are exploded properly.
     *
     * @param $value
     * @param $systemValue
     *
     * @return array|bool
     */
    protected function _fixValueType($value, $systemValue) {
        switch (gettype($systemValue)) {
            case 'boolean':
                $value = (bool)$value;
                break;
            case 'array':
                if (!is_array($value)) {
                    $value = $this->redactor->explode($value);
                }
                break;
        }
        return $value;
    }

    protected function registerStuff() {
        $this->modx->controller->addCSS($this->redactor->config['assetsUrl'].'redactor-1.5.4.min.css');
        if($this->redactor->degradeUI) $this->modx->controller->addCSS($this->redactor->config['assetsUrl'].'buttons-legacy.min.css');
        if($this->redactor->rebeccaDay) $this->modx->controller->addCSS($this->redactor->config['assetsUrl'].'rebecca.min.css');
        $this->modx->controller->addJavascript($this->redactor->config['assetsUrl'].'redactor-1.5.4.min.js');
    }
}
return 'RedactorInputRender';
