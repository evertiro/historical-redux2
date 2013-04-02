jQuery(function() {
//jQuery('body').addClass('js');  	
	jQuery( "#accordion1" ).accordion({
		heightStyle: "content",
		collapsible: true
		});
jQuery('.ui-accordion-header h3').css({"padding-left":25});		
});
/*jQuery(document).ready(function(){
	jQuery( "#accordion1" ).show();
	jQuery( "#accordion1" ).accordion( "refresh" );
});*/
jQuery(function() {
jQuery( "#acc-resizer" ).resizable({
minHeight: 140,
minWidth: 200,
resize: function() {
//jQuery( "#accordion1" ).accordion( "refresh" );
}
});
});
