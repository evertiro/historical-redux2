<?php
class Redux_Options_text_sortable extends Redux_Options {

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

        $options = $this->field['options'];


        echo '<ul class="text_sortable ' . $class . '">';
            if (isset($this->value) && is_array($this->value)) {
                foreach ($this->value as $k => $nicename) {
                    $value_display = isset($this->value[$k]) ? $this->value[$k] : 'http://';
                    echo '<li>';
                    echo '<label for="' . $this->field['id'] . '[' . $k . ']"><strong>' . $options[$k] . ':</strong></label>';
                    echo '<input type="text" id="' . $this->field['id'] . '[' . $k . ']" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][' . $k . ']" value="' . esc_attr($value_display) . '" placeholder="' . $nicename . '" />';
                    echo '<span class="compact drag">DRAG</span>';
                    echo '</li>';
                }
            } else {
                foreach ($options as $k => $nicename) {
                    $value_display = isset($this->value[$k]) ? $this->value[$k] : 'http://';
                    echo '<li>';
                    echo '<label for="' . $this->field['id'] . '[' . $k . ']"><strong>' . $nicename . ':</strong></label>';
                    echo '<input type="text" id="' . $this->field['id'] . '[' . $k . ']" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][' . $k . ']" value="' . esc_attr($value_display) . '" placeholder="' . $nicename . '" />';
                    echo '<span class="drag">DRAG</span>';
                    echo '</li>';
                }
            }
        echo '</ul>';

        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';
    }

    function enqueue() {
        wp_enqueue_script(
            'redux-opts-field-social-links-js',
            Redux_OPTIONS_URL . 'fields/text_sortable/field_text_sortable.js',
            array('jquery'),
            time(),
            true
        );
    }
}
