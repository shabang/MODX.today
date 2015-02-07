<?php
/**
 * Class QuoteInput
 *
 * @author Mark Hamstra
 * @package contentblocks
 */
class QuoteInput extends cbBaseInput {
    public $defaultIcon = 'quote';
    public $defaultTpl = '<blockquote>[[+value]]
    <cite>[[+cite]]</cite>
</blockquote>';
    /**
     * @return array
     */
    public function getTemplates()
    {
        $tpls = array();
        $tpls[] = $this->contentBlocks->getCoreInputTpl('quote');
        return $tpls;
    }

}
