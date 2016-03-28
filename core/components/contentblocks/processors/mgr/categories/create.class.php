<?php
/**
 * Creates a cbCategory object.
 */
class cbCategoryCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'cbCategory';
    public $languageTopics = array('contentblocks:default');

    /**
     * @return bool
     */
    public function beforeSet() {
        $so = $this->getProperty('sortorder');
        if ($so < 1) {
            $so = $this->modx->getCount('cbCategory');
        }
        $this->setProperty('sortorder', $so);
        return parent::beforeSet();
    }
}
return 'cbCategoryCreateProcessor';
