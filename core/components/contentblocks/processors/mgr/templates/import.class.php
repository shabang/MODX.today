<?php
require_once dirname(dirname(__FILE__)) . '/import.class.php';
/**
 * Class cbTemplateImportProcessor
 */
class cbTemplateImportProcessor extends ContentBlocksImportProcessor
{
    public $classKey = 'cbTemplate';
    /**
     * Checks if the user has sufficient permissions to perform this action.
     *
     * @return bool
     */
    public function checkPermissions()
    {
        return $this->modx->context->checkPolicy('contentblocks_templates_import');
    }
}

return 'cbTemplateImportProcessor';
