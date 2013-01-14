<?php
class Redux_Options_slider extends Redux_Options {

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
        $range = (isset($this->field['from']) && isset($this->field['to'])) ? $this->field['from'].','.$this->field['to'] : '0,100';
        $step = (isset($this->field['step'])) ? $this->field['step'] : '5';
        $unit = (isset($this->field['unit'])) ? $this->field['unit'] : '';

        echo '<table><tr>';
        echo '<td class="compact"><span class="slider_value"><strong>' . $this->value . '</strong>' . $unit . '</span></td>';
        echo '<td class="compact"><input type="text" data-slider="true" data-slider-range="' . $range . '" data-slider-snap="true" data-slider-step="' . $step . '" id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . ']" value="' . esc_attr($this->value) . '" class="field_slider ' . $class . '" /></td>';
        echo '</tr></table>';
        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';
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
            'redux-opts-select-slider-js',
            Redux_OPTIONS_URL . 'fields/slider/field_slider.js',
            array('jquery'),
            time(),
            true
        );
    }
}
