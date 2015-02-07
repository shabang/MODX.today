<?php
require_once 'redprocessor.class.php';
/**
 * Choose Redactor Images.
 *
 * @param string $file The absolute path of the file
 * @param string $name Will rename the file if different
 * @param string $content The new content of the file
 *
 * @package modx
 * @subpackage processors.browser.file
 */
class RedactorMediaUploadProcessor extends redProcessor {
    public $hash_option = 'redactor.date_files';
    public $target_path = 'file_upload_path';
    public $target_path_default = 'assets/uploads/';
    public $rootPath = '';

    /**
     * @return array|bool|string
     */
    public function process() {
        /* get base paths and sanitize incoming paths */
        $loaded = $this->getSource();
        if (!($this->source instanceof modMediaSource)) return $loaded;

        /**
         * Get the upload path to upload to.
         */
        $path = $this->modx->getOption('redactor.' . $this->target_path,null,'assets/uploads/');
        if ($this->tv) {
            $properties = $this->tv->get('input_properties');
            if (isset($properties[$this->target_path]) && !empty($properties[$this->target_path])) {
                $path = $properties[$this->target_path];
            }
        }
        $this->rootPath = $path = $this->redactor->parsePathVariables($path);

        $doHash = (bool)$this->modx->getOption($this->hash_option, null, false);
        $hash = ($doHash) ? date('Y-m-d-H.i.s') . '-' : '';

        /**
         * Make sure the upload path exists. We unset errors to prevent issues if it already exists.
         */
        $this->source->createContainer($path,'/');
        $this->source->errors = array();

        $files = array();

        if(isset($_POST['data'])) {
            // Paste-upload to S3 is only supported on 2.2.9+
            $vd = $this->modx->getVersionData();
            if (!version_compare($vd['full_version'],'2.2.9-pl','>=') && ($this->source instanceof modS3MediaSource)) {
                return $this->failure('Sorry, raw uploads to Amazon S3 Media sources are not supported in this version of MODX.');
            }

            // Process if everything is fine
            $contentType = $_POST['contentType'];
            $fileExtension = explode('/',$contentType);
            $fileExtension = (isset($fileExtension[1])) ? $fileExtension[1] : 'png';
            $fileName = md5(time());
            $success = $this->source->createObject($path,"$fileName.$fileExtension",base64_decode($_POST['data']));
            $files[] = array(
                'filelink' => $this->source->getObjectUrl($this->rootPath . "$fileName.$fileExtension"),
                'filename' => "$fileName"
            );
        } else {
            /**
             * Prepare file names.
             */
            foreach ($_FILES as $key => $upload) {
                $originalName = pathinfo($upload['name'], PATHINFO_FILENAME);
                if((bool)$this->modx->getOption('redactor.cleanFileNames', null, true)) $originalName = $this->sanitizeFileName($originalName);
                $extension = pathinfo($upload['name'], PATHINFO_EXTENSION);
                $_FILES[$key]['name'] = $hash . $originalName . '.' . $extension;

                // Make sure we don't try something if the file was not properly uploaded
                if ($_FILES['error'] == 0) {
                    $files[] = array(
                        'filelink' => $this->source->getObjectUrl($this->rootPath . $_FILES[$key]['name']),
                        'filename' => $originalName,
                    );
                }
            }

            /**
             * Do the actual upload.
             */
            $success = $this->source->uploadObjectsToContainer($path,$_FILES);
            if (!$success) {
                $errors = $this->source->getErrors();
                $errors = implode('<br />', $errors);
                return $this->failure($errors);
            }  
        }

        // Sometimes, uploadObjectsToContainer returns true when files did not upload properly
        // Here we check if we have any files. If not, throw an error.
        if (empty($files)) {
            return $this->failure($this->modx->lexicon('file_err_upload'));
        }

        return $this->outputArray($files);
    }

    /**
     * Return an error in the way Redactor.js expects it
     *
     * @param string $msg
     * @param null $object
     * @return string
     */
    public function failure($msg = '',$object = null) {
        return $this->modx->toJSON(array(
            'error' => $msg
        ));
    }

}
return 'RedactorMediaUploadProcessor';
