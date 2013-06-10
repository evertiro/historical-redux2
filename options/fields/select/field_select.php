<?php
class Redux_Options_select {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    function __construct($field = array(), $value ='', $parent) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
        $class = (isset($this->field['class'])) ? 'class="' . $this->field['class'] . '" ' : '';
        $array_dims = '';
        $multiselect = '';
		if (isset( $this->field['multiselect'] ) && $this->field['multiselect']) {
			$array_dims = '[]';
			$multiselect = ' multiple="multiple"';
			$multiselect .= ' size="' . (isset($this->field['rows']) ? $this->field['rows'] : '6') .'"'; //'rows' is the number of rows to display on multi-select
		}
        echo '<select id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . ']' . $array_dims . '" ' . $class . $multiselect . ' >';
        foreach($this->field['options'] as $k => $v) {
            $selected = (is_array($this->value) && in_array($k, $this->value) || $this->value == $k) ? ' selected="selected"' : '';
            echo '<option value="' . $k . '"' . $selected . '>' . $v . '</option>';
        }
        echo '</select>';
        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? '<br/><span class="description">' . $this->field['desc'] . '</span>' : '';
    }
}
