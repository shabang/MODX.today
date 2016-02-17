<?php
/**
 * Class CodeInput
 *
 * Displays a fancy Ace-powered syntax highlighter.
 *
 * @author Mark Hamstra
 * @package contentblocks
 */
class CodeInput extends cbBaseInput {
    public $defaultIcon = 'code';
    public $defaultTpl = '<pre><code class="language-[[+lang]]">[[+value]]</code></pre>';

    /**
     * @return array
     */
    public function getFieldProperties()
    {
        return array(
            array(
                'key' => 'available_languages',
                'fieldLabel' => $this->modx->lexicon('contentblocks.code.available_languages'),
                'xtype' => 'textfield',
                'default' => 'html=HTML,javascript=JavaScript,css=CSS,php=PHP',
                'description' => $this->modx->lexicon('contentblocks.code.available_languages.description')
            ),
            array(
                'key' => 'default_language',
                'fieldLabel' => $this->modx->lexicon('contentblocks.code.default_language'),
                'xtype' => 'textfield',
                'default' => 'html',
                'description' => $this->modx->lexicon('contentblocks.code.default_language.description')
            ),
            array(
                'key' => 'entities',
                'fieldLabel' => $this->modx->lexicon('contentblocks.code.entities'),
                'xtype' => 'contentblocks-combo-boolean',
                'default' => '0',
                'description' => $this->modx->lexicon('contentblocks.code.entities.description')
            ),
        );
    }

    /**
     * @return array
     */
    public function getJavaScripts() {
        $aceIsInstalled = (bool)$this->modx->getCount('modPlugin', array(
            'name' => 'Ace',
            'disabled' => false,
        ));
        $aceIsUsed = ($this->contentBlocks->getOption('which_element_editor') == 'Ace');

        $js = array();
        if (!$aceIsInstalled || !$aceIsUsed) {
            $js[] = $this->contentBlocks->config['assetsUrl'] . 'js/vendor/9cloud/ace/ace.js';
        }

        if ($this->contentBlocks->debug) {
            $js[] = $this->contentBlocks->config['assetsUrl'] . 'js/inputs/code.js';
        }
        else {
            $js[] = $this->contentBlocks->config['assetsUrl'] . 'js/inputs/code-min.js';
        }
        return $js;
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        $tpls = array();
        $tpls[] = $this->contentBlocks->getCoreInputTpl('code');
        return $tpls;
    }

    /**
     * Process this field based on its template and the received data.
     *
     * @param cbField $field
     * @param array $data
     * @return mixed
     */
    public function process(cbField $field, array $data = array())
    {
        $tpl = $field->get('template');

        if ((bool)$field->get('entities')) {
            $data['value'] = htmlentities($data['value'], ENT_QUOTES, 'UTF-8');
            $data['value'] = str_replace(array('[',']'), array('&#91;','&#93;'), $data['value']);
       }

        // Always encode [[+value]] as if we don't, it throws an infinite loop
        $data['value'] = str_replace('[[+value', '&#91;[+value', $data['value']);
        return $this->contentBlocks->parse($tpl, $data);
    }

}
