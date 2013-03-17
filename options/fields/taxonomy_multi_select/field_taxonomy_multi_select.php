<?php
class Redux_Options_taxonomy_multi_select {

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
    }//function

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
     */
    function render() {
        $class = (isset($this->field['class'])) ? 'class="' . $this->field['class'] . '" ' : '';
        echo '<select id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][]" ' . $class . 'multiple="multiple" >';
        $args = wp_parse_args($this->field['args'], array());
        $taxonomies = get_taxonomies($args, 'object');
        foreach($taxonomies as $taxonomy) {
            $selected = (is_array($this->value) && in_array($taxonomy->name, $this->value)) ? ' selected="selected"' : '';
            echo '<option value="' . $taxonomy->name . '"' . $selected . '>' . $taxonomy->name . '</option>';
        }
        echo '</select>';
        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? '<br/><span class="description">' . $this->field['desc'] . '</span>' : '';
    }
}
