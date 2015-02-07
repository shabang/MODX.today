<?php
/**
 * Class cbField
 */
class cbField extends xPDOSimpleObject {
    /** @var modX $xpdo */
    public $xpdo;

    /**
     * @param array|string $k
     * @param null $format
     * @param null $formatTemplate
     * @return mixed
     */
    public function get($k, $format = null, $formatTemplate= null)
    {
        $v = parent::get($k, $format, $formatTemplate);
        if (!is_array($k) && !isset($this->_fields[$k])) {
            $props = parent::get('properties');
            $props = $this->xpdo->fromJSON($props);
            if (is_array($props) && array_key_exists($k, $props)) {
                $v = $props[$k];
            }
        }
        return $v;
    }

    /**
     * Shortcut to cbBaseInput.getDependantInputs
     *
     * @return array
     */
    public function getDependantInputs() {
        $input = (isset($this->xpdo->contentblocks->inputs[$this->get('input')])) ? $this->xpdo->contentblocks->inputs[$this->get('input')] : false;

        if ($input instanceof cbBaseInput) {
            return $input->getDependantInputs($this);
        }
        return array();
    }
}
