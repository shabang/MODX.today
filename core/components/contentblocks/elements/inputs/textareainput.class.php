<?php
/**
 * Class TextareaInput
 *
 * @author Mark Hamstra
 * @package contentblocks
 */
class TextareaInput extends cbBaseInput {
    public $defaultIcon = 'paragraph';
    public $defaultTpl = '<p>[[+value]]</p>';
    /**
     * @return array
     */
    public function getTemplates()
    {
        $tpls = array();
        $tpls[] = $this->contentBlocks->getCoreInputTpl('textarea');
        return $tpls;
    }

}
