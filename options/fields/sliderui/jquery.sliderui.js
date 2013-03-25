  /**
	  * JQuery UI Slider function
	  * Dependencies 	 : jquery, jquery-ui-slider
	  * Feature added by : hittheroadjack - http://wp4tune.com/
	  * Date 			 : 03.26.2013
	  */ 
	jQuery('.redux_sliderui').each(function() {
		
		var obj   = jQuery(this);
		var sId   = "#sliderui_" + obj.data('id');
		var tId	  = obj.data('id');	
		var val   = parseInt(obj.data('val'));
		var min   = parseInt(obj.data('min'));
		var max   = parseInt(obj.data('max'));
		var step  = parseInt(obj.data('step'));
		jQuery('.ui-slider-handle .ui-state-default .ui-corner-all').css('color', '#ff9900');  
		
		//slider init
		obj.slider({
			value: val,
			min: min,
			max: max,
			step: step,
			slide: function( event, ui ) {
				jQuery(sId).val( ui.value );
				jQuery('#' + tId).val(ui.value);

			}			
		});
		jQuery(sId).children('a').css({background:"#ff9900", height: "25px"});	// just an example for mod CSS - maybe also via CSS file
	});
