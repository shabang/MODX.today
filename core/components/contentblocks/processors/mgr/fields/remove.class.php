<?php
/**
 * Removes a cbField object.
 */
class cbFieldRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'cbField';
    public $objectType = 'cbField';
    public $permission = 'contentblocks_fields_delete';
}
return 'cbFieldRemoveProcessor';
