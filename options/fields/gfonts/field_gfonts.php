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
            echo '<p class="">Your Google Webfonts API key is not defined (yet!).</p>';
            return;
        } else {

            if ( false === ( $results = get_transient( 'gfonts_cached_list' ) ) ) {
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

            echo '<select id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . ']" class="' . $class . '" rows="6" >';

	        if ($this->field['safe_fonts'] === true) {
		        $safe_fonts = array(
			        'Georgia, serif' => 'Georgia',
			        "'Helvetica Neue', Helvetica, Arial, sans-serif" => 'Helvetica/Arial',
			        "'Courier New', Courier, monospace" => 'Courier',
			        "Trebuchet MS', Helvetica, sans-serif" => 'Trebuchet MS',
			        "'Lucida Console', Moncao, monospace" => 'Lucida',
			        'Tahoma, sans-serif' => 'Tahoma',
			        'Verdana, sans-serif' => 'Verdana',
			        'Impact, Charcoal, sans-serif' => 'Impact'
		        );

		        echo '<optgroup label="System fonts">';
			        foreach ($safe_fonts as $k => $font_name) {
				        echo '<option value="' . $k . '" ' . selected($this->value, $k, false) . '>' . $font_name . '</option>';
			        }
		        echo '</optgroup>';
	        }

	        echo '<optgroup label="Google web fonts">';
	            foreach ($results['items'] as $font){
	                $font_name = $font['family'];
	                $font_slug = str_replace(' ', '+', $font['family']);

	                echo '<option value="' . $font_slug . '" ' . selected($this->value, $font_slug, false) . '>' . $font_name . '</option>';
	            }
	        echo '</optgroup>';

            echo '</select>';
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
