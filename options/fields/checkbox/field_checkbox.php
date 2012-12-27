<?php
class Redux_Options_checkbox extends Redux_Options {

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
        $name = $this->args['opt_name'] . '[' . $this->field['id'] . ']';
        $id = $this->field['id'];
        $desc = isset($this->field['desc']) ? $this->field['desc'] : '';
        $class = isset($this->field['class']) ? $this->field['class'] : '';
        $switch = isset($this->field['switch']) ? $this->field['switch'] : false;
        ?>

    		<label <?php if($switch) : ?>class="switch_wrap"<?php endif; ?>>
				<input name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="<?php echo $class; ?>" value="1" <?php echo checked($this->value, '1', FALSE); ?> type="checkbox" />
					<?php if($switch) : ?><div class="switch"><span class="bullet"></span></div><?php endif; ?>
					<?php if($desc != '') : ?>
					<label for="<?php echo $id; ?>"><?php echo $desc; ?></label>
					<?php endif; ?>
			</label>

        <?php
    }
}
