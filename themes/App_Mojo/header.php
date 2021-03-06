<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en-gb" class="no-js"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--[if lt IE 9]> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
	<?php //do_action('aheadzen_seo_title');?>
	<title><?php wp_title( '|', true, 'right' ); ?><?php echo get_bloginfo('name')?></title>
	<?php
	$site_description = get_bloginfo( 'description', 'display' );
	if($site_description)
	{
	echo '<meta name="description" content="'.$site_description.'" />';
	}
	?>
	<?php 
	$favicon = get_option('aheadzen_favicon');
	if($favicon){
		echo '<link rel="shortcut icon" type="image/png" href="'.$favicon.'" />';
	}?>
	
	<!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
	<!--[if lte IE 8]>
		<script type="text/javascript" src="http://explorercanvas.googlecode.com/svn/trunk/excanvas.js"></script>
	<![endif]-->
    
<link href="<?php echo get_template_directory_uri();?>/style.css" rel="stylesheet" media="all" />
<?php
$aheadzen_pattern = get_option('aheadzen_pattern');
$aheadzen_skin = get_option('aheadzen_skin');
$aheadzen_layout = get_option('aheadzen_layout');
$aheadzen_bg_color = get_option('aheadzen_bg_color');
?>
<?php if($aheadzen_skin){?>
<link id="skin-css" media="all" type="text/css" href="<?php echo get_template_directory_uri();?>/skins/<?php echo $aheadzen_skin;?>/style.css" rel="stylesheet">
<?php }else{?>
<link id="skin-css" href="<?php echo get_template_directory_uri();?>/skins/skyblue/style.css" rel="stylesheet" media="all" />   
<?php }?>
<?php if($aheadzen_layout=='boxed' && ($aheadzen_pattern || $aheadzen_bg_color)){?>
<style type="text/css">
<?php if($aheadzen_bg_color){?>
body{background-color:<?php echo $aheadzen_bg_color;?>;}
<?php }elseif($aheadzen_pattern){?>
body{background-image: url("<?php echo get_template_directory_uri();?>/images/patterns/<?php echo $aheadzen_pattern;?>.jpg");}
<?php }?>
</style>
<?php }?>
	<link href="<?php echo get_template_directory_uri();?>/css/responsive.css" rel="stylesheet" type="text/css" />    
    <!-- **Animation stylesheets** -->
    <link href="<?php echo get_template_directory_uri();?>/css/animations.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo get_template_directory_uri();?>/css/prettyPhoto.css" rel="stylesheet" type="text/css" media="all" />
    
    <!-- **Font Awesome** -->
    <link href="<?php echo get_template_directory_uri();?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <!-- **Google - Fonts** -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300italic,400italic,600' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    
	<!-- **jQuery** -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
<script>
var theme_folder_url = '<?php echo get_template_directory_uri(); ?>/';
var site_admin_url = '<?php echo admin_url("admin-ajax.php"); ?>';
var widget_customization_url = '<?php echo admin_url().'customize.php?url='.urlencode(site_url());?>';
var ajax_url = '<?php echo site_url(); ?>';
</script>
<?php
	wp_enqueue_script('jquery');
	
	wp_enqueue_script('jquery-our-scrollTo', get_template_directory_uri().'/js/jquery.scrollTo.js');
	wp_enqueue_script('jquery-our-inview', get_template_directory_uri().'/js/jquery.inview.js');
	wp_enqueue_script('jquery-our-nav', get_template_directory_uri().'/js/jquery.nav.js');
	if(aheadzen_is_editing()){  }else{ 
	wp_enqueue_script('jquery-our-menu', get_template_directory_uri().'/js/jquery-menu.js');
	}
	wp_enqueue_script('jquery-our-meanmenu', get_template_directory_uri().'/js/jquery.meanmenu.min.js');
	wp_enqueue_script('jquery-our-quovolver', get_template_directory_uri().'/js/jquery.quovolver.min.js');
	wp_enqueue_script('jquery-our-donutchart', get_template_directory_uri().'/js/jquery.donutchart.js');
	wp_enqueue_script('jquery-our-isotope', get_template_directory_uri().'/js/jquery.isotope.min.js');
	wp_enqueue_script('jquery-our-prettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js');
	wp_enqueue_script('jquery-our-validate', get_template_directory_uri().'/js/jquery.validate.min.js');
	wp_enqueue_script('jquery-our-tabs', get_template_directory_uri().'/js/jquery.tabs.min.js');
	if(aheadzen_is_editing()){
?>
<style>
.content .aheadzensite {border: 1px dashed #fff;padding-bottom: 10px; margin-bottom: 40px;}
.content .aheadzensite:hover {border: 1px dashed #ccc;clear: both;}</style>
<?php
	}else{ 
	wp_enqueue_script('jquery-nicescroll', get_template_directory_uri().'/js/jquery.nicescroll.min.js');
	} 
	?>
	<!-- **To Top** -->
	<?php
	wp_enqueue_script('jquery-totop', get_template_directory_uri().'/js/jquery.ui.totop.min.js');
	wp_enqueue_script('jquery-bjqs', get_template_directory_uri().'/js/bjqs-1.3.min.js');
	
	if(aheadzen_is_editing()){
		//wp_enqueue_script('jquery');
		?>
		<script>
		var theme_custom_change_url = '<?php echo admin_url().'customize.php?url='.urlencode(site_url('/'));?>';
		</script>
		<?php
		wp_enqueue_script('jquery-cookie', get_template_directory_uri().'/js/jquery.cookie.js');
		wp_enqueue_script('jquery-controlpanel', get_template_directory_uri().'/js/controlpanel.js');
		wp_enqueue_media();
		wp_register_script('my-admin-js', get_template_directory_uri().'/js/my-admin.js', array('jquery'));
		wp_enqueue_script('my-admin-js');
	}
	?>
	<?php wp_head();?>
	<?php if(aheadzen_is_editing()){  }else{ ?>
	<script>jQuery("html").niceScroll({zindex:99999,cursorborder:"1px solid #424242"});</script>
	<?php }?>
	<?php if(aheadzen_is_editing()){?>	
	<script>
	jQuery(function() {
		var sidebar_id = '';
		var widget_id = '';
		dialog = jQuery( "#inline_widget_dialog" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
			"Add Section": addNewSections,
			Cancel: function() {
			dialog.dialog( "close" );
			}
			},
			close: function() {
				//alert('CLOSE');
			}
		});
		jQuery( ".widget_inline_add" ).click(function() {
			sidebar_id = jQuery(this).attr("sidebar");
			widget_id = jQuery(this).attr("widget");
			jQuery( "#inline_widget_dialog" ).dialog( "open" );
		});
		
		function addNewSections()
		{
			var selected_widget = jQuery( "#inline_widget_dialog ul li input:radio:checked" ).val();
			if(selected_widget)
			{
				var ajax_url = '<?php echo site_url(); ?>';					
				var data = {
					'action': 'save-widget-front',
					'add_widget': 1,
					'sidebar': sidebar_id,
					'widget-id': widget_id,
					'selected_widget': selected_widget
				};
				
				jQuery.post(ajax_url, data, function(response) {
					if(response){
						jQuery( ".inline_edit_success_msg" ).html( '<span>Updated Successfully</span>' );
						setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
						window.location.href='<?php echo site_url('?editing=1');?>';
					}else{
						jQuery( ".inline_edit_success_msg" ).html( '<span class="errormsg">Something wrong, try again...</span>' );
						setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
					}
				});			
				
			}else{
				alert('Please select atleaset one');
			}
		}
	});
	</script>
	<?php }?>

<style type="text/css" media="screen">
 
 <?php $body_font = get_option('aheadzen_body_font');
if($body_font){
 $body_font = explode(':dw:', $body_font );
?>
@font-face {
  font-family: "<?php echo $body_font[0]; ?>";
  src: url('<?php echo $body_font[1] ?>');
} 
* {
  font-family: "<?php echo $body_font[0]; ?>";
}
 <?php }?>  

 <?php $heading_font = get_option('aheadzen_heading_font');
if($heading_font){
 $heading_font = explode(':dw:', $heading_font );
?>
@font-face {
  font-family: "<?php echo $heading_font[0]; ?>";
  src: url('<?php echo $heading_font[1] ?>');
} 
h1,h2,h3,h4,h5,h6,blockquote p {
  font-family: "<?php echo $heading_font[0]; ?>";
}
 <?php }?>
 <?php
$logo_color = get_option('aheadzen_logo_color');
if($logo_color){echo '.logoarea .alogo .site-title{color:'.$logo_color.' !important;}';}


$headerbg_color = get_option('aheadzen_headerbg_color');
if($headerbg_color){echo '#header{background-color:'.$headerbg_color.' !important; background-image: -moz-linear-gradient(center top , '.$headerbg_color.', '.$headerbg_color.');}';}

$headerborder_color = get_option('aheadzen_headerborder_color');
if(headerborder_color){echo '#header{border-color:'.$headerborder_color.' !important;}';}

$buttonbg_color = get_option('aheadzen_buttonbg_color');
if(buttonbg_color){echo '.button_set a{background-color:'.$buttonbg_color.' !important; border-color:'.$buttonbg_color.' !important;}';}

$buttontext_color = get_option('aheadzen_buttontext_color');
if(buttontext_color){echo '.button_set a{color:'.$buttontext_color.' !important; text-shadow: 0 0 0;}';}

$heading_color = get_option('aheadzen_heading_color');
if($heading_color){echo 'h1,h2,h1 a, h2 a{color:'.$heading_color.' !important;}';}

$maintitle_color = get_option('aheadzen_maintitle_color');
if($maintitle_color){echo '.main-title h2{color:'.$maintitle_color.' !important;}';}

$mainbg_color = get_option('aheadzen_mainbg_color');
if($mainbg_color){echo '.main-title{background-color:'.$mainbg_color.' !important;}';}

$mainshadow_color = get_option('aheadzen_mainshadow_color');
if($mainshadow_color){echo '.main-title{box-shadow: 0 -7px 6px '.$mainshadow_color.' inset !important;}';}


$subheading_color = get_option('aheadzen_subheading_color');
if($subheading_color){echo 'h3, h4, h5, h6, h3 a, h4 a, h5 a, h6 a{color:'.$subheading_color.' !important;}';}

$link_color = get_option('aheadzen_link_color');
if($link_color){echo 'a{color:'.$link_color.';}';}

$menulink_color = get_option('aheadzen_menulink_color');
if($menulink_color){echo '#main-menu ul a{color:'.$menulink_color.';}';}


$footer_heading_color = get_option('aheadzen_footer_heading_color');
if($footer_heading_color){echo '.footer h2,.footer h3{color:'.$footer_heading_color.' !important;}';}
?>
</style>
 <?php echo get_option('aheadzen_header_code');?>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper">
    	<div class="inner-wrapper">
		
		
		<!-- Header div Starts here -->
    <header id="header">
    <div class="container">
		<?php if ( is_active_sidebar( 'logoarea' ) ) : ?>
            <?php dynamic_sidebar( 'logoarea' ); ?>
       <?php else:?>
       
	 <div id="logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="alogo">
		<?php
		$site_logo = get_option('site_logo');
		if($site_logo){
		?>
		<img id="site_logo_img" src="<?php echo $site_logo;?>" alt="" />
		<?php
		}else{
		?>
		<img id="site_logo_img" src="<?php echo get_stylesheet_directory_uri();?>/images/logo.png" alt="" />
		<?php }?>
		</a>
		<?php if(aheadzen_is_editing()){?>
		<div class="fee-hover-container">
		<button id="site_logo" class="fee-hover-edit imgbutton">Edit logo</button>
		</div>
		<?php }?>
		<?php if(is_home() || is_front_page()){?>
		<h1 id="site-title" style="display:none;"><?php echo get_bloginfo('name');?></h1>
		<h2 id="site-description" style="display:none;"><?php bloginfo( 'description' ); ?></h2>
		<?php }?>
    </div>
	
        <?php endif; ?>      
		
        <div id="menu-container">
            <nav id="main-menu">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu group' ) ); ?>
			<?php if(aheadzen_is_editing()){?>
			<div class="fee-hover-container">
			<a href="<?php echo admin_url();?>/nav-menus.php" target="_blank"><button class="fee-hover-edit">Edit menu</button></a>
			</div>
			<?php }?>
            </nav>			
        </div>                    
    </div>
    </header>