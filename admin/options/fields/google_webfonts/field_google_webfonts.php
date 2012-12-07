<?php
class Redux_Options_google_webfonts extends Redux_Options {

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
        $this->field['fonts'] = array();

        $fonts = get_transient('redux-opts-google-webfonts');
        if(!is_array(json_decode($fonts))) {
            $fonts = wp_remote_get('https://www.googleapis.com/webfonts/v1/webfonts?key=' . $this->args['google_api_key'], array('sslverify' => false));
            $fonts = wp_remote_retrieve_body($fonts);
            set_transient('redux-opts-google-webfonts', $fonts, 60 * 60 * 24);
        }
        $this->field['fonts'] = json_decode($fonts);
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
        echo '<p class="description" style="color:red;">' . __('The fonts provided below are free to use custom fonts from the <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts directory</a>.<br/>Please <a href="http://www.google.com/webfonts" target="_blank">browse the directory</a> to preview a font, then select your choice below.', Redux_TEXT_DOMAIN) . '</p>';

        if(isset($this->field['fonts']->error)) {
            echo '<p class="error"><span style="color: red;">Error:</span> ' . $this->field['fonts']->error->errors[0]->message . '</p>';
        } else {
            echo '<select id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . ']" ' . $class . 'rows="6" >';
               foreach($this->field['fonts']->items as $cut) {
                foreach($cut->variants as $variant) {
                    echo '<option value="' . $cut->family . ':' . $variant . '" ' . selected($this->value, $cut->family . ':' . $variant, false) . '>' . $cut->family . ' - ' . $variant . '</option>';
                  }
            }
            echo '</select>';
        }

        echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? ' <span class="description">' . $this->field['desc'] . '</span>' : '';
    }
}
