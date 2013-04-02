<?php
class Redux_Options_accordion {

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
//		echo '<h3 class="docs">Resize the outer container:</h3>';
		  echo '<div id="acc-resizer" class="ui-widget-content">';		
      $name = $this->args['opt_name'] . '[' . $this->field['id'] . '][]';
      $id = $this->field['id'];
      $class = (isset($this->field['class'])) ? $this->field['class'] : 'large-text';
      $placeholder = (isset($this->field['placeholder'])) ? ' placeholder="' . esc_attr($this->field['placeholder']) . '" ' : '';
      $rows = (isset($this->field['placeholder'])) ? $this->field['rows'] : 6;?>
<?php	echo '<div id="accordion1">';
		  $n= $this->field['number'] - 1;
	 	  for($i=0; $i <= $n; $i++){        ?>
		  <h3><?php echo $id.$i; ?></h3>
	  	<div><p>
        <textarea name="<?php echo $name; ?>" id="<?php echo $id; ?>" <?php echo $placeholder; ?> class="<?php echo $class; ?>" rows="<?php echo $rows; ?>" style="height:113px;width:624px;"><?php echo esc_attr($this->value[$i]); ?></textarea>
		  </p></div>			
<?php		}
		  echo'</div>';
	  	echo'</div>';	
      if($this->field['desc'] != '') : ?>
        <br/><span class="description"><?php echo $this->field['desc']; ?></span>
      <?php endif; 
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
            'redux-opts-accordion-js', 
            Redux_OPTIONS_URL . 'fields/accordion/jquery.accordion.js', 
            array('jquery'),
            time(),
            true
        );
        wp_enqueue_style(
            'redux-opts-accordion-css', 
            Redux_OPTIONS_URL . 'fields/accordion/accordion.css'
        );		
    }
}
