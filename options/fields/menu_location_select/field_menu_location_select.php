<?php
require_once(dirname(__FILE__).'/../select/'.'field_select.php'); 
class Redux_Options_menu_location_select extends Redux_Options_select {

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
		
        global $_wp_registered_nav_menus;
		if($_wp_registered_nav_menus) {
			$this->field['options'] = $_wp_registered_nav_menus;
		}
    }
}