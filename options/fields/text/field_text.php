<?php
/**
 * Render <input type="text"> and its HTML5 variations (type="number", "email", etc.)
 * For the HTML5 input types, a special 'html5type' parameter is used.
 * New HTML5 attributes, such as "min", "max", "step", etc., are supported
 * @example
 * <code>
 *    'type'  => 'text',
 *    'html5type' => 'number',
 *    'min' => 0,
 * </code>
 */
class Redux_Options_text {

	/**
	 * Field Constructor.
	 * @since Redux_Options 1.0.0
	 */
	function __construct($field = array(), $value = '', $parent) {
		$this->field = $field;
		$this->value = $value;
		$this->args  = $parent->args;
	}

	/**
	 * Field Render Function.
	 * Takes the vars and outputs the HTML for the field in the settings
	 * @since Redux_Options 1.0.0
	 */
	function render() {
		/**
		 * @url http://html5doctor.com/html5-forms-introduction-and-new-attributes/
		 * @url https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input
		 */
		static $allowed_attributes = array(
			'type',
			'id',
			'name',
			'value',
			'class',
			'style',
			'maxlength',
			'placeholder',
			'min',
			'max',
			'step',
			'pattern',
			'required',
			'autocomplete',
			'multiple'
		);

		/*
		 * Do not mess with the original $this->field content
		 */
		$attributes = $this->field;

		/*
		 * Default input type is "text", but it can be overridden by the 'html5type' parameter
		 */
		$attributes['type'] = 'text';
		if (isset($attributes['html5type'])) {
			$attributes['type'] = $attributes['html5type'];
			unset($attributes['html5type']);
		}

		/*
		 * Set default class if not specified
		 */
		if (!isset($attributes['class'])) {
			$attributes['class'] = 'regular-text';
		}

		/*
		 * All form values are passed as an array, and saved as serialized
		 */
		$attributes['name'] = $this->args['opt_name'] . '[' . $attributes['id'] . ']';

		$attributes['value'] = $this->value;

		/*
		 * Print the tag
		 */
		echo '<input';
		foreach ($attributes as $name => $value) {
			if (in_array($name, $allowed_attributes)) {
				echo ' ' . $name . '="' . esc_attr($value) . '"';
			}
		}
		echo ' />';

		/*
		 * Print the optional description
		 */
		if (!empty($this->field['desc'])) {
			echo ' <span class="description">' . $this->field['desc'] . '</span>';
		}
	}
}
