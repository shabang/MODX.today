<?php
/**
 * Class RepeaterInput
 * 
 * Holy crap! Nested fields?!?
 */
class RepeaterInput extends cbBaseInput {
    public $defaultIcon = 'chunk_A';
    public $defaultTpl = ' ';
    public $defaultWrapperTpl = '[[+rows]]';
    
    /**
     * @return array
     */
    public function getFieldProperties()
    {
        return array(
            array(
                'key' => 'wrapper_template',
                'fieldLabel' => $this->modx->lexicon('contentblocks.wrapper_template'),
                'xtype' => 'code',
                'default' => $this->defaultWrapperTpl,
                'description' => $this->modx->lexicon('contentblocks.repeater.wrapper_template.description')
            ),
            array(
                'key' => 'group',
                'fieldLabel' => $this->modx->lexicon('contentblocks.repeater.group'),
                'xtype' => 'contentblocks-repeater-groups',
                'description' => $this->modx->lexicon('contentblocks.repeater.group.description')
            ),
            array(
                'key' => 'row_separator',
                'fieldLabel' => $this->modx->lexicon('contentblocks.repeater.row_separator'),
                'xtype' => 'textfield',
                'description' => $this->modx->lexicon('contentblocks.repeater.row_separator.description'),
                'default' => "\n\n"
            ),
            array(
                'key' => 'max_items',
                'fieldLabel' => $this->modx->lexicon('contentblocks.repeater.max_items'),
                'xtype' => 'numberfield',
                'description' => $this->modx->lexicon('contentblocks.repeater.max_items.description'),
                'default' => 0,
                'minValue' => 0
            ),
        );
    }

    /**
     * Returns an array of javascript files to load.
     *
     * @return array
     */
    public function getJavaScripts()
    {
        return array(
            $this->contentBlocks->config['assetsUrl'] . 'js/inputs/repeater.js',
        );
    }

    /**
     * Load the template for the input
     *
     * @return array
     */
    public function getTemplates()
    {    
        $tpls = array();
        $tpls[] = $this->contentBlocks->getCoreInputTpl('repeater');
        $tpls[] = $this->contentBlocks->getCoreTpl('inputs/partials/repeater_item', 'contentblocks-repeater-item');
        return $tpls;
    }
    
    /**
     * Generate the HTML for the repeater
     *
     * @param cbField $field
     * @param array $data
     * @return mixed
     */
    public function process(cbField $field, array $data = array())
    {
        // Ensure inputs are loaded
        //$this->contentBlocks->loadInputs();

        // Grab the group fields and template
        $group = $this->getGroup($field);
        $tpl = $field->get('template');

        // Array to store the output in
        $rowsOutput = array();

        // Loop over each row
        $idx = 0;
        foreach ($data['rows'] as $row) {
            $idx++;
            $data['idx'] = $idx;
            $rowsOutput[] = $this->processRow($row, $group, $data, $tpl);
        }

        $data['total'] = count($data['rows']);

        // Glue individual rows together
        $separator = $field->get('row_separator');
        if (empty($separator)) $separator = "\n\n";
        $rowsOutput = implode($separator, $rowsOutput);

        // Throw it in a wrapper template with [[+rows]]
        $wrapperTpl = $field->get('wrapper_template');
        if (empty($wrapperTpl)) $wrapperTpl = '[[+rows]]';
        $data['rows'] = $rowsOutput;

        // Return the final output. Whew.
        return $this->contentBlocks->parse($wrapperTpl, $data);
    }

    /**
     * Processes a single row of the repeater
     *
     * @param array $row
     * @param array $group
     * @param array $data
     * @param string $tpl
     * @return mixed
     */
    public function processRow($row, $group, $data, $tpl = '') {
        // For each row, we store placeholders in the $rowFields array
        $rowFields = array();
        // Loop over each key in the row and its value (array)
        foreach ($row as $key => $value) {
            $input = $group[$key]['input'];

            // Ensure properties are set as JSON, otherwise certain fields can go nuts
            $group[$key]['properties'] = $this->modx->toJSON($group[$key]['properties']);

            // If it's a known input, we try to parse it
            if (isset($this->contentBlocks->inputs[$input])) {

                // Update the fake field so it has the proper templates and properties as defined in the group field
                $fakeField = $this->modx->newObject('cbField', $group[$key]);

                // Attempt to parse the data through that input type
                try {
                    $parseData = array_merge($data, $group[$key], $value);
                    $value = $this->contentBlocks->inputs[$input]->process($fakeField, $parseData);
                } catch (Exception $e) {
                    $value = 'Error parsing ' . $input . ': ' . $e->getMessage();
                }
            }
            else {
                $value = 'Input ' . $input . ' not found. :( ';
            }

            // Set the value as placeholder in $rowFields
            $rowFields[$key] = $value;
        }

        // Grab the $data and the $rowFields together so we have settings and everything
        $phs = array_merge($data, $rowFields);

        // Parse this row of fields
        return $this->contentBlocks->parse($tpl, $phs);
    }

    /**
     * Gets the group information as array
     *
     * @param cbField $field
     * @return array
     */
    public function getGroup(cbField $field)
    {
        $ta = $field->get('group');
        $ta = $this->modx->fromJSON($ta);

        $group = array();
        foreach ($ta as $grp) {
            $group[$grp['key']] = $grp;
        }
        return $group;
    }

    /**
     * Return an array of input keys that need to be loaded whenever
     * this input is being used.
     *
     * Contains a reference to the field it is being used on in case
     * it depends on configuration.
     *
     * @param cbField $field
     * @return array
     */
    public function getDependantInputs(cbField $field) {
        $group = $this->getGroup($field);

        $dependencies = array();
        foreach ($group as $fieldInfo) {
            $dependencies[] = $fieldInfo['input'];

            if ($fieldInfo['input'] === 'repeater') {
                $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($fieldInfo, true));
                $nestedGroup = $this->modx->fromJSON($fieldInfo['properties']['group']);
                foreach ($nestedGroup as $nestedField) {
                    $dependencies[] = $nestedField['input'];
                }
            }
        }
        return $dependencies;
    }
}
