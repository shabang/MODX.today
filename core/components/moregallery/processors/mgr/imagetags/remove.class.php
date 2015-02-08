<?php
/**
 * Class mgImageTagRemoveProcessor
 *
 * @package moreGallery
 * @affects mgImageTag
 */
class mgImageTagRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'mgImageTag';
    public $afterRemoveEvent = 'MoreGallery_OnImageTagRemove';
}
return 'mgImageTagRemoveProcessor';
