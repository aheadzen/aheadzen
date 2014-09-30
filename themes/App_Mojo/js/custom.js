jQuery.noConflict();
jQuery(document).ready(function($){
	
	//ONE PAGE NAV...
	jQuery('#main-menu').onePageNav({
		currentClass : 'current_page_item',
		//filter		 : ':not(.external)',
		scrollSpeed  : 750,
		scrollOffset : 90,
		scrollChange : fixMagicline
	});
	
	//MINI MOBILE MENU...
	jQuery('nav#main-menu').meanmenu({
		meanMenuContainer :  jQuery('header #menu-container'),
		meanRevealPosition:  'left',
		meanScreenWidth   :  797,
		meanMenuClose	  :  "<span /><span /><span />"
	});
	
	//TABS...
	if(jQuery('.tabs-vertical-frame').length > 0){
		
		jQuery('.tabs-vertical-frame').tabs('> .tabs-vertical-frame-content');
		
		jQuery('.tabs-vertical-frame').each(function(){
		  jQuery(this).find("li:first").addClass('current');
		});
		
		jQuery('.tabs-vertical-frame li').click(function(){
		  jQuery(this).parent().children().removeClass('current');
		  jQuery(this).addClass('current');
		});
	}
	
	//TESTIMONIAL QUOTE...
	jQuery('.quotes_wrapper').quovolver({
		children        : 'li',
		transitionSpeed : 600,
		autoPlay        : true,
		equalHeight     : true,
		navPosition     : 'below',
		navPrev         : false,
		navNext         : false,
		navNum          : true
    });
	
	//PROGRESS BAR...
	jQuery('#donutchart1').one('inview', function (event, visible) {
		if (visible == true) {
			jQuery("#donutchart1").donutchart({'size': 140, 'donutwidth': 10, 'fgColor': '#E74D3C', 'bgColor': '#f5f5f5', 'textsize': 15 });
			jQuery("#donutchart1").donutchart("animate");
			
			jQuery("#donutchart2").donutchart({'size': 140, 'donutwidth': 10, 'fgColor': '#FF7F50', 'bgColor': '#f5f5f5', 'textsize': 15 });
			jQuery("#donutchart2").donutchart("animate");
			
			jQuery("#donutchart3").donutchart({'size': 140, 'donutwidth': 10, 'fgColor': '#8aba23', 'bgColor': '#f5f5f5', 'textsize': 15 });
			jQuery("#donutchart3").donutchart("animate");
			
			jQuery("#donutchart4").donutchart({'size': 140, 'donutwidth': 10, 'fgColor': '#35aad8', 'bgColor': '#f5f5f5', 'textsize': 15 });
			jQuery("#donutchart4").donutchart("animate");
		}
	});
	
	
	/* To Top */
	jQuery().UItoTop({ easingType: 'easeOutQuart' });
	
	//ISOTOPE...	
	var $pphoto = jQuery('a[data-gal^="prettyPhoto[gallery]"]');
	if($pphoto.length){
		//PRETTYPHOTO...
		jQuery("a[data-gal^='prettyPhoto[gallery]']").prettyPhoto({ 
			show_title: false,
			social_tools: false,
			deeplinking: false
		});
	}
	
	//CONTACT BOX VALIDATION & MAIL SENDING....
	//AJAX SUBMIT...
	jQuery('form[name="frmcontact"]').submit(function () {
		
		var This = jQuery(this);
		
		if(jQuery(This).valid()) {
			var action = jQuery(This).attr('action');

			var data_value = unescape(jQuery(This).serialize());
			$.ajax({
				 type: "POST",
				 url:action,
				 data: data_value,
				 error: function (xhr, status, error) {
					 confirm('The page save failed.');
				   },
				  success: function (response) {
					jQuery('#ajax_contact_msg').html(response);
					jQuery('#ajax_contact_msg').slideDown('slow');
					if (response.match('success') != null) jQuery(This).slideUp('slow');
				 }
			});
		}
		return false;
    });
	jQuery('form[name="frmcontact"]').validate({
		rules: { 
			txtname: { required: true },
			txtemail: { required: true, email: true }
		},
		errorPlacement: function(error, element) { }
	});
});

//CUSTOM FIX...
function fixMagicline() {
		
    var $magicLine = jQuery("#magic-line");
    
    var leftPos, newWidth;
	
	leftPos = jQuery(".current_page_item a").position().left;
    newWidth = jQuery(".current_page_item").width();
	
	$magicLine.stop().animate({
		left: leftPos,
		width: newWidth
	});
}

// animate css + jquery inview configuration
(function($){
	jQuery(".animate").each(function(){
		jQuery(this).bind('inview', function (event, visible) {
			var $this = jQuery(this),
				$animation = ( $this.data("animation") !== undefined ) ? $this.data("animation") : "slideUp";
				$delay = ( $this.data("delay") !== undefined ) ? $this.data("delay") : 300;
				
				if (visible == true) {
					setTimeout(function() { $this.addClass($animation);	},$delay);
				}else{
					setTimeout(function() { $this.removeClass($animation); },$delay);
				}
		});
	});
	
})(jQuery);	

function funtoScroll(x, e) {
	
	var str = new String(e.target);
	var pos = str.indexOf('#');
	var t = str.substr(pos);
	$.scrollTo(t, 750);

	jQuery(x).parent('.mean-bar').next('.mean-push').remove();		
	jQuery(x).parent('.mean-bar').remove();

	jQuery('nav#main-menu').meanmenu({
		meanMenuContainer :  jQuery('header #menu-container'),
		meanRevealPosition:  'left',
		meanScreenWidth   :  767,
		meanMenuClose	  :  "<span /><span /><span />"		
	});
	
	e.preventDefault();
}