<?php
class Redux_Validation_url extends Redux_Options {

	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since Redux_Options 1.0.0
	*/
	function __construct($field, $value, $current) {
		parent::__construct();
		$this->field = $field;
		$this->field['msg'] = (isset($this->field['msg'])) ? $this->field['msg'] : __('You must provide a valid URL for this option.', Redux_TEXT_DOMAIN);
		$this->value = $value;
		$this->current = $current;
		$this->validate();
	}

	/**
	 * Field Render Function.
	 *
	 * Takes the vars and validates them
	 *
	 * @since Redux_Options 1.0.0
	*/
	function validate() {
		if (function_exists('filter_var') && filter_var($this->value, FILTER_VALIDATE_URL) == false) {
			$this->value = (isset($this->current))?$this->current:'';
			$this->error = $this->field;
		} else {
			$this->value = esc_url_raw($this->value);
		}		
	}
}
