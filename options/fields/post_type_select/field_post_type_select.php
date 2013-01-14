<?php
class Redux_Options_post_type_select extends Redux_Options {

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
        $class = (isset($this->field['class'])) ? 'class="' . $this->field['class'] . '" ' : '';
        if (!isset($this->field['args'])) { $this->field['args'] = array(); }
        $args = wp_parse_args($this->field['args'], array('public' => true));
        $post_types = get_post_types($args, 'object');
	    $multiple = (true === $this->field['multiple']) ? ' multiple="multiple" size="' . count($post_types) . '" ' : '';
	    $field_name = ($multiple) ? $this->args['opt_name'] . '[' . $this->field['id'] . '][]' : $this->args['opt_name'] . '[' . $this->field['id'] . ']';

        echo '<select id="' . $this->field['id'] . '" name="' . $field_name . '" ' . $class . $multiple . '">';
	        foreach($post_types as $k => $post_type) {
		        if (is_array($this->value)){
		            $selected = ($multiple && in_array($post_type->name, $this->value)) ? ' selected="selected"' : '';
		        } else {
			        $selected = selected($this->value, $k, false);
		        }
	            echo '<option value="' . $k . '"' . $selected . '>' . $post_type->labels->name . '</option>';
	        }
        echo '</select>';
        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';
    }
}
