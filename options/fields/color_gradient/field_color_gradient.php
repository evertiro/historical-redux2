<?php
class Redux_Options_color_gradient extends Redux_Options {

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
        $dir = isset($this->field['direction']) ? $this->field['direction'] : false;

        if(get_bloginfo('version') >= '3.5') {
            echo __('From: ', Redux_TEXT_DOMAIN) . '<input type="text" id="' . $this->field['id'] . '-from" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][from]" value="' . $this->value['from'] . '" class="' . $class . ' popup-colorpicker" style="width:70px;" data-default-color="' . esc_attr($this->value['from']) . '"/>';
            echo __('To: ', Redux_TEXT_DOMAIN) . '<input type="text" id="' . $this->field['id'] . '-to" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][to]" value="' . $this->value['to'] . '" class="' . $class . ' popup-colorpicker" style="width:70px;" data-default-color="' . esc_attr($this->value['to']) . '"/>';
            if ($dir) {
                echo '<div class="clear"></div><br />';
                echo 'Direction: <select id="' . $this->field['id'] . '-dir" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][dir]" rows="6" class="color-gradient-direction">';
                echo '<option value="horizontal" ' . selected($this->value['dir'], 'horizontal', false) . '>Horizontal</option>';
                echo '<option value="vertical" ' . selected($this->value['dir'], 'vertical', false) . '>Vertical</option>';
                echo '</select>';
            }
            echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <span class="description">'.$this->field['desc'].'</span>':'';
        } else {
            echo '<div class="farb-popup-wrapper" id="' . $this->field['id'] . '">';
            echo __('From:', Redux_TEXT_DOMAIN) . ' <input type="text" id="' . $this->field['id'] . '-from" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][from]" value="' . $this->value['from'] . '" class="' . $class . ' popup-colorpicker" style="width:70px;"/>';
            echo '<div class="farb-popup"><div class="farb-popup-inside"><div id="' . $this->field['id'] . '-frompicker" class="color-picker"></div></div></div>';
            echo __(' To:', Redux_TEXT_DOMAIN) . ' <input type="text" id="' . $this->field['id'] . '-to" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][to]" value="' . $this->value['to'] . '" class="' . $class . ' popup-colorpicker" style="width:70px;"/>';
            echo '<div class="farb-popup"><div class="farb-popup-inside"><div id="' . $this->field['id'] . '-topicker" class="color-picker"></div></div></div>';
            if ($dir) {
                echo '<div class="clear"></div><br />';
                echo 'Direction: <select id="' . $this->field['id'] . '-dir" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][dir]" rows="6" class="color-gradient-direction">';
                echo '<option value="horizontal" ' . selected($this->value['dir'], 'horizontal', false) . '>Horizontal</option>';
                echo '<option value="vertical" ' . selected($this->value['dir'], 'vertical', false) . '>Vertical</option>';
                echo '</select>';
            }
            echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';
            echo '</div>';
        }
    }

    /**
     * Enqueue Function.
     *
     * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
     *
     * @since Redux_Options 1.0.0
     */
    function enqueue() {
        if(get_bloginfo('version') >= '3.5') {
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script(
                'redux-opts-field-color-js',
                Redux_OPTIONS_URL . 'fields/color/field_color.js',
                array('wp-color-picker'),
                time(),
                true
            );
        } else {
            wp_enqueue_script(
                'redux-opts-field-color-js',
                Redux_OPTIONS_URL . 'fields/color/field_color_farb.js',
                array('jquery', 'farbtastic'),
                time(),
                true
            );
        }
    }
}
