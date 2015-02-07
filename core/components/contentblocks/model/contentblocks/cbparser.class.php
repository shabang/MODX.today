<?php

/**
 * Class cbParser
 *
 * Overwritten parser class that has been tweaked to only parse placeholders - nothing more, nothing less.
 * Unfortunately the modParser did not provide the flexibility needed to pre-process ContentBlocks content safely,
 * so the custom parser is required.
 */
class cbParser extends modParser {

    /**
     * Hardcodes the $tokens variable to [+], to only allow parsing placeholders.
     *
     * {@inherit}
     */
    public function processElementTags($parentTag, & $content, $processUncacheable= false, $removeUnprocessed= false, $prefix= "[[", $suffix= "]]", $tokens= array (), $depth= 0) {
        // Only placeholders are allowed, like, ever.
        $tokens = array('+');
        return parent::processElementTags($parentTag, $content, $processUncacheable, $removeUnprocessed, $prefix, $suffix, $tokens, $depth);
    }
}
