<?php
/**
 * Class ImageInput
 *
 * @author Mark Hamstra
 * @package contentblocks
 */
class ImageInput extends cbBaseInput {
    public $defaultIcon = 'heading';
    public $defaultTpl = '<img src="[[+url]]" width="[[+width]]" height="[[+height]]" alt="">';
    /**
     * @return array
     */
    public function getTemplates()
    {
        $tpls = array();
        $tpls[] = $this->contentBlocks->getCoreInputTpl('image');
        return $tpls;
    }

    /**
     * Return an array of field properties. Properties are used in the component for defining
     * additional templates or other settings the site admin can define for the field.
     *
     * @return array
     */
    public function getFieldProperties()
    {
        return array(
            array(
                'key' => 'source',
                'fieldLabel' => $this->modx->lexicon('contentblocks.image.source'),
                'xtype' => 'contentblocks-combo-mediasource',
                'default' => 0,
                'description' => $this->modx->lexicon('contentblocks.image.source.description')
            ),
            array(
                'key' => 'directory',
                'fieldLabel' => $this->modx->lexicon('contentblocks.directory'),
                'xtype' => 'textfield',
                'default' => $this->contentBlocks->getOption('contentblocks.image.upload_path', null, 'assets/uploads/images/'),
                'description' => $this->modx->lexicon('contentblocks.directory.description')
            ),
            array(
                'key' => 'file_types',
                'fieldLabel' => $this->modx->lexicon('contentblocks.file_types'),
                'xtype' => 'textfield',
                'default' => 'png,gif,jpg,jpeg',
                'description' => $this->modx->lexicon('contentblocks.file_types.description')
            ),
            array(
                'key' => 'thumbnail_size',
                'fieldLabel' => $this->modx->lexicon('contentblocks.image.thumbnail_size'),
                'xtype' => 'textfield',
                'default' => '0',
                'description' => $this->modx->lexicon('contentblocks.image.thumbnail_size.description'),
            ),
        );
    }

    /**
     * Process this field based on its template and the received data. For the image input, we also look at the image to
     * grab the width/height.
     *
     * @param cbField $field
     * @param array $data
     * @return mixed
     */
    public function process(cbField $field, array $data = array())
    {
        if (!isset($data['width']) || $data['width'] < 1) {
            $size = false;

            if (file_exists($data['url']) && is_readable($data['url'])) {
                $size = getimagesize($data['url']);
            }

            if (!$size) {
                // Try it with a normalised path
                $normalisedPath = str_replace(MODX_BASE_URL.MODX_BASE_URL, MODX_BASE_URL, MODX_BASE_PATH . $data['url']);
                if (file_exists($normalisedPath) && is_readable($normalisedPath)) {
                    $size = getimagesize($normalisedPath);
                }
            }

            if (!empty($size)) {
                $data['width'] = $size[0];
                $data['height'] = $size[1];
            }
        }
        return parent::process($field, $data);
    }
}
