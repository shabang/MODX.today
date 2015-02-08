<?php
/**
 * Class mgImageRemoveProcessor
 *
 * @package moreGallery
 * @affects mgImage
 */
class mgImageRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'mgImage';
    public $afterRemoveEvent = 'MoreGallery_OnImageRemove';
}
return 'mgImageRemoveProcessor';
