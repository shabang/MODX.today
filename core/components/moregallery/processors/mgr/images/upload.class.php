<?php
/**
 * @package moreGallery
 */
class moreGalleryMgrImagesUploadProcessor extends modObjectCreateProcessor {
    public $classKey = 'mgImage';
    /** @var mgImage */
    public $object;

    public $path = '';
    public $_uploaded = false;

    /** @var mgResource */
    public $resource;

    public $imageErrors = array();


    /**
     * @return array
     */
    public function getLanguageTopics() {
        return array('file', 'moregallery:default');
    }

    /**
     * @return bool|string
     */
    public function beforeSet() {
        $resource = (int)$this->getProperty('resource', 0);
        $this->resource = $this->modx->getObject('modResource', $resource);
        if (!$this->resource || !($this->resource instanceof mgResource)) {
            return $this->modx->lexicon('moregallery.error_invalid_resource', array('resource' => $resource));
        }
        if (!$this->resource->_getSource()) {
            return $this->modx->lexicon('moregallery.error_loading_source');
        }

        $this->path = $this->resource->getSourceRelativeUrl();

        /**
         * Make sure the upload path exists. We unset errors to prevent issues if it already exists.
         */
        $this->resource->source->createContainer($this->path,'/');
        $this->resource->source->errors = array();

        /**
         * Handle getting data for the mgImage.
         */
        $file = reset($_FILES);
        $name = $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        /**
         * Try to load the image name from IPTC data on the image fiel
         */
        try {
            getimagesize($file['tmp_name'], $info);
            if (isset($info["APP13"])) {
                $iptc = iptcparse($info["APP13"]);

                if (is_array($iptc))
                {
                    $iptcCaptionHeaders = array("2#120", "2#105", "2#005");
                    foreach ($iptcCaptionHeaders as $key)
                    {
                        if (isset($iptc[$key]) && !empty($iptc[$key][0]))
                        {
                            $name = $iptc[$key][0];
                        }
                    }
                }
            }
        }
        catch (Exception $e) {}

        $this->setProperty('name', $name);
        $this->setProperty('filename', $fileName . '.' . $fileExtension);
        $this->setProperty('sortorder', $this->modx->getCount('mgImage', array('resource' => $resource)) + 1);
        return parent::beforeSet();
    }

    /**
     * @return bool
     */
    public function afterSave() {
        // Quick fix for some older 2.2 versions where afterSave() would get called more than once.
        if ($this->_uploaded) return true;
        $this->_uploaded = true;

        /** Prefix image ID to the file name to ensure uniqueness. */
        $imageIdPlacement = $this->modx->moregallery->getOption('moregallery.image_id_in_name', null, 'prefix', true);
        foreach ($_FILES as &$file) {
            $id = $this->object->get('id');
            $name = $this->modx->moregallery->sanitizeFileName($file['name']);

            if ($imageIdPlacement == 'prefix') {
                $name = $id . '_' . $name;
            }
            elseif ($imageIdPlacement == 'suffix') {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $name = pathinfo($file['name'], PATHINFO_FILENAME);
                $name = $name . '_' . $id . '.' . $ext;
            }

            $file['name'] = $name;
        }

        /**
         * Do the upload
         */
        $uploaded = $this->resource->source->uploadObjectsToContainer($this->path, $_FILES);
        if (!$uploaded) {
            $errors = $this->resource->source->getErrors();
            $errors = implode('<br />', $errors);
            $this->modx->log(modX::LOG_LEVEL_ERROR,'[moreGallery] Error uploading file: ' . $errors);
            $this->imageErrors[] = $errors;
            $this->object->remove();
            return false;
        }

        /**
         * Add more data to the mgImage object
         */
        $uploadedFile = reset($_FILES);
        $file = $this->resource->source->getObjectContents($this->path . $uploadedFile['name']);
        $this->object->set('file', $file['basename']);

        /**
         * Attempt to increase the memory limit as we're about to do some heavy image stuff
         */
        $before = ini_get('memory_limit');
        $unit = strtoupper(substr($before, -1));
        $number = substr($before, 0, -1);
        $newLimit = $this->modx->moregallery->getOption('moregallery.upload_memory_limit', null, '256M', true);
        $newLimitNumber = substr($newLimit, 0, -1);
        if ($unit !== 'G' && $number < $newLimitNumber) {
            @ini_set('memory_limit', $newLimit);
            $after = ini_get('memory_limit');

            if ($before === $after)
            {
                $this->modx->log(modX::LOG_LEVEL_ERROR, '[moregallery] Attempted to up the memory limit from ' . $before . ' to ' . $newLimit . ', but failed. You may run out of memory while resizing the uploaded image.');
            }
        }

        /**
         * Resize the image to a smaller one. Before we do this, we register a shutdown
         * function that can clean up if the resize fails (for example, because of
         * memory issues).
         */
        register_shutdown_function(array('moreGalleryMgrImagesUploadProcessor', 'onShutdown'), $this);
        $this->object->loadExifData($file['path']);
        $exif = $this->object->get('exif');
        if (is_array($exif) && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            $fixedOrientation = $this->object->fixOrientation($file['content'], $orientation);
            if ($fixedOrientation !== false)
            {
                $file['content'] = $fixedOrientation;
                $this->resource->source->updateObject($this->path . $uploadedFile['name'], $fixedOrientation);
            }
        }
        $this->object->createThumbnail($file['content']);

        // Save again; we added some more details.
        $this->object->save();

        /**
         * Invoke the MoreGallery_OnImageAdd event so people can hook into this for doing stuff on upload.
         */
        $this->modx->invokeEvent('MoreGallery_OnImageCreate',
            array(
                'id' => $this->object->get('id'),
                'object' => &$this->object,
                'mode' => mgImage::MODE_UPLOAD,
                'resource' => &$this->resource,
            )
        );
        return parent::afterSave();
    }

    /**
     * Return the success message
     * @return array
     */
    public function cleanup() {
        if (empty($this->imageErrors)) {
            // Set the mgr_thumb as a base64 string to prevent the client from needing to
            // download the thumb after returning the successful upload
            $array = $this->object->toArray();
            $imageType = null;

            if (file_exists($array['mgr_thumb_path'])) {
                // Get the mime type
                if (function_exists('exif_imagetype')) {
                    $imageType = @exif_imagetype($array['mgr_thumb_path']);
                }
                if ($imageType === null) {
                    $imageType = @getimagesize($array['mgr_thumb_path']);
                    $imageType = $imageType[2];
                }
                if ($imageType !== null) {
                    $mime = image_type_to_mime_type($imageType);
                    $array['mgr_thumb'] = "data:$mime;base64," . base64_encode(file_get_contents($array['mgr_thumb_path']));
                }
            }

            // Ignore EXIF data, this can potentially break the response if it contains invalid characters.
            unset ($array['exif']);

            // Triggering getCrops will create the crop records which will generate the cropped images
            // We also need to pass the crops back so they can be edited.
            $array['crops'] = $this->modx->toJSON($this->object->getCropsAsArray());

            return $this->success('', $array);
        }
        return $this->failure(implode("\n", $this->imageErrors), $this->object->toArray());
    }

    /**
     * When shutting down the PHP process, we check if there were any E_ERROR errors.
     *
     * This shutdown handler is defined right before trying to resize the image, so we
     * can assume the fatal error occurred during the resize.
     * 99% of the cases, this will mean an issue with memory_limit / file size.
     *
     * While we *could* leave the mgImage as-is, the fact that we were unable of resizing
     * likely means the image is too large to be resized in the front-end as well, so we
     * might as well remove it as it's only going to be trouble.
     *
     * @param moreGalleryMgrImagesUploadProcessor $processor
     */
    public static function onShutdown(moreGalleryMgrImagesUploadProcessor $processor)
    {
        $error = error_get_last();
        if (is_array($error) && $error['type'] == E_ERROR) {
            $processor->object->remove();
        }
    }
}

return 'moreGalleryMgrImagesUploadProcessor';
