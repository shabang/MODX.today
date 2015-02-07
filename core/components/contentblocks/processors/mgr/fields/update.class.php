<?php
/**
 * Updates a cbField object
 */
class cbFieldUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'cbField';
    public $languageTopics = array('contentblocks:default');

    /**
     * @return bool
     */
    public function beforeSet() {
        $prop = $this->getProperty('properties');
        if (!empty($prop)) {
            $prop = $this->modx->toJSON($prop);
            $this->setProperty('properties', $prop);
        }
        else {
            $this->setProperty('properties', $this->object->get('properties'));
        }
        return parent::beforeSet();
    }
}
return 'cbFieldUpdateProcessor';
