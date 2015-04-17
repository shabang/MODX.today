<?php
/**
 * @package moreGallery
 */
class ContentBlocksImageUploadProcessor extends modProcessor {
    /** @var null|modMediaSource $source  */
    public $source = null;
    public $path = '';
    public $imageErrors = array();
    /** @var bool|cbField $field */
    public $field;

    /**
     * @return array
     */
    public function getLanguageTopics() {
        return array('file');
    }

    /**
     * @return modMediaSource|null
     */
    public function _getSource() {
        if ($this->source) return $this->source;

        $id = $this->modx->getOption('contentblocks.image.source', null, 1);

        $fieldId = (int)$this->getProperty('field');
        if ($fieldId > 0 && $field = $this->modx->getObject('cbField', $fieldId)) {
            $fieldSource = $field->get('source');
            if ($fieldSource > 0) $id = $fieldSource;
        }

        $this->modx->loadClass('sources.modMediaSource');
        $this->source = modMediaSource::getDefaultSource($this->modx, $id);
        if ($this->source) {
            $this->source->getWorkingContext();
            $this->source->initialize();
            return $this->source;
        }
        return null;
    }

    /**
     * @return bool|string
     */
    public function initialize() {
        if (!$this->_getSource()) {
            return $this->modx->lexicon('contentblocks.error_loading_source');
        }
        $fieldPath = false;
        $fieldId = (int)$this->getProperty('field');
        if ($fieldId > 0 && $field = $this->modx->getObject('cbField', $fieldId)) {
            $fieldPath = $field->get('directory');
            $this->field = $field;
        }

        // make sure it ends in a /. If it's false, keep it that way.
        $fieldPath = $fieldPath ? rtrim($fieldPath, '/') . '/' : $fieldPath;

        $path = $fieldPath ? $fieldPath : $this->modx->getOption('contentblocks.image.upload_path', null, 'assets/uploads/');
        $path = str_replace(array(
            '[[+year]]',
            '[[+month]]',
            '[[+day]]',
            '[[+user]]',
            '[[+username]]',
            '[[+resource]]',
        ), array(
            date('Y'),
            date('m'),
            date('d'),
            $this->modx->user->get('id'),
            $this->modx->user->get('username'),
            (int)$this->getProperty('resource', 0),
        ), $path);
        $this->path = $path;

        /**
         * Make sure the upload path exists. We unset errors to prevent issues if it already exists.
         */
        $this->source->createContainer($this->path,'/');
        $this->source->errors = array();
        return true;
    }

    /**
     * @return bool
     */
    public function process() {
        if (!$this->source->checkPolicy('create')) {
            return $this->failure($this->modx->lexicon('permission_denied'));
        }
        
        $file = $_FILES['file'];
        $fileName = pathinfo($file['name'], PATHINFO_FILENAME);
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if ($this->field) {
            $fileTypes = $this->field->get('file_types');
            if ($fileTypes) {
                $fileTypes = explode(',', strtolower($fileTypes));
                if (!in_array(strtolower($fileExtension), $fileTypes)) {
                    $errors = $this->modx->lexicon('contentblocks.file_types.disallowed');
                    return $this->failure($errors);
                }
            }
        }

        if ($this->modx->getOption('contentblocks.image.sanitize', null, true)) {
            $fileName = $this->modx->contentblocks->sanitize($fileName);
        }
        if ($this->modx->getOption('contentblocks.image.hash_name', null, false)) {
            $fileName = md5($fileName);
        }
        if ($this->modx->getOption('contentblocks.image.prefix_time', null, false)) {
            $fileName = time() . '_' . $fileName;
        }

        if ($this->source instanceof modFileMediaSource) {
            $bases = $this->source->getBases($this->path);
            /// don't overwrite previous files that were uploaded
            $i = 0;
            $tpFileName = $fileName;
            while (file_exists($bases['pathAbsoluteWithPath'] . $tpFileName . '.' . $fileExtension)) {
                $i++;
                $tpFileName = $fileName . '_' . $i;
            }

            $_FILES['file']['name'] = $tpFileName . '.' . $fileExtension;
        }

        /**
         * Do the upload
         */
        $uploaded = $this->source->uploadObjectsToContainer($this->path, $_FILES);
        if (!$uploaded) {
            $errors = $this->source->getErrors();
            $errors = implode('<br />', $errors);
            return $this->failure($errors);
        }
        
        // Make sure the connection closes for sites with keep-alive enabled
        header("Connection: close");

        // clean up any double-slashes
        $url = str_replace('//', '/', $this->source->getObjectUrl($this->path . $_FILES['file']['name']));

        return $this->success('', array(
            'url' => $url,
            'size' => $_FILES['file']['size'],
            'extension' => $fileExtension,
        ));
    }
}

return 'ContentBlocksImageUploadProcessor';
