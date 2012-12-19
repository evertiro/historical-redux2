/*global jQuery, document, redux_upload, formfield:true, preview:true, tb_show, window, imgurl:true, tb_remove, $relid:true*/
/*
This is the uploader for wordpress starting from version 3.5
*/
jQuery(document).ready(function(){

            jQuery(".redux-opts-upload").click( function( event ) {
 
                var relid = jQuery(this).attr('rel-id');

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if ( typeof(custom_file_frame)!=="undefined" ) {
                    custom_file_frame.open();
                    return;
                }

                // Create the media frame.
                custom_file_frame = wp.media.frames.customHeader = wp.media({
                    // Set the title of the modal.
                    title: jQuery(this).data("choose"),

                    // Tell the modal to show only images. Ignore if want ALL
                    library: {
                        type: 'image'
                    },
                    // Customize the submit button.
                    button: {
                        // Set the text of the button.
                        text: jQuery(this).data("update")
                    }
                });

                custom_file_frame.on( "select", function() {
                    // Grab the selected attachment.
                    var attachment = custom_file_frame.state().get("selection").first();

                    // Update value of the targetfield input with the attachment url.
                    jQuery('.redux-opts-screenshot').attr('src', attachment.attributes.url);
                    jQuery('#' + relid ).val(attachment.attributes.url);

                    jQuery('.redux-opts-upload').hide();
                    jQuery('.redux-opts-screenshot').show();
                    jQuery('.redux-opts-upload-remove').show();
            });

            custom_file_frame.open();
        });

    jQuery(".redux-opts-upload-remove").click( function( event ) {

        var relid = jQuery(this).attr('rel-id');
        console.log("hahaha");

        event.preventDefault();

        jQuery('#' + relid).val('');
        jQuery(this).prev().fadeIn('slow');
        jQuery('.redux-opts-screenshot').fadeOut('slow');
        jQuery(this).fadeOut('slow');
    });

});