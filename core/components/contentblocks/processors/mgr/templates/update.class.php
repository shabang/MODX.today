<?php
/**
 * Updates a cbTemplate object
 */
class cbTemplateUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'cbTemplate';
    public $languageTopics = array('contentblocks:default');

    /**
     * @return bool
     */
    public function beforeSet() {
        return parent::beforeSet();
    }
}
return 'cbTemplateUpdateProcessor';
