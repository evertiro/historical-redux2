<?php
class Redux_Options_google_webfonts extends Redux_Options {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 1.0.0
    */
    // function __construct($field = array(), $value ='', $parent) {
    //     parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
    //     $this->field = $field;
    //     $this->value = $value;
    //     $this->field['fonts'] = array();

    //     $fonts = get_transient('redux-opts-google-webfonts');
    //     if(!is_array(json_decode($fonts))) {
    //         $fonts = wp_remote_get('https://www.googleapis.com/webfonts/v1/webfonts?key=' . $this->args['google_api_key'], array('sslverify' => false));
    //         $fonts = wp_remote_retrieve_body($fonts);
    //         set_transient('redux-opts-google-webfonts', $fonts, 60 * 60 * 24);
    //     }
    //     $this->field['fonts'] = json_decode($fonts);
    // }
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
        echo '<p class="description" style="color:red;">' . __('The fonts provided below are free to use custom fonts from the <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts directory</a>', Redux_TEXT_DOMAIN) . '</p>';

        echo '<input type="text" id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . ']" class="font"  ' . $placeholder . 'value="' . esc_attr($this->value) . '" />';

        echo '<h3 id="' . $this->field['id'] . '" class="example">Lorem Ipsum is simply dummy text</h3>';
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
            'redux-opts-googlefonts-js', 
            Redux_OPTIONS_URL . 'fields/google_webfonts/jquery.fontselect.js', 
            array('jquery'),
            time(),
            true
        );
    }
}
