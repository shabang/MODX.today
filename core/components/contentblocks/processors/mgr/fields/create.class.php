<?php
/**
 * Creates a cbField object.
 */
class cbFieldCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'cbField';
    public $languageTopics = array('moreprovider:default');

    /**
     * @return bool
     */
    public function beforeSet() {
        $prop = $this->getProperty('properties');
        if (empty($prop)) {
            $this->modx->contentblocks->loadInputs();
            if (isset($this->modx->contentblocks->inputs[$this->getProperty('input')])) {
                /** @var cbBaseInput $input */
                $input = $this->modx->contentblocks->inputs[$this->getProperty('input')];
                $fieldProps = $input->getFieldProperties();

                $prop = array();
                foreach ($fieldProps as $oneProp) {
                    $prop[$oneProp['key']] = $oneProp['default'];
                }
            }
        }
        $prop = $this->modx->toJSON($prop);
        $this->setProperty('properties', $prop);

        $av = $this->getProperty('availability');
        $av = $this->modx->toJSON($av);
        $this->setProperty('availability', $av);
        return parent::beforeSet();
    }
}
return 'cbFieldCreateProcessor';
