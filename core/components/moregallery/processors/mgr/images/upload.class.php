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

    /** @var moreGallery */
    public $moregallery;

    public function initialize()
    {
        $corePath = $this->modx->getOption('moregallery.core_path', null, $this->modx->getOption('core_path').'components/moregallery/');
        $this->moregallery =& $this->modx->getService('moregallery', 'moreGallery' , $corePath . 'model/moregallery/');
        return parent::initialize();
    }

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
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if ($file['error'] > 0) {
            return $this->modx->lexicon('moregallery.error_upload_failed', array('error' => $file['error']));
        }

        /**
         * The allowed extensions can come from 2 places.
         *
         * If allowed_extensions_per_source is enabled, the media source is checked for an imageExtensions property
         * and then that value is used.
         *
         * In all other cases, it looks for the upload_images setting.
         */
        $allowedExtensions = false;
        $sourceSpecificExtensions = $this->moregallery->getOption('moregallery.allowed_extensions_per_source', null, false);
        if ($sourceSpecificExtensions) {
            $properties = $this->resource->source->getPropertyList();
            if (isset($properties['imageExtensions']) && !empty($properties['imageExtensions'])) {
                $allowedExtensions = $properties['imageExtensions'];
            }
        }
        if (!$allowedExtensions) {
            $allowedExtensions = strtolower($this->moregallery->getOption('upload_images'));
        }
        $allowedExtensions = explode(',', $allowedExtensions);
        $allowedExtensions = array_map('trim', $allowedExtensions);
        if (!in_array($fileExtension, $allowedExtensions)) {
            $charset = $this->modx->getOption('modx_charset');
            $ext = htmlentities($fileExtension, ENT_QUOTES, $charset);
            return $this->modx->lexicon('moregallery.error_invalid_filetype', array('extension' => $ext));
        }

        /**
         * Try to load the image name from IPTC data on the image file
         */
        try {
            getimagesize($file['tmp_name'], $info);
            if (isset($info["APP13"])) {
                $this->object->loadIPTCData($info["APP13"]);
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
        $imageIdPlacement = $this->moregallery->getOption('moregallery.image_id_in_name', null, 'prefix', true);
        foreach ($_FILES as &$file) {
            $id = $this->object->get('id');
            $name = $this->moregallery->sanitizeFileName($file['name']);

            if ($imageIdPlacement === 'prefix') {
                $name = $id . '_' . $name;
            }
            elseif ($imageIdPlacement === 'suffix') {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $name = pathinfo($file['name'], PATHINFO_FILENAME);
                $name = $name . '_' . $id . '.' . $ext;
            }

            $file['name'] = $name;
        }

        /**
         * Do the upload
         */
        $this->moregallery->renames = array();
        $uploaded = $this->resource->source->uploadObjectsToContainer($this->path, $_FILES);
        if (!$uploaded) {
            $errors = $this->resource->source->getErrors();
            $errors = implode('<br />', $errors);
            $this->modx->log(modX::LOG_LEVEL_ERROR,'[moreGallery] Error uploading file: ' . $errors);
            $this->imageErrors[] = $errors;
            $this->object->remove();
            return $this->failure($errors);
        }

        /**
         * Check if the file has been renamed by a plugin like FileSluggy
         */
        $newFileName = reset($this->moregallery->renames);
        if (!empty($newFileName)) {
            $baseMediaPath = $this->resource->source->getBasePath() . $this->path;
            $newFileName = substr($newFileName, strlen($baseMediaPath));
            $_FILES['upload']['name'] = $newFileName;
        }

        /**
         * Add more data to the mgImage object
         */
        $uploadedFile = reset($_FILES);
        $file = $this->resource->source->getObjectContents($this->path . $uploadedFile['name']);
        $this->object->set('file', $file['basename']);

        /**
         * Based on the IPTC data, try to pre-fill certain fields
         */
        $iptc = $this->object->get('iptc');
        if ($this->moregallery->getOption('moregallery.prefill_from_iptc', null, true) && is_array($iptc)) {
            $this->object->prefillFromIPTC($iptc);
        }

        /**
         * Attempt to increase the memory limit as we're about to do some heavy image stuff
         */
        $this->moregallery->setMemoryLimit();

        /**
         * Register a shutdown function that will attempt to clean up stuff should the request fail with a fatal
         * error, for example due to image resizing and memory limits.
         */
        register_shutdown_function(array('moreGalleryMgrImagesUploadProcessor', 'onShutdown'), $this);

        /**
         * Grab exif data and use to fix the orientation if needed
         */
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

        /**
         * Create a copy of the image as a smaller manager thumbnail
         */
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
