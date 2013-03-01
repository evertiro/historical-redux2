<?php
class Redux_Validation_color {
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since Redux_Options 1.0.0
	*/
	function __construct($field, $value, $current) {
		$this->field = $field;
		$this->field['msg'] = (isset($this->field['msg'])) ? $this->field['msg'] : __('This field must be a valid color value.', Redux_TEXT_DOMAIN);
		$this->value = $value;
		$this->current = $current;
		$this->validate();
	}

	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since Redux_Options 1.0.0
	*/
	function validate() {
		if(!is_array($this->value)) {
			if($this->value[0] != '#') {
				$this->value = (isset($this->current)) ? $this->current : '';
				$this->error = $this->field;
				return;
			}
			
			if(strlen($this->value) != 7) {
				$this->value = (isset($this->current)) ? $this->current : '';
				$this->error = $this->field;
			}
		}

		if(is_array($this->value)) {
			foreach($this->value as $k => $value) {
				if(isset($this->error)){ continue; }
				if($value[0] != '#') {
					$this->value[$k] = (isset($this->current[$k])) ? $this->current[$k] : '';
					$this->error = $this->field;
					continue;
				}

				if(strlen($value) != 7) {
					$this->value[$k] = (isset($this->current[$k])) ? $this->current[$k] : '';
					$this->error = $this->field;
				}
			}
        }
	}
}
