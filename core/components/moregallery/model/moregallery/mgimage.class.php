<?php
/**
 * Class mgImage
 */
class mgImage extends xPDOSimpleObject
{
    const MODE_UPLOAD = 'upload';
    const MODE_IMPORT = 'import';

    public function get($k, $format = null, $formatTemplate= null)
    {
        $value = parent::get($k, $format, $formatTemplate);

        switch ($k)
        {
            case 'width':
            case 'height':
                if ($value < 1)
                {

                    $resource = $this->getResource();
                    if ($resource && $resource->_getSource()) {
                        $relativeUrl = $resource->getSourceRelativeUrl();
                        $filePath = $resource->source->getBasePath().$relativeUrl. $this->get('file');
                        $size = getimagesize($filePath);

                        $width = $size[0];
                        $height = $size[1];
                        $this->set('width', $width);
                        $this->set('height', $height);
                        if (!$this->isNew())
                        {
                            $this->save();
                        }

                        $value = $$k;
                    }
                }
                break;
        }

        return $value;
    }

    public function getCropsAsArray()
    {
        $array = array();
        $crops = $this->getCrops();

        /** @var mgImageCrop $crop */
        foreach ($crops as $key => $crop)
        {
            $array[$key] = $crop->toArray();
        }

        return $array;
    }

    /**
     * Grabs (and creates) crops for an image.
     *
     * @return array
     */
    public function getCrops()
    {
        /**
         * Grab source and relative url info for creating thumbs if necessary
         */
        $resource = $this->getResource();
        $source = false;
        $relativeUrl = '';
        if ($resource && $source = $resource->_getSource()) {
            $relativeUrl = $resource->getSourceRelativeUrl();
        }

        /**
         * Grab the crops definitions so we can prepare a $crops array with the crop objects
         */
        $cropDefinition = $this->xpdo->moregallery->getCrops($resource);
        $crops = array();
        foreach ($cropDefinition as $key => $options)
        {
            $crops[$key] = false;
        }

        /**
         * Grab all crops for this image from the database, and loop over them to add them to $crops
         * but also to get rid of any that isn't used (e.g. after changing the crops setting)
         *
         * @var array $existingCrops
         */
        $existingCrops = $this->xpdo->getCollection('mgImageCrop', array('image' => $this->get('id')));
        /** @var mgImageCrop $cropObject */
        foreach ($existingCrops as $cropObject)
        {
            $cropKey = $cropObject->get('crop');
            if (isset($crops[$cropKey]))
            {
                $url = $cropObject->getThumb($source, $relativeUrl);
                $cropObject->set('thumbnail_url', $url);
                $path = $cropObject->getThumb($source, $relativeUrl, true);
                $cropObject->set('thumbnail_path', $path);
                $crops[$cropKey] = $cropObject;
            }
            else
            {
                $cropObject->remove();
            }
        }

        /**
         * Loop over the collected crops to make sure all mgImageCrop objects have been loaded
         * and create the ones that don't exist yet.
         */
        foreach ($crops as $key => $crop)
        {
            if ($crop === false)
            {
                /** @var mgImageCrop $crop */
                $crop = $this->xpdo->newObject('mgImageCrop');
                $crop->fromArray(
                    array(
                        'image' => $this->get('id'),
                        'crop' => $key,
                    )
                );
                $crop->getThumb($source, $relativeUrl);
                $url = $crop->getThumb($source, $relativeUrl);
                $crop->set('thumbnail_url', $url);
                $path = $crop->getThumb($source, $relativeUrl, true);
                $crop->set('thumbnail_path', $path);
                $crop->save();
                $crops[$key] = $crop;
            }
        }

        return $crops;
    }

    /**
     * @param string $keyPrefix
     * @param bool $rawValues
     * @param bool $excludeLazy
     * @param bool $includeRelated
     *
     * @return array
     */
    public function toArray($keyPrefix= '', $rawValues= false, $excludeLazy= false, $includeRelated= false) {
        $array = parent::toArray($keyPrefix, $rawValues, $excludeLazy, $includeRelated);

        $resource = $this->getResource();
        if ($resource && $resource->_getSource()) {
            $relativeUrl = $resource->getSourceRelativeUrl();
            $array['mgr_thumb_path'] = $resource->source->getBasePath().$relativeUrl.$array['mgr_thumb'];
            $array['mgr_thumb'] = $resource->source->getObjectUrl($relativeUrl.$array['mgr_thumb']);
            $array['file_url'] = $resource->source->getObjectUrl($relativeUrl.$array['file']);
            $array['file_path'] = $resource->source->getBasePath().$relativeUrl.$array['file'];
            $array['view_url'] = $this->xpdo->makeUrl($resource->get('id'), '', array(
                $this->xpdo->moregallery->getOption('moregallery.single_image_url_param', null, 'iid') => $this->get('id'),
            ), $this->xpdo->moregallery->getOption('link_tag_scheme', null, 'full'));

            $array['_source_is_local'] = ($resource->source->get('class_key') == 'sources.modFileMediaSource');
        }
        return $array;
    }

    /**
     * @return mgResource|null
     */
    public function getResource() {
        $id = $this->get('resource');
        return $this->xpdo->moregallery->getResource($id);
    }

    /**
     * Removes files along with the image record.
     * 
     * @param array $ancestors
     *
     * @return bool
     */
    public function remove (array $ancestors = array ()) {
        $resource = $this->getResource();
        if ($resource && $resource->_getSource()) {
            $relativeUrl = $resource->getSourceRelativeUrl();
            $resource->source->removeObject($relativeUrl.$this->get('mgr_thumb'));
            $resource->source->removeObject($relativeUrl.$this->get('file'));

            $crops = $this->getCrops();
            /** @var mgImageCrop $crop */
            foreach ($crops as $crop)
            {
                $resource->source->removeObject($relativeUrl . $crop->get('thumbnail'));
            }

            if ($resource->source->hasErrors()) {
                $errors = $resource->source->getErrors();
                $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Error(s) while removing file(s) for mgImage ' . $this->toJSON() . ':' . implode("\n", $errors));
            }
        }


        $this->clearCache();
        
        return parent::remove($ancestors);
    }

    /**
     * @param null $cacheFlag
     *
     * @return bool
     */
    public function save($cacheFlag= null) {
        if ($this->isNew()) {
            $this->set('uploadedon', time());
            $this->set('uploadedby', $this->xpdo->user ? $this->xpdo->user->get('id') : 0);
        } else {
            $this->set('editedon', time());
            $this->set('editedby', $this->xpdo->user ? $this->xpdo->user->get('id') : 0);
        }
        $saved = parent::save($cacheFlag);
        $this->clearCache();
        return $saved;
    }

    public function clearCache() {
        $cacheOptions = array(xPDO::OPT_CACHE_KEY => 'moregallery');
        $resource = $this->get('resource');

        $this->xpdo->cacheManager->delete('mgimage/'.$resource.'/', $cacheOptions);
        $this->xpdo->cacheManager->delete('mgimages/'.$resource.'/', $cacheOptions);
    }

    /**
     * Gets the image before this one.
     *
     * @param string $sortBy
     *
     * @param bool $activeOnly
     * @return null|object
     */
    public function getPrevious($sortBy = 'sortorder', $activeOnly = true) {
        $c = $this->xpdo->newQuery('mgImage');
        $c->where(array(
            'resource' => $this->get('resource'),
            'AND:'.$sortBy.':<' => $this->get($sortBy),
        ));
        if ($activeOnly)
        {
            $c->where(array('active' => true));
        }
        $c->sortby($sortBy, 'DESC');
        $c->limit(1);

        return $this->xpdo->getObject('mgImage', $c);
    }

    /**
     * Gets the image after this one.
     *
     * @param string $sortBy
     *
     * @param bool $activeOnly
     * @return null|object
     */
    public function getNext($sortBy = 'sortorder', $activeOnly = true) {
        $c = $this->xpdo->newQuery('mgImage');
        $c->where(array(
            'resource' => $this->get('resource'),
            'AND:'.$sortBy.':>' => $this->get($sortBy),
        ));
        if ($activeOnly)
        {
            $c->where(array('active' => true));
        }
        $c->sortby($sortBy, 'ASC');
        $c->limit(1);

        return $this->xpdo->getObject('mgImage', $c);
    }

    /**
     * @return array|mixed
     */
    public function getTags() {
        $co = array(xPDO::OPT_CACHE_KEY => 'moregallery');
        $tags = $this->xpdo->cacheManager->get('tags/image/'.$this->get('id'), $co);
        if (is_array($tags)) return $tags;

        $tags = array();
        $c = $this->xpdo->newQuery('mgTag');
        $c->innerJoin('mgImageTag', 'Images');
        $c->where(array(
            'Images.image' => $this->get('id'),
        ));
        /** @var mgTag $tag */
        foreach ($this->xpdo->getIterator('mgTag', $c) as $tag) {
            $tags[] = $tag->toArray();
        }

        $this->xpdo->cacheManager->set('tags/image/' . $this->get('id'), $tags, 0, $co);
        return $tags;
    }

    /**
     * Resize the image to a smaller one for use as mgr_thumb
     *
     * @param $content
     * @param int $width
     * @param int $height
     * @return bool|string
     */
    public function createThumbnail($content, $width = 250, $height = 250) {
        try {
            require_once dirname(dirname(dirname(__FILE__))).'/model/phpthumb/ThumbLib.inc.php';
            $thumb = PhpThumbFactory::create($content, array(), true);
            $thumb->setFormat('PNG');
            $thumb->resize($width, $height);
            $thumbContents = $thumb->getImageAsString();


            $mgrThumb = $this->get('id') . '_' . md5($this->toJSON()) . '.png';

            $resource = $this->getResource();
            $resource->_getSource();
            $path = $resource->getSourceRelativeUrl();

            $resource->source->createContainer($path . '_thumbs/' , '/');
            $resource->source->errors = array();
            $resource->source->createObject($path . '_thumbs/', $mgrThumb, $thumbContents);
            $this->set('mgr_thumb', '_thumbs/' . $mgrThumb);
            return true;
        } catch (Exception $e) {
            $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moreGallery] Exception while creating mgr_thumb: ' . $e->getMessage());
            return $e->getMessage();
        }
    }
    
    public function loadExifData($file) {
        if (function_exists('exif_read_data')) {
            try {
                // Fetch EXIF data if we have it.
                $exif = exif_read_data($file, NULL, false, false);
                if (is_array($exif)) $this->set('exif', $exif);
            } catch (Exception $e) {
                $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moreGallery] Exception while trying to read exif data: ' . $e->getMessage());
            }
        } else {
            $this->xpdo->log(xPDO::LOG_LEVEL_WARN, '[moreGallery] This server does not have the exif_read_data function installed. MoreGallery cannot extract exif data now.');
        }
    }

    /**
     * @param $content
     * @param $orientation
     * @return bool|string
     */
    public function fixOrientation($content, $orientation)
    {

        try {
            require_once dirname(dirname(dirname(__FILE__))).'/model/phpthumb/ThumbLib.inc.php';
            $thumb = PhpThumbFactory::create($content, array(), true);
            $thumb->setFormat('PNG');

            $degrees = 0;
            switch ($orientation)
            {
                case 3:
                    $degrees = 180;
                    break;
                case 6:
                    $degrees = 270;
                    break;
                case 8:
                    $degrees = 90;
                    break;
            }
            if ($degrees > 0)
            {
                $thumb->rotateImageNDegrees($degrees);
                return $thumb->getImageAsString();
            }
        } catch (Exception $e) {
            $this->xpdo->log(xPDO::LOG_LEVEL_ERROR, '[moreGallery] Exception while creating mgr_thumb: ' . $e->getMessage());
        }
        return false;
    }
}
