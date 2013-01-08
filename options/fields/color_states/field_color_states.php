<?php
class Redux_Options_color_states extends Redux_Options {

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
        $unactive = isset($this->field['unactive']) ? $this->field['unactive'] : false;

        if(get_bloginfo('version') >= '3.5') {
            echo "<table><tr><td class='compact'>";
            echo '<strong>' . __('Normal:', Redux_TEXT_DOMAIN) . '</strong><div class="clear"></div><input type="text" id="' . $this->field['id'] . '-normal" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][normal]" value="' . $this->value['normal'] . '" class="' . $class . ' popup-colorpicker" style="width:70px;" data-default-color="' . esc_attr($this->value['normal']) . '"/>';
            echo "</td><td class='compact'>";
            echo '<strong>' . __('Hover:', Redux_TEXT_DOMAIN) . '</strong><div class="clear"></div><input type="text" id="' . $this->field['id'] . '-hover" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][hover]" value="' . $this->value['hover'] . '" class="' . $class . ' popup-colorpicker" style="width:70px;" data-default-color="' . esc_attr($this->value['hover']) . '"/>';
            echo "</td></tr><tr><td class='compact'>";
            echo '<strong>' . __('Active:', Redux_TEXT_DOMAIN) . '</strong><div class="clear"></div><input type="text" id="' . $this->field['id'] . '-active" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][active]" value="' . $this->value['active'] . '" class="' . $class . ' popup-colorpicker" style="width:70px;" data-default-color="' . esc_attr($this->value['active']) . '"/>';
            if ($unactive) {
                echo "<td class='compact'><strong>" . __('Unactive:', Redux_TEXT_DOMAIN) . '</strong><div class="clear"></div><input type="text" id="' . $this->field['id'] . '-unactive" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][unactive]" value="' . $this->value['unactive'] . '" class="' . $class . ' popup-colorpicker" style="width:70px;" data-default-color="' . esc_attr($this->value['unactive']) . '"/></td>';
            } else {
                echo "<td class='compact'>&nbsp;</td>";
            }
            echo "</td></tr>";
            echo (isset($this->field['desc']) && !empty($this->field['desc']))?' <tr><td class="compact" colspan="2"><p class="description">'.$this->field['desc'].'</p></td></tr>':'';
            echo '</table>';
        } else {
            echo '<div class="farb-popup-wrapper" id="' . $this->field['id'] . '">';
            echo __('Normal: ', Redux_TEXT_DOMAIN) . ' <input type="text" id="' . $this->field['id'] . '-normal" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][normal]" value="' . $this->value['normal'] . '" class="' . $class . ' popup-colorpicker" style="width:70px;"/>';
            echo '<div class="farb-popup"><div class="farb-popup-inside"><div id="' . $this->field['id'] . '-normalpicker" class="color-picker"></div></div></div>';
            echo __('Hover: ', Redux_TEXT_DOMAIN) . ' <input type="text" id="' . $this->field['id'] . '-hover" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][hover]" value="' . $this->value['hover'] . '" class="' . $class . ' popup-colorpicker" style="width:70px;"/>';
            echo '<div class="farb-popup"><div class="farb-popup-inside"><div id="' . $this->field['id'] . '-hoverpicker" class="color-picker"></div></div></div>';
            echo __('Active: ', Redux_TEXT_DOMAIN) . ' <input type="text" id="' . $this->field['id'] . '-active" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][active]" value="' . $this->value['active'] . '" class="' . $class . ' popup-colorpicker" style="width:70px;"/>';
            echo '<div class="farb-popup"><div class="farb-popup-inside"><div id="' . $this->field['id'] . '-activepicker" class="color-picker"></div></div></div>';
            if ($unactive) {
                echo __('Unactive: ', Redux_TEXT_DOMAIN) . ' <input type="text" id="' . $this->field['id'] . '-unactive" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][unactive]" value="' . $this->value['unactive'] . '" class="' . $class . ' popup-colorpicker" style="width:70px;"/>';
                echo '<div class="farb-popup"><div class="farb-popup-inside"><div id="' . $this->field['id'] . '-unactivepicker" class="color-picker"></div></div></div>';
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
