<?php
/**
 * Gets a list of cbTemplate objects.
 */
class cbTemplateGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'cbTemplate';
    public $defaultSortField = 'sortorder';
    public $defaultSortDirection = 'ASC';

    /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object) {
        $array = $object->toArray('', false, true);
        $array['availability'] = $this->modx->fromJSON($array['availability']);
        $array['layouts'] = $this->modx->fromJSON($array['content']);
        return $array;
    }
}
return 'cbTemplateGetListProcessor';
