/*REF : http://www.webmaster-source.com/2013/02/06/using-the-wordpress-3-5-media-uploader-in-your-plugin-or-theme/*/
jQuery(document).ready(function($){
 
	var post_id='';
    var custom_uploader;
 
 
    jQuery('.image_upload_button').click(function(e) {
		post_id = this.id;
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Save & Continue',
            button: {
                text: 'Save & Continue'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
			attachment = custom_uploader.state().get('selection').first().toJSON();
				window.location.href=theme_activation_session_url;
			});
			
        //Open the uploader dialog
        custom_uploader.open();
    });
 return false;
});
