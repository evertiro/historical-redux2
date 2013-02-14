<?php
class Redux_Options_gfonts extends Redux_Options {

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
        $class = (isset($this->field['class'])) ? 'class="gfonts_select ' . $this->field['class'] . '" ' : 'gfonts_select';

        if ($this->args['google_api_key'] == '') {
            echo '<p>' . __('Your Google Webfonts API key is not defined (yet!)', Redux_TEXT_DOMAIN) . '</p>';
            return;
        } else {
            if (false === ($results = get_transient( 'gfonts_cached_list'))) {
                $gfonts_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . $this->args['google_api_key'] . '&sort=alpha';
                $init = curl_init($gfonts_url);
                $options = array(
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => array('Content-type: application/json')
                );
                curl_setopt_array($init, $options);
                $results_ugly = curl_exec($init);
                $results = json_decode($results_ugly, true);

                set_transient('gfonts_cached_list', $results, 60*60*24);
            }

	        $gfonts_variants = array();

	        echo '<table><tr style="padding:5px;">';

	        echo '<td style="padding:5px;"><label for="' . $this->field['id'] . '-gfont-font">' . __('Font name: ', Redux_TEXT_DOMAIN) . '</label></td>';

            echo '<td style="padding:5px;"><select id="' . $this->field['id'] . '-gfont-font" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][font]" class="gfont_font ' . $class . '" rows="6" >';

	        if ($this->field['safe_fonts'] === true) {
		        $safe_fonts = array(
			        'Georgia, serif' => 'Georgia',
			        "'Helvetica Neue', Helvetica, Arial, sans-serif" => 'Helvetica/Arial',
			        "'Courier New', Courier, monospace" => 'Courier',
			        "'Trebuchet MS', Helvetica, sans-serif" => 'Trebuchet MS',
			        "'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', Lucida, Helvetica, Arial, sans-serif" => 'Lucida',
			        'Tahoma, sans-serif' => 'Tahoma',
			        'Verdana, sans-serif' => 'Verdana',
			        'Impact, Charcoal, sans-serif' => 'Impact'
		        );

		        echo '<optgroup label="System fonts">';
			        foreach ($safe_fonts as $k => $font_name) {
				        echo '<option value="' . $k . '" ' . selected($this->value['font'], $k, false) . '>' . $font_name . '</option>';
			        }
		        echo '</optgroup>';
	        }

	        echo '<optgroup label="Google web fonts">';
	            foreach ($results['items'] as $font){
	                $font_name = $font['family'];
	                $font_slug = str_replace(' ', '+', $font['family']);
		            $font_variants = '';

		            if (isset($this->field['variants']) && $this->field['variants'] == true && is_array($font['variants']) && !empty($font['variants'])) {
			            if ($this->value['font'] == $font_slug) $current_font_variants = $font['variants'];
			            $font_variants = implode(',',$font['variants']);
			            foreach ($font['variants'] as $variant) {
				            if (!array_key_exists($variant, $gfonts_variants)) $gfonts_variants[$variant] = $variant;
			            }
		            }
	                echo '<option data-font-variants="' . $font_variants . '" value="' . $font_slug . '" ' . selected($this->value['font'], $font_slug, false) . '>' . $font_name . '</option>';
	            }
	        echo '</optgroup>';

            echo '</select></td>';

	        if (isset($this->field['variants']) && $this->field['variants'] == true) {
		        echo '<tr style="padding:5px;">';

	            sort($gfonts_variants);

		        echo '<td style="padding:5px;"><label for="' . $this->field['id'] . '-gfont-variant">' . __('Font variant: ', Redux_TEXT_DOMAIN) . '</label></td>';

		        echo '<td style="padding:5px;"><select id="' . $this->field['id'] . '-gfont-variant" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][variant]" class="gfont_variant ' . $class . '" rows="6" >';
		        foreach ($gfonts_variants as $gfont_variant) {
			        $disabled = in_array($gfont_variant, $current_font_variants) ? '' : 'disabled="disabled"';
			        echo '<option ' . $disabled . ' value="' . $gfont_variant . '" ' . selected($this->value['variant'], $gfont_variant, false) . '>' . $gfont_variant . '</option>';
		        }
		        echo '</select></td>';
	        }

	        echo '</tr></table>';
        }

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
            'redux-opts-gfonts-js',
            Redux_OPTIONS_URL . 'fields/gfonts/field_gfonts.js',
            array('jquery'),
            time(),
            true
        );
    }
}
