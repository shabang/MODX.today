<?php
    /**
     * @package ContentBlocks
     */

    class ContentBlocksImageProcessor extends modProcessor {
        /** @var null|modMediaSource $source  */
        public $source = null;
        public $path = '';
        public $url = '';
        public $fileErrors = array();
        /** @var bool|cbField $field */
        public $field;
        /** @var ContentBlocks $contentBlocks */
        public $contentBlocks;
        public $pathSetting = 'contentblocks.image.upload_path';
        public $allowedFileTypes = 'png,gif,jpg,jpeg,svg';
        public $mgr_thumb;

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

            // Get the system / context default. If that's somehow not set, things will
            // fall through eventually to modMediaSource::getDefaultSource, which should
            // fix it. If it doesn't, there's something wrong with the MODX setup, which
            // isn't really something we can account for.

            $default = $this->contentBlocks->getOption('default_media_source');
            $id = $this->contentBlocks->getOption('contentblocks.image.source', null, false);
            $id = $id ? $id : $default;

            $fieldId = (int)$this->getProperty('field');
            if ($fieldId > 0 && $field = $this->modx->getObject('cbField', $fieldId)) {
                $fieldSource = $field->get('source');
                if ($fieldSource > 0) {
                    $id = $fieldSource;
                }
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

        public function setThumbSource() {
            $cache_source = $this->contentBlocks->getOption('contentblocks.cache_source', null, false, true);
            $cache_source = $cache_source ? $cache_source : $this->contentBlocks->getOption('contentblocks.image.source', null, false, true);
            $cache_source = $cache_source ? $cache_source : $this->contentBlocks->getOption('default_media_source');

            $this->modx->loadClass('sources.modMediaSource');
            $this->source = modMediaSource::getDefaultSource($this->modx, $cache_source);
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
            $corePath = $this->modx->getOption('contentblocks.core_path', null, $this->modx->getOption('core_path') . 'components/contentblocks/');
            $this->contentBlocks =& $this->modx->getService('contentblocks', 'ContentBlocks', $corePath . 'model/contentblocks/');

            $resourceId = (int)$this->getProperty('resource', 0);
            $resource = $this->modx->getObject('modResource', $resourceId);
            if ($resource instanceof modResource) {
                $this->contentBlocks->setResource($resource);
            }

            if (!$this->_getSource()) {
                return $this->modx->lexicon('contentblocks.error_loading_source');
            }

            $fieldId = (int)$this->getProperty('field');
            if ($fieldId > 0 && $field = $this->modx->getObject('cbField', $fieldId)) {
                $this->field = $field;
                $this->setFieldPath();
                return true;
            }
            return false;
        }

        public function setFieldPath() {
            $path = (is_object($this->field)) ? $this->field->get('directory') : false;
            if (!$path) {
                $path = $this->contentBlocks->getOption($this->pathSetting, null, 'assets/uploads/');
            }

            $path = rtrim($path, '/') . '/';
            $this->path = $this->contentBlocks->parsePathVariables($path);

            /**
             * Make sure the upload path exists. We unset errors to prevent issues if it already exists.
             */
            $this->source->createContainer($this->path, '/');
            $this->source->errors = array();
        }

        /**
         * @return bool
         */
        public function process() {
            return $this->success('', array());
        }

        /**
         * @param $fileName
         * @return string
         */
        public function cleanFilename($fileName, $fileExtension)
        {
            if ($this->contentBlocks->getOption('contentblocks.image.sanitize', null, true)) {
                $fileName = $this->contentBlocks->sanitize($fileName);
            }
            if ($this->contentBlocks->getOption('contentblocks.image.hash_name', null, false)) {
                $fileName = md5($fileName);
            }
            if ($this->contentBlocks->getOption('contentblocks.image.prefix_time', null, false)) {
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

                return $tpFileName . '.' . $fileExtension;
            }

            return $fileName . '.' . $fileExtension;
        }

        public function getAllowedFileTypes()
        {
            $fileTypes = $this->allowedFileTypes;
            if ($this->field) {
                // override default if set
                $fileTypes = $this->field->get('file_types');

            }
            $fileTypes = explode(',', strtolower($fileTypes));
            return $fileTypes;
        }
    }

    return 'ContentBlocksImageProcessor';
