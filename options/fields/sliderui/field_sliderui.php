<?php
class Redux_Options_sliderui {

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
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 1.0.0
    */
    function render() {
		
		$s_val = $s_min = $s_max = $s_step = $s_edit = '';					
		$s_val  = stripslashes($this->value);
					
		if(!isset($this->field['min'])){
      $s_min  = '0'; }
    else{ 
      $s_min = $this->field['min']; }
		if(!isset($this->field['max'])){
      $s_max  = $s_min + 100; }
    else{
      $s_max = $this->field['max']; }
		if(!isset($this->field['step'])){
      $s_step  = '1'; }
    else{
      $s_step = $this->field['step'];
      }
    if ($s_val == '') $s_val = $s_min;					
					//values
		$slider_data = 'data-id="'.$this->field['id'].'" data-val="'.$s_val.'" data-min="'.$s_min.'" data-max="'.$s_max.'" data-step="'.$s_step.'"';		
		$sui = 'sliderui_'.$this->field['id'];
        $class = (isset($this->field['class'])) ? $this->field['class'] : 'regular-text';        	
		echo (isset($this->field['label'])&& !empty($this->field['label']))? '<label for="'.$this->field['id'].'"> <strong>'.$this->field['label'].' :</strong></label>':'';	
    echo '<input type="text" id="'.$this->field['id'].'" name="'. $this->args['opt_name'] . '[' . $this->field['id'] . ']" class="' . $class . '" value="' . esc_attr($this->value) . '" /><br/>';		
		echo'<div id="'.$sui.'" class="redux_sliderui" style="margin-top: 10px;" name="'.$this->args['opt_name'] . '[' .$sui.']"  value="'. esc_attr($this->value).'" '.$slider_data.'></div><br/>';
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
            'redux-opts-sliderui-js', 
            Redux_OPTIONS_URL . 'fields/sliderui/jquery.sliderui.js', 
            array('jquery'),
            time(),
            true
        );
    }
}
