<?php

/**
 * @package moreGallery
 */
class mgImageUpdateProcessor extends modObjectUpdateProcessor {
    public $classKey = 'mgImage';

    /**
     * Unset bunch of properties we don't want touched.
     *
     * @return bool
     */
    public function beforeSet() {
        $this->unsetProperty('mgr_thumb');
        $this->unsetProperty('file_url');
        $this->unsetProperty('exif');

        $active = $this->getProperty('active');
        if (!is_bool($active))
        {
            $active = ($active === 'true');
            $this->setProperty('active', $active);
        }

        $crops = $this->getProperty('crops');
        $crops = $this->modx->fromJSON($crops);
        if (is_array($crops))
        {
            $cropObjects = $this->object->getCrops();
            foreach ($crops as $name => $values)
            {
                if (isset($cropObjects[$name]))
                {
                    $cropObjects[$name]->fromArray($values);
                    if (!empty($cropObjects[$name]->_dirty))
                    {
                        $cropObjects[$name]->save();
                    }
                }
            }
            $this->setProperty('crops', $crops);
        }

        $this->setProperty('editedon', time());
        $this->setProperty('editedby', $this->modx->user ? $this->modx->user->get('id') : 0);

        return parent::beforeSet();
    }


    /**
     * Return the success message
     * @return array
     */
    public function cleanup() {
        $array = $this->object->toArray();
        unset($array['action']);
        unset($array['cid']);
        unset($array['exif']);
        $array['crops'] = $this->modx->toJSON($this->object->getCropsAsArray(true));
        return $this->modx->toJSON($array);
    }
}

return 'mgImageUpdateProcessor';
