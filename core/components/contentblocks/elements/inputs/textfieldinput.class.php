<?php
/**
 * Class TextfieldInput
 *
 * @author Mark Hamstra
 * @package contentblocks
 */
class TextfieldInput extends cbBaseInput {
    public $defaultIcon = 'paragraph';
    public $defaultTpl = '<p>[[+value]]</p>';
    /**
     * @return array
     */
    public function getTemplates()
    {
        $tpls = array();
        $tpls[] = $this->contentBlocks->getCoreInputTpl('textfield');
        return $tpls;
    }

}
