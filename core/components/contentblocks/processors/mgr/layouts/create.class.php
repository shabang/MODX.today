<?php
/**
 * Creates a cbLayout object.
 */
class cbLayoutCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'cbLayout';
    public $languageTopics = array('contentblocks:default');

    /**
     * @return bool
     */
    public function beforeSet() {
        $this->setCheckbox('layout_only_nested', true);
        return parent::beforeSet();
    }
}
return 'cbLayoutCreateProcessor';
