<?php
/**
 * Creates a cbTemplate object.
 */
class cbTemplateCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'cbTemplate';
    public $languageTopics = array('contentblocks:default');

    public function beforeSet() {
        return parent::beforeSet();
    }
}
return 'cbTemplateCreateProcessor';
