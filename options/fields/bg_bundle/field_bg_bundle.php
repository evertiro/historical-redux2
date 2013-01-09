<?php
class Redux_Options_bg_bundle extends Redux_Options {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    function __construct($field = array(), $value ='', $parent = '') {
        parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
        $class = (isset($this->field['class'])) ? $this->field['class'] : 'regular-text';
		$values = array();
	    $values['img'] = (isset($this->value['img']) && $this->value['img'] != '') ? $this->value['img'] : '';
	    $values['color'] = (isset($this->value['color'])) ? $this->value['color'] : '';

        echo '<input type="hidden" id="' . $this->field['id'] . '-img" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][img]" value="' . $values['img'] . '" class="' . $class . '" />';
        echo '<img class="redux-opts-screenshot" id="redux-opts-screenshot-' . $this->field['id'] . '" src="' . $values['img'] . '" />';
        if (!isset($this->value['img']) || $this->value['img'] == '') {
		    $remove = ' style="display:none;"'; $upload = '';
	    } else {
		    $remove = ''; $upload = ' style="display:none;"';
	    }
        echo ' <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);"class="redux-opts-upload button-secondary"' . $upload . ' rel-id="' . $this->field['id'] . '-img">' . __('Upload', Redux_TEXT_DOMAIN) . '</a>';
        echo ' <a href="javascript:void(0);" class="redux-opts-upload-remove"' . $remove . ' rel-id="' . $this->field['id'] . '-img">' . __('Remove Upload', Redux_TEXT_DOMAIN) . '</a>';

	    echo '<table><tr>';
	    echo '<td class="compact">';
	    echo '<strong>Repetition:</strong><div class="clear"></div>';
	    echo '<select id="' . $this->field['id'] . '-repeat" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][repeat]" rows="6">';
	    echo '<option value="none" ' . selected($this->value['repeat'], 'none', false) . '>None</option>';
	    echo '<option value="repeat-x" ' . selected($this->value['repeat'], 'repeat-x', false) . '>Repeat Horizontally</option>';
	    echo '<option value="repeat-y" ' . selected($this->value['repeat'], 'repeat-y', false) . '>Repeat Vertically</option>';
	    echo '<option value="repeat" ' . selected($this->value['repeat'], 'repeat', false) . '>Both</option>';
	    echo '<option value="cover" ' . selected($this->value['repeat'], 'cover', false) . '>Fit to element</option>';
	    echo '</select></td>';

	    echo '<td class="compact">';
	    echo '<strong>Position:</strong><div class="clear"></div>';
	    echo '<select id="' . $this->field['id'] . '-dir" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][pos]" rows="6">';
	    echo '<option value="left top" ' . selected($this->value['pos'], 'left top', false) . '>Left Top</option>';
	    echo '<option value="left center" ' . selected($this->value['pos'], 'left center', false) . '>Left Center</option>';
	    echo '<option value="left bottom" ' . selected($this->value['pos'], 'left bottom', false) . '>Left Bottom</option>';
	    echo '<option value="center top" ' . selected($this->value['pos'], 'center top', false) . '>Center Top</option>';
	    echo '<option value="center center" ' . selected($this->value['pos'], 'center center', false) . '>Center Center</option>';
	    echo '<option value="center bottom" ' . selected($this->value['pos'], 'center bottom', false) . '>Center Bottom</option>';
	    echo '<option value="right top" ' . selected($this->value['pos'], 'right top', false) . '>Right Top</option>';
	    echo '<option value="right center" ' . selected($this->value['pos'], 'right center', false) . '>Right Center</option>';
	    echo '<option value="right bottom" ' . selected($this->value['pos'], 'right bottom', false) . '>Right Bottom</option>';

	    echo '<td class="compact">';
	    echo '<strong>Color:</strong><div class="clear"></div>';
	    if(get_bloginfo('version') >= '3.5') {
		    echo '<input type="text" id="' . $this->field['id'] . '-color" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][color]" value="' . $values['color'] . '" class="popup-colorpicker" style="width: 70px;" data-default-color="' . esc_attr($values['color']) . '"/>';
	    } else {
		    echo '<div class="farb-popup-wrapper">';
		    echo '<input type="text" id="' . $this->field['id'] . '-color" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][color]" value="' . $values['color'] . '" class="popup-colorpicker" style="width:70px;"/>';
		    echo '<div class="farb-popup"><div class="farb-popup-inside"><div id="' . $this->field['id'] . 'picker" class="color-picker"></div></div></div>';
		    echo '</div>';
	    }
	    echo '</td></tr></table>';

        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? '<br/><span class="description">' . $this->field['desc'] . '</span>' : '';
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
		    'redux-opts-field-bg-bundle-js',
		    Redux_OPTIONS_URL . 'fields/bg_bundle/field_bg_bundle.js',
		    array('jquery'),
		    time(),
		    true
	    );

        $wp_version = floatval(get_bloginfo('version'));

        if ( $wp_version < "3.5" ) {
            wp_enqueue_script(
                'redux-opts-field-upload-js', 
                Redux_OPTIONS_URL . 'fields/upload/field_upload_3_4.js', 
                array('jquery', 'thickbox', 'media-upload'),
                time(),
                true
            );
            wp_enqueue_style('thickbox');
	        wp_enqueue_script(
		        'redux-opts-field-color-js',
		        Redux_OPTIONS_URL . 'fields/color/field_color_farb.js',
		        array('jquery', 'farbtastic'),
		        time(),
		        true
	        );
        } else {
            wp_enqueue_script(
                'redux-opts-field-upload-js', 
                Redux_OPTIONS_URL . 'fields/upload/field_upload.js', 
                array('jquery'),
                time(),
                true
            );
	        wp_enqueue_style('wp-color-picker');
	        wp_enqueue_script(
		        'redux-opts-field-color-js',
		        Redux_OPTIONS_URL . 'fields/color/field_color.js',
		        array('wp-color-picker'),
		        time(),
		        true
	        );
            wp_enqueue_media();
        }
        wp_localize_script('redux-opts-field-upload-js', 'redux_upload', array('url' => $this->url.'fields/upload/blank.png'));
    }
}
