<?php
/**
 * Creates a mgImageTag object.
 */
class mgImageTagCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'mgImageTag';
    public $languageTopics = array('reviews:default');

    /**
     * Before setting, check the value for "tag".
     * @return bool
     */
    public function beforeSet() {
        $tag = $this->getProperty('tag');
        if (!is_numeric($tag)) {
            $tagObj = $this->modx->getObject('mgTag', array(
                'display' => $tag
            ));
            if ($tagObj) {
                $this->setProperty('tag', $tagObj->get('id'));
            }
            else {
                $tagObj = $this->modx->newObject('mgTag');
                $tagObj->fromArray(array(
                    'display' => $tag,
                    'createdon' => time(),
                    'createdby' => ($this->modx->user) ? $this->modx->user->get('id') : 0,
                ));
                if ($tagObj->save()) {
                    $this->setProperty('tag', $tagObj->get('id'));

                    $this->modx->invokeEvent('MoreGallery_OnTagCreate',
                        array(
                            'id' => $this->object->get('id'),
                            'tag' => $tag,
                            'object' => &$this->object,
                        )
                    );
                }
                else {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error saving new mgTag object: ' . $tagObj->toJSON());
                    return false;
                }
            }
        }

        return parent::beforeSet();
    }

    /**
     * Return the success message
     * @return array
     */
    public function cleanup() {
        $obj = $this->object->toArray();
        $tag = $this->object->getOne('Tag');
        if ($tag) {
            $obj = array_merge($obj, $tag->toArray('tag_'));

            $this->modx->invokeEvent('MoreGallery_OnImageTagCreate',
                array(
                    'id' => $this->object->get('id'),
                    'tag' => $tag,
                    'object' => &$this->object,
                )
            );
        }
        return $this->modx->toJSON($obj);
    }

}
return 'mgImageTagCreateProcessor';
