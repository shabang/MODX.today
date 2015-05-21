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

        $sort = (int)$this->getProperty('sortorder', 0);
        if ($sort < 1) {
            $sort = $this->modx->getCount($this->classKey) + 1;
            $this->setProperty('sortorder', $sort);
        }
        return parent::beforeSet();
    }
}
return 'cbFieldCreateProcessor';
