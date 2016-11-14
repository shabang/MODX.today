<?php
/**
 * Removes a cbLayout object.
 */
class cbLayoutRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'cbLayout';
    public $objectType = 'cbLayout';
    public $permission = 'contentblocks_layouts_delete';
}
return 'cbLayoutRemoveProcessor';
