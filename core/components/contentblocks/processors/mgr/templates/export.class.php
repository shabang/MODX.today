<?php
require_once dirname(dirname(__FILE__)) . '/export.class.php';
/**
 * Class cbTemplateExportProcessor
 */
class cbTemplateExportProcessor extends ContentBlocksExportProcessor
{
    public $classKey = 'cbTemplate';
}

return 'cbTemplateExportProcessor';
