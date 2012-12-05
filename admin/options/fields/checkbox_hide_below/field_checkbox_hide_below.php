<?php
class Redux_Options_checkbox_hide_below extends Redux_Options {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    function __construct($field = array(), $value ='', $parent) {
        parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
        $this->field = $field;
        $this->value = $value;
        //$this->render();
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
        $class = (isset($this->field['class'])) ? $this->field['class'] : '';
        echo ($this->field['desc'] != '') ? ' <label for="' . $this->field['id'] . '">' : '';
        echo '<input type="checkbox" id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . ']" value="1" class="' . $class . ' redux-opts-checkbox-hide-below" ' . checked($this->value, '1', false) . ' />';
        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' ' . $this->field['desc'] . '</label>' : '';
    }

    /**
     * Enqueue Function.
     *
     * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
     *
     * @since Redux_Options 1.0.0
    */
    function enqueue() {
        wp_enqueue_script(
            'redux-opts-checkbox-hide-below-js', 
            Redux_OPTIONS_URL . 'fields/checkbox_hide_below/field_checkbox_hide_below.js', 
            array('jquery'),
            time(),
            true
        );
    }
}
