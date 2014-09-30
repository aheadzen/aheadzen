/**
 * JS for fontIconPicker
 */
 //var mywidget_id = jQuery("#"+field_userid).closest('.aheadzensite').attr('id');
function aheadzen_icons(iconsetxtid)
{
	jQuery(document).ready(function($) {
		
		  // variable icons list
		  var fnt_icons = {
			'Web Application Icons' : ["icon-mail", "icon-mail-alt", "icon-th-large", "icon-th", "icon-th-list", "icon-help-circled", "icon-info-circled", "icon-info", "icon-home", "icon-link", "icon-unlink", "icon-link-ext", "icon-link-ext-alt", "icon-attach", "icon-tag", "icon-tags", "icon-bookmark", "icon-bookmark-empty", "icon-download", "icon-upload", "icon-download-cloud", "icon-upload-cloud", "icon-reply", "icon-reply-all"],
			'Form Control Icons' : ["icon-search", "icon-ok", "icon-ok-circled", "icon-ok-circled2", "icon-ok-squared", "icon-cancel", "icon-cancel-circled", "icon-cancel-circled2", "icon-plus", "icon-plus-circled", "icon-plus-squared", "icon-plus-squared-small", "icon-minus", "icon-minus-circled", "icon-minus-squared", "icon-minus-squared-alt", "icon-minus-squared-small", "icon-quote-right", "icon-code", "icon-comment-empty", "icon-chat-empty"],
			'Media Icons' : ["icon-video", "icon-videocam", "icon-picture", "icon-camera", "icon-camera-alt", "icon-export", "icon-export-alt", "icon-pencil", "icon-pencil-squared", "icon-edit", "icon-print"],
			'Popular Icons' : ["icon-heart", "icon-heart-empty", "icon-star", "icon-star-empty", "icon-star-half", "icon-star-half-alt", "icon-user", "icon-users", "icon-male", "icon-female", "icon-forward", "icon-quote-left", "icon-retweet", "icon-keyboard", "icon-gamepad", "icon-comment", "icon-chat"]};

		  jQuery('#'+iconsetxtid).fontIconPicker({
			theme: 'fip-darkgrey',
			source: fnt_icons
		  }).on('change', function() {
		  
		  var currentspan = jQuery('#'+iconsetxtid).parent('div').find('span[class*=icon-]');
		  var parentclasses = currentspan.attr('class');
		  if(parentclasses){
			  var afterclass = parentclasses.replace(/(^|\s)icon-\S+/g, '');
			  currentspan.removeClass(parentclasses);
		  }
		  currentspan.addClass(jQuery(this).val()+' '+afterclass);
		  
			var mywidget_id = jQuery("#"+iconsetxtid).closest('.aheadzensite').attr('id');
			var ajax_url = AJAX_SITE_URL;
			var field_userid = iconsetxtid;
			var val = jQuery(this).val();
			var data = {
				'action': 'inline-save-widget',
				'val': val,
				'widget-id': mywidget_id,
				'field': field_userid
			};				
			jQuery.post(ajax_url, data, function(response) {
				if(response=='saved_success')
				{
					jQuery( ".inline_edit_success_msg" ).html( '<span>Updated Successfully</span>' );
					setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
				}else{
					jQuery( ".inline_edit_success_msg" ).html( '<span class="errormsg">Something wrong, try again...</span>' );
					setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
				}
			});
			/*
			var nextSpan = jQuery('#'+iconsetxtid),
			iconToChange = nextSpan.closest('i').attr('class'),
			selectedIcon = jQuery(this).val();
			if(selectedIcon == '') {
			  iconToChange.html('<i class="icon-block"></i>');
			  iconToChange.removeClass('text-primary').addClass('text-danger');
			} else {
				jQuery('.'+hidden_id).removeClass( "myselected" );
				jQuery('.'+hidden_id+'.'+val).addClass( "myselected" );			
			}
			*/
			
		  });

	});
}