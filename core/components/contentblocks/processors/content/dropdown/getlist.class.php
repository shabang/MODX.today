<?php
/**
 * Gets a list of available options for the dropdown input (or derivatives)
 */
class ContentSelectGetListProcessor extends modProcessor {
    /**
     * @return array|string
     */
    public function process()
    {
        $fieldId = (int)$this->getProperty('field', 0);

        /** @var cbField|null $field */
        $field = $this->modx->getObject('cbField', array('input' => 'dropdown', 'id' => $fieldId));
        if (!$field) {
            return $this->failure($this->modx->lexicon('contentblocks.error.no_valid_field'));
        }

        $this->modx->contentblocks->loadInputs();
        $input = array_key_exists('dropdown', $this->modx->contentblocks->inputs) ? $this->modx->contentblocks->inputs['dropdown'] : false;
        if (!($input instanceof DropdownInput)) {
            return $this->failure($this->modx->lexicon('contentblocks.error.no_valid_input'));
        }

        $options = $input->getSelectOptions($field);

        return $this->outputArray($options);
    }
}
return 'ContentSelectGetListProcessor';
