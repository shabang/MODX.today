<?php
require_once dirname(dirname(__FILE__)) . '/import.class.php';
/**
 * Class cbFieldImportProcessor
 */
class cbFieldImportProcessor extends ContentBlocksImportProcessor
{
    public $classKey = 'cbField';

    /**
     * Removes existing records in "replace" mode, limited to the current parentc
     */
    public function removeCollection()
    {
        $parent = (int)$this->getProperty('parent', 0);
        $this->modx->removeCollection($this->classKey, array(
            'parent' => $parent,
        ));
    }
}

return 'cbFieldImportProcessor';
