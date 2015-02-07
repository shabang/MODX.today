<?php
/**
 * Gets a list of cbLayout objects.
 */
class cbLayoutGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'cbLayout';
    public $defaultSortField = 'sortorder';
    public $defaultSortDirection = 'ASC';

    /**
     * Can be used to adjust the query prior to the COUNT statement
     *
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c) {
        if($ids = $this->getProperty('ids')) {
            $ids = explode(',', $ids);
            $c->where(array(
                'cbLayout.id:IN' => $ids,
            ));
        }
        return $c;
    }

    /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object) {
        $array = $object->toArray('', false, true);
        $array['columns'] = $this->modx->fromJSON($array['columns']);
        $array['availability'] = $this->modx->fromJSON($array['availability']);
        $array['settings'] = $this->modx->fromJSON($array['settings']);
        return $array;
    }
}
return 'cbLayoutGetListProcessor';
