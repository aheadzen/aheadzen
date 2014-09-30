/*REF : http://www.webmaster-source.com/2013/02/06/using-the-wordpress-3-5-media-uploader-in-your-plugin-or-theme/*/


function widget_image_button(css_class,text_id)
{
	jQuery("."+css_class).live("click", function(e){
	var myuploader;
	  e.preventDefault();
	  if (myuploader) {
			myuploader.open();
			return;
		}
		
		//Extend the wp.media object
		myuploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		
		//When a file is selected, grab the URL and set it as the text field's value
		myuploader.on('select', function() {
			attachment = myuploader.state().get('selection').first().toJSON();
			//alert(attachment.url);
			jQuery('#'+ text_id ).val(attachment.url);
			jQuery('#'+ text_id+'_img' ).attr('src',attachment.url);
				
			/*jQuery.ajax({
				type : 'POST',
				url : site_admin_url,
				data : { action: 'fanfabsavefeaturedimg', pid: post_id, aid: attachment.url }, // Add further params if you need to
				success : function(r) {
					$('#'+post_id+'_img').attr('src',attachment.url);	
					//your ajax code here
					}
				});
			*/
		});

		//Open the uploader dialog
		myuploader.open();
	});
}




jQuery(document).ready(function($){
 
	var post_id='';
    var custom_uploader;
	var custom_uploader2;
 
 
    jQuery('.imgbutton').click(function(e) {
		post_id = this.id;
		e.preventDefault();
		//If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
			attachment = custom_uploader.state().get('selection').first().toJSON();
			jQuery.ajax({
				type : 'POST',
				url : site_admin_url,
				data : { action: 'fanfabsavefeaturedimg', pid: post_id, aid: attachment.url }, // Add further params if you need to
				success : function(r) {
					$('#'+post_id+'_img').attr('src',attachment.url);	
					//your ajax code here
					}
				});
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
	
	
	jQuery('.imgbutton_all').click(function(e) {
		e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader2) {
            custom_uploader2.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader2 = wp.media.frames.file_frame = wp.media({
            title: 'Upload Image and get URL for widget usage by select image > Edit Image(at right) > File URL',
            button: {
                text: ''
            },
            multiple: false
        });
 
        //Open the uploader dialog
        custom_uploader2.open();
 
    });
 
 return false;
});


/*GALLERY DIALOG BOX*/
function widget_image_button_gallery(clickbutton,imagesid,htmldiv)
{
		jQuery( '#'+clickbutton ).live( 'click', function( event ) {
			event.preventDefault();
			
			var images = jQuery( '#'+imagesid ).val();
			var gallery_state = images ? 'gallery-edit' : 'gallery-library';
			
			var wp_media_frame;
			  event.preventDefault();
			  if (wp_media_frame) {
					wp_media_frame.open();
					return;
				}
				
			// create new media frame
			// You have to create new frame every time to control the Library state as well as selected images
			var wp_media_frame = wp.media.frames.wp_media_frame = wp.media( {
				title: 'My Gallery', // it has no effect but I really want to change the title
				frame: "post",
				toolbar: 'main-gallery',
				state: gallery_state,
				library: {
					type: 'image'
				},
				multiple: true
			} );

			// when open media frame, add the selected image to Gallery
			wp_media_frame.on( 'open', function() {
				var images = jQuery( '#'+imagesid ).val();				
				if ( !images )
					return;

				var image_ids = images.split( ',' );
				var library = wp_media_frame.state().get( 'library' );
				image_ids.forEach( function( id ) {
					attachment = wp.media.attachment( id );
					attachment.fetch();
					library.add( attachment ? [ attachment ] : [] );
				} );
			} );
			
			
			// when click Insert Gallery, run callback
			wp_media_frame.on( 'update', function() {

				var thumb_wrapper = jQuery( '#'+htmldiv );
				thumb_wrapper.html('');
				var image_urls = [];
				var image_ids = [];
				var mywidget_id = '';
				var library = wp_media_frame.state().get( 'library' );

				library.map( function( image ) {
					image = image.toJSON();
					image_urls.push( image.url );
					image_ids.push( image.id );
					jQuery( '#'+imagesid ).val(image_ids);
					
					mywidget_id = jQuery("#"+imagesid).closest('.aheadzensite').attr('id');
					if(mywidget_id)
					{
						thumb_wrapper.append('<div class="portfolio one-third column imagegallery"><div class="portfolio-thumb"><img width="463" height="400" src="' + image.url + '"><div class="image-overlay"><a data-gal="prettyPhoto[' + imagesid + ']" class="zoom" href="' + image.url + '"><span class="icon-search"></span></a></div></div></div>');
					}else{
						thumb_wrapper.append( '<img src="' + image.url + '" alt="" />' );
					}				
				
				} );
				
				if(image_ids!='')
				{
					var image_ids = jQuery( '#'+imagesid ).val();
					var data = {
						'action': 'inline-save-widget',
						'val': image_ids,
						'widget-id': mywidget_id,
						'field': imagesid
					};

					jQuery.post(ajax_url, data, function(response) {
						if(response=='saved_success')
						{
							jQuery( ".inline_edit_success_msg" ).html( '<span>Updated Successfully</span>' );
							setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
			
							//alert(response);
						}else{
							jQuery( ".inline_edit_success_msg" ).html( '<span class="errormsg">Something wrong, try again...</span>' );
							setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
						}
					});
				}
				
			} );
			
			//Open the uploader dialog
			wp_media_frame.open();
		} );

}

