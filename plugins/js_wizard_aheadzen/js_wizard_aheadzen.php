<?php
session_start();
ob_start();
/**
 * Plugin Name: JS Wizard for Singup Aheadzen
 * Plugin URI: http://aheadzen.com
 * Text Domain: fli
 * Domain Path: /lang
 * Description: register form shortcode :: [aheadzen_registerform]
 * Author: r Krishana
 * Author URI: http://aheadzen.com
 * Version: 1.0.0
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
$plugin_dir_path = dirname(__FILE__);
$plugin_dir_url = plugins_url('', __FILE__);
add_action('init','signup_wizard_init');
function signup_wizard_init()
{
	//add_filter('show_admin_bar', '__return_false');

	// show admin bar only for admins
	if (!current_user_can('manage_options')) {
		add_filter('show_admin_bar', '__return_false');
	}
	// show admin bar only for admins and editors
	if (!current_user_can('edit_posts')) {
		add_filter('show_admin_bar', '__return_false');
	}
	
	if($_GET['editing'] && !current_user_can('manage_options'))
	{
		wp_redirect(site_url());exit;
	}
	
}

add_filter('template_include','aheadzen_jsregistration_template_include');
function aheadzen_jsregistration_template_include($template)
{
	if($_POST && $_POST['regact']=='reg_check_email_user')
	{
		$email = $_POST['val'];
		 if ( username_exists( $email ) )
           echo "username:inuse";
       else
           echo "username:notinuse";	   
		//$errors = new WP_Error();
		//$errors = register_new_user($email, $email);
		//print_r($errors);
		exit;
	}elseif($_POST && $_POST['regact']=='reg_check_sitename'){
		$sitename = $_POST['val'];
		$current_site = $sitename.'.'.$_SERVER['HTTP_HOST'];
		$sites = wp_get_sites(array('limit'=>10000)); 
		$domain_sites_array = array();
		if($sites)
		{
			for($s=0;$s<count($sites);$s++)
			{
				$domain_sites_array[] = $sites[$s]['domain'];
			}
			
			if(in_array($current_site,$domain_sites_array))
			{
				echo 'site:exists';exit;
			}else{
				echo 'site:notexists';exit;
			}
			
		}
		echo 'site:notexists';
		exit;
	}
	return apply_filters('wpw_add_template_page_filter',$template);
}

global $app_themes_aheadzen_themes;
$app_themes_aheadzen_themes = array(
				'App_Mojo_Apps'		=>	'Application Theme',
				'App_Mojo_Books'	=>	'Books Theme',
				'App_Mojo_Celebrity'=>	'Celebrity Theme',
				'App_Mojo_Jewelary'	=>	'Jewellery Theme',
				'App_Mojo_Wedding'	=>	'Wedding Theme',
				);

/************************************
//Define the custom box
***************************************/
// backwards compatible
add_action('admin_init', 'aheadzen_woo_product_add_custom_box', 1);

/* Do something with the data entered */
add_action('save_post', 'aheadzen_woo_product_save_postdata');

/* Adds a box to the main column on the Post and Page edit screens */
function aheadzen_woo_product_add_custom_box() {
    add_meta_box( 'woo_product_aheadzen_sectionid', __( 'JS Wizard Settings - Aheadzen','aheadzen'),'woo_product_inner_custom_box', 'product');
	do_action('aheadzen_slider_add_custom_box_post');
}

/* Prints the box content */
function woo_product_inner_custom_box() {
global $post,$app_themes_aheadzen_themes;
$mobile_app_theme = get_post_meta($post->ID,'mobile_app_theme',true);
?>
<table border="0" cellpadding="5" cellspacing="5" width="100%">
  <tr>
    <td width="20%"><?php _e("Select Theme",'aheadzen')?></td>
    <td>
	<select name="mobile_app_theme" id="mobile_app_theme">
	<option value=""><?php _e("-- Select One --",'aheadzen')?></option>
	<?php
	if($app_themes_aheadzen_themes)
	{
		foreach($app_themes_aheadzen_themes as $key =>$val)
		{
		?>
		<option value="<?php echo $key;?>" <?php if($mobile_app_theme==$key){echo 'selected="selected"';}?> ><?php echo $val;?></option>
		<?php
		}
	}
	?>	
	</select>
	  <br />
    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<?php
}


/* When the post is saved, saves our custom data */
function aheadzen_woo_product_save_postdata( $post_id ) {

  // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
  // to do anything
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;

  
  // Check permissions
  if ( 'product' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
      return $post_id;
	  
	   // OK, we're authenticated: we need to find and save the data
	  update_post_meta($post_id,'mobile_app_theme',$_POST['mobile_app_theme']);
  } 
   return $mydata;
}


if(!function_exists('wp_head_singup_wizard'))
{
	add_action('wp_head','wp_head_singup_wizard');
	function wp_head_singup_wizard()
	{
	?>
<script>
jQuery(function() {
	jQuery(".meter > span").each(function() {
		jQuery(this)
			.data("origWidth", jQuery(this).width())
			.width(0)
			.animate({
				width: jQuery(this).data("origWidth")
			}, 1200);
	});
	
	<?php if($_GET['msg']=='theme-select'){?>
	jQuery( "#wrapper" ).prepend( '<span class="inline_select_theme_msg"><div>Please select website type you want to create...</div></span>' );
	setTimeout(function(){jQuery( ".inline_select_theme_msg" ).empty()}, 5000);
	<?php
	}?>
});
</script>
	
<style>
.signup_selected_template,.signup_selected_template a{margin-top:5px; text-transform:upper; font-size:16px;color:orange; margin-bottom:10px; display:inline-block;}
.signup_selected_template a{text-decoration: underline;}
.inline_select_theme_msg div{padding: 0 10px!important;background-color: #f9edbe !important;border-color: #f0c36d!important; border-radius: 2px!important;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2)!important;color: #222!important;font-weight: bold!important;text-align: center!important;}

/*Singup Page CSS*/
#privacy,.mu_register p {display:none;}
.mu_register #setupform p {display:block;}
.errormsg{padding:10px; margin-bottom:20px; margin-top:10px; border:solid 1px red; color:red;}
ul.reg_site_process_indicator{width:100%; margin: 10px 0; text-align:center;display: inline-block;margin-left: 0;border: solid 1px #dfdcdc;}
ul.reg_site_process_indicator li{background-color: #fcf9f9;min-width: 20%; margin:0;display: inline-block;padding:8px 15px;cursor:pointer; border: solid 0px #dfdcdc;font-size: 12px;text-transform: uppercase;}
ul.reg_site_process_indicator li:hover,ul.reg_site_process_indicator li.current{background-color:#e6e3e3;}
.singup_continue_button{ display: inline-block; margin-top: 15px; margin-bottom: 15px;}
p#billing_state_field, p#shipping_state_field{clear:both;}

/*Singup Page Progressbar*/
.meter {height:20px; position: relative;margin:15px 0 20px;background:#f4f2f2;-moz-border-radius: 25px;-webkit-border-radius: 25px;border-radius: 25px;padding:8px;-webkit-box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);-moz-box-shadow   : inset 0 -1px 1px rgba(255,255,255,0.3);box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);}
.meter > span {display: block;height: 100%;
-webkit-border-top-right-radius: 8px;-webkit-border-bottom-right-radius: 8px;-moz-border-radius-topright: 8px;-moz-border-radius-bottomright: 8px;border-top-right-radius: 8px;border-bottom-right-radius: 8px;-webkit-border-top-left-radius: 20px;-webkit-border-bottom-left-radius: 20px;-moz-border-radius-topleft: 20px;-moz-border-radius-bottomleft: 20px;border-top-left-radius: 20px;
border-bottom-left-radius: 20px;background-color: rgb(43,194,83);
background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0, rgb(43,194,83)),color-stop(1, rgb(84,240,84)));
background-image: -moz-linear-gradient(center bottom,rgb(43,194,83) 37%,rgb(84,240,84) 69%);
-webkit-box-shadow: inset 0 2px 9px  rgba(255,255,255,0.3),inset 0 -2px 6px rgba(0,0,0,0.4);
-moz-box-shadow: inset 0 2px 9px  rgba(255,255,255,0.3),inset 0 -2px 6px rgba(0,0,0,0.4);
box-shadow: inset 0 2px 9px  rgba(255,255,255,0.3),inset 0 -2px 6px rgba(0,0,0,0.4);
position: relative;overflow: hidden;
}
.meter > span:after, .animate > span > span {
content: "";position: absolute;top: 0; left: 0; bottom: 0; right: 0;
background-image: 
-webkit-gradient(linear, 0 0, 100% 100%, 
color-stop(.25, rgba(255, 255, 255, .2)), 
color-stop(.25, transparent), color-stop(.5, transparent), 
color-stop(.5, rgba(255, 255, 255, .2)), 
color-stop(.75, rgba(255, 255, 255, .2)), 
color-stop(.75, transparent), to(transparent)
);
background-image:-moz-linear-gradient(-45deg, rgba(255, 255, 255, .2) 25%, 
transparent 25%, 
transparent 50%, 
rgba(255, 255, 255, .2) 50%, 
rgba(255, 255, 255, .2) 75%, 
transparent 75%, 
transparent
);
z-index: 1;
-webkit-background-size: 50px 50px;
-moz-background-size: 50px 50px;
-webkit-animation: move 2s linear infinite;
-webkit-border-top-right-radius: 8px;
-webkit-border-bottom-right-radius: 8px;
-moz-border-radius-topright: 8px;
-moz-border-radius-bottomright: 8px;
   border-top-right-radius: 8px;
border-bottom-right-radius: 8px;
-webkit-border-top-left-radius: 20px;
-webkit-border-bottom-left-radius: 20px;
-moz-border-radius-topleft: 20px;
-moz-border-radius-bottomleft: 20px;
	border-top-left-radius: 20px;
 border-bottom-left-radius: 20px;
overflow: hidden;
}

.animate > span:after {
display: none;
}

@-webkit-keyframes move {
0% {
background-position: 0 0;
}
100% {
background-position: 50px 50px;
}
}

.orange > span {
background-color: #f1a165;
background-image: -moz-linear-gradient(top, #f1a165, #f36d0a);
background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #f1a165),color-stop(1, #f36d0a));
background-image: -webkit-linear-gradient(#f1a165, #f36d0a); 
}

.red > span {
background-color: #f0a3a3;
background-image: -moz-linear-gradient(top, #f0a3a3, #f42323);
background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #f0a3a3),color-stop(1, #f42323));
background-image: -webkit-linear-gradient(#f0a3a3, #f42323);
}

.nostripes > span > span, .nostripes > span:after {
-webkit-animation: none;
background-image: none;
}
#registerform  .form-row  span .error{color:red;}
#registerform  .form-row  span .success{color:green;}

.mysite_view,.mysite_edit,.mysite_delete{padding:0px 7px; margin:0 5px; background-color:#e0dfdf;-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;display:none;}
ul.myaccount_sites_listing li:hover .mysite_view,ul.myaccount_sites_listing li:hover .mysite_edit,ul.myaccount_sites_listing li:hover .mysite_delete{display:inline-block;}
	</style>
	<?php
		$reg_frm_detail = aheadzen_get_registration_form_shortcode_page_detail();
		if($reg_frm_detail['pid']==get_the_id())
		{
			global $plugin_dir_url;
			
		}
		
		if($_GET['my_templateid'])
		{
			$mobile_app_theme = get_post_meta($_GET['my_templateid'],'mobile_app_theme',true);
			$_SESSION['selected_theme']=$mobile_app_theme;
			$_SESSION['my_templateid']=$_GET['my_templateid'];
		}
		if(!$_SESSION['my_templateid'])
		{
			global $wpdb;
			$_SESSION['selected_theme']='App_Mojo_Apps';
			$my_templateid = $wpdb->get_var("select post_id from $wpdb->postmeta where meta_key='mobile_app_theme' and meta_value='App_Mojo_Apps'");
			$_SESSION['my_templateid']=$my_templateid;
		}
	}
}

if(!function_exists('signup_finished_funcode_js'))
{
	add_action('signup_finished','signup_finished_funcode_js');
	function signup_finished_funcode_js()
	{	
	global $wpdb, $blogname, $blog_title, $errors, $domain, $path;
		$selected_theme=$_SESSION['selected_theme'];
		$slug = $selected_theme;
		if(!$slug)
		{
			$slug = 'App_Mojo_Apps';
		}
		$encoded_slug = urlencode( $slug );
		//$activeurl = str_replace('&amp;','&',(wp_nonce_url( 'http://'.$domain.$path. 'wp-admin/themes.php?action=activate&stylesheet='.$encoded_slug , 'switch-theme_' . $slug )));
		
		//$activeurl = 'http://'.$domain.$path.'/?themeactivated='.base64_encode($slug);
		$activeurl = 'http://'.$domain.$path.'/?themeactivated='.base64_encode($slug).'&template='.$_SESSION['my_templateid'];
		$_SESSION['THEME_ACTIVE_URL']=$activeurl;
		?>
		<h1>Your site Created successfully. <br><br>Please fill your contact details.</h1>
		<br>
		<?php
			$frm_detail = aheadzen_get_registration_form_shortcode_page_detail();
			//$contacts_url =  $frm_detail['url'].'/?ptyp=reg_fill_contacts';				
			if($_SESSION['THEME_ACTIVE_URL'])
			{
				//wp_redirect($_SESSION['THEME_ACTIVE_URL']);exit;
				$contacts_url=$_SESSION['THEME_ACTIVE_URL'];
			}
		?>
		<script>window.location.href="<?php echo $contacts_url;?>";</script>
	<?php		
	}
}

if(!function_exists('wpw_template_include'))
{
	add_filter('template_include','wpw_template_include');
	function wpw_template_include($template)
	{
		global $current_user;
		
		if($_POST['mysitedeleting'])
		{
			$mysitedeleting = $_POST['mysitedeleting'];
			include_once(ABSPATH.'wp-admin/includes/ms.php');
			wpmu_delete_blog( $mysitedeleting, true );
			wp_redirect(get_permalink( get_option('woocommerce_myaccount_page_id') ));exit;
		}else
		if($_POST['ptyp']=='reg_fill_success' && $_SESSION['THEME_ACTIVE_URL'])
		{
			$theme_activation_url = $_SESSION['THEME_ACTIVE_URL'];			
			wp_redirect($theme_activation_url);exit;
		}else
		if($current_user->ID && isset($_POST['registerform_contact'] ))
		{
			
			$uid = $current_user->ID;
			update_user_meta( $uid, 'first_name',$_POST['billing_first_name']);
			update_user_meta( $uid, 'last_name',$_POST['billing_last_name']);
			
			update_user_meta( $uid, 'billing_first_name',$_POST['billing_first_name']);
			update_user_meta( $uid, 'billing_last_name',$_POST['billing_last_name']);
			update_user_meta( $uid, 'billing_address_1',$_POST['billing_address_1']);
			update_user_meta( $uid, 'billing_address_2',$_POST['billing_address_2']);
			update_user_meta( $uid, 'billing_city',$_POST['billing_city']);
			update_user_meta( $uid, 'billing_country',$_POST['billing_country']);
			update_user_meta( $uid, 'billing_state',$_POST['billing_state']);
			update_user_meta( $uid, 'billing_postcode',$_POST['billing_postcode']);
			update_user_meta( $uid, 'billing_email',$_POST['billing_email']);
			update_user_meta( $uid, 'billing_phone',$_POST['billing_phone']);
			
			update_user_meta( $uid, 'facebook',$_POST['fb']);
			update_user_meta( $uid, 'google_plus',$_POST['gp']);
			update_user_meta( $uid, 'twitter',$_POST['twitter']);
			update_user_meta( $uid, 'linkedin',$_POST['linkedin']);
			update_user_meta( $uid, 'google_map',$_POST['gmap']);
			update_user_meta( $uid, 'youtube',$_POST['youtube']);
			update_user_meta( $uid, 'contact_email',$_POST['contact_email']);
			update_user_meta( $uid, 'website',$_POST['website']);
			
			//$frm_detail = aheadzen_get_registration_form_shortcode_page_detail();
			//$images_url =  $frm_detail['url'].'/?ptyp=reg_upload_images';
			//wp_redirect( $images_url );
			//exit;
			//$_SESSION['selected_theme']=$mobile_app_theme;
			//$_SESSION['my_templateid']=$_GET['my_templateid'];
			//include_once('place_order.php');
			
			if($_SESSION['THEME_ACTIVE_URL'])
			{
				wp_redirect($_SESSION['THEME_ACTIVE_URL']);exit;
			}
		}else
		if(isset($_GET['themeactivated']))
		{
			$selected_theme = base64_decode($_GET['themeactivated']);
			//$_SESSION['my_templateid']=$_GET['template'];
			$_SESSION['selected_theme']=$selected_theme;
			
			if($selected_theme)
			{
				global $wpdb,$current_user;
				//include_once('place_order.php');
				
				//$slug=trim($_SESSION['selected_theme']);
				$slug=trim($selected_theme);
				$blogprefix = $wpdb->get_blog_prefix(1);
				
				$user_role_var = $blogprefix.$current_user->ID.'_user_roles';
				$admin_role_cap = $wpdb->get_var("select option_value from ".$blogprefix."options where option_name='wp_user_roles'");
				update_option($user_role_var,$admin_role_cap);
				global $wpdb,$table_prefix;
				$capalitity_arr = array();
				$capalitity_arr = array('administrator'=>1);
				update_usermeta($current_user->ID, $table_prefix.'capabilities',$capalitity_arr);
				update_usermeta($current_user->ID,$table_prefix.'user_level','10');
				wp_set_auth_cookie( $current_user->ID, false, is_ssl() );
				wp_set_current_user( $current_user->ID );
				//if($slug && current_user_can( 'switch_themes' ) )
				if($slug)
				{
					//check_admin_referer('switch-theme_' . $slug);
					$theme = wp_get_theme( $slug );
					if ( ! $theme->exists() || ! $theme->is_allowed() )
						wp_die( __( 'Cheatin&#8217; uh?' ) );					
					switch_theme( $theme->get_stylesheet() );
					//unset($_SESSION['selected_theme']);
					unset($_SESSION['THEME_ACTIVE_URL']);
					wp_redirect( site_url('?themeactived=true&import_sample=data1') );
					exit;
				}
			}			
		}else
		if($_POST['registernewuser'])
		{
			global $current_user,$wpdb;
			$_SESSION['emsg_array']=array();
			$user_login = '';
			$user_email = '';
			if ( !get_option('users_can_register') ) {
				$frm_detail = aheadzen_get_registration_form_shortcode_page_detail();
				$contacts_url =  $frm_detail['url'].'/';
				wp_redirect($contacts_url.'?emsg=regnewusr');
				exit();
			}
			
			if ( $_POST ) {
				$user_login = $_POST['user_email'];
				$user_email = $_POST['user_email'];
				$password = $_POST['password'];
				$sitename = $_POST['sitename'];
				
				$repeat_password = $_POST['repeat_password'];
				
				$errors = new WP_Error();
				
				$errors = register_new_user($user_login, $user_email);
				
				if ( $_POST['password'] !== $_POST['repeat_password'] ) {
					$emsg_array = $_SESSION['emsg_array'];
					$emsg_array[] = "<strong>ERROR</strong>: Passwords must match";
					$_SESSION['emsg_array']=$emsg_array;
					//$errors->add( 'passwords_not_matched', "<strong>ERROR</strong>: Passwords must match" );
				}
				
				if ( strlen( $_POST['password'] ) < 6 ) {
					$emsg_array = $_SESSION['emsg_array'];
					$emsg_array[] = "<strong>ERROR</strong>: Passwords must be at least eight characters long";
					$_SESSION['emsg_array']=$emsg_array;
					//$errors->add( 'password_too_short', "<strong>ERROR</strong>: Passwords must be at least eight characters long" );
				}

				if ( !is_wp_error($errors) ) 
				{
					$_POST['log'] = $user_login;
					$_POST['pwd'] = $password;
					$_POST['testcookie'] = 1;
					
					$secure_cookie = '';
					// If the user wants ssl but the session is not ssl, force a secure cookie.
					if ( !empty($_POST['log']) && !force_ssl_admin() )
					{
						$user_name = sanitize_user($_POST['log']);
						if ( $user = get_userdatabylogin($user_name) )
						{
								/*global $wpdb,$table_prefix;
								
								$capalitity_arr = array();
								$capalitity_arr = array('administrator'=>1);
								update_usermeta($user->ID, $table_prefix.$user->ID.'_capabilities',$capalitity_arr);
								update_usermeta($user->ID,$table_prefix.$user->ID.'_user_level','10');
								*/
								
								wp_set_auth_cookie( $user->ID, false, is_ssl() );
								//wp_redirect($_REQUEST['redirect_to'] );exit;
								
								if ( is_user_logged_in() )
								{
									$user = wp_get_current_user();
								}
								
								global $wpdb, $blogname, $blog_title, $errors, $domain, $path;
								
								$result = wpmu_validate_blog_signup($_POST['sitename'], $_POST['sitename'], $user);
								extract($result);
								
								if ( $errors->get_error_code() ) {
									//signup_another_blog($blogname, $blog_title, $errors);
									if ( $errors->get_error_code() ) {
										$emsg_array = $_SESSION['emsg_array'];
										$emsg_array[] = "<strong>ERROR</strong>: 'There was a problem, please correct the form below and try again.'";
										$_SESSION['emsg_array']=$emsg_array;
									}
								}
								
								$public = (int) $_POST['blog_public'];
								
								$blog_meta_defaults = array(
									'lang_id' => 1,
									'public'  => $public
								);
								$meta = apply_filters( 'signup_create_blog_meta', $blog_meta_defaults );
								$meta = apply_filters( 'add_signup_meta', $meta );
								
								wpmu_create_blog( $domain, $path, $blog_title, $current_user->ID, $meta, $wpdb->siteid );
								
								$selected_theme=$_SESSION['selected_theme'];
								$slug = $selected_theme;
								if(!$slug)
								{
									$slug = 'App_Mojo_Apps';
								}
								$activeurl = 'http://'.$domain.$path.'/?themeactivated='.base64_encode($slug);
								
								global $wpdb,$current_user;
								$current_user = $user;
								include_once('place_order.php');
			
								if($activeurl){
									wp_redirect($activeurl);exit;
								}
						}
					}
				}
			}
		}
		$_SESSION['emsg_array']=$errors;
		return apply_filters('wpw_add_template_page_filter',$template);
	}
}
/****************************
//WordPress register  Form Short Code
[aheadzen_registerform]
*****************************/
if(!function_exists('aheadzen_register_form_shortcode'))
{
	function aheadzen_register_form_shortcode( $atts, $content = null ) {
	 
		extract( shortcode_atts( array(
		  'redirect' => site_url().'/wp-signup.php'
		  ), $atts ) );
		  
		$redirect_to = site_url().'/wp-signup.php';
		global $current_user;
		ob_start();
		if(!$_GET['mysitedeleting'])
		{
			aheadzen_register_site_process_indicator();
		}
		if($_GET['mysitedeleting'])
		{
			aheadzen_mysitedeleting_fun($_GET['mysitedeleting']);
		}else
		if($_GET['ptyp']=='reg_upload_images')
		{
			aheadzen_register_form_upload_images();
		}else
		if($_GET['ptyp']=='reg_fill_contacts')
		{
			aheadzen_register_form_contact_details();
		}else{
		
		if (!is_user_logged_in()) {
			
			if($_SESSION['emsg_array'])
			{
				$emsg_array = $_SESSION['emsg_array'];
				if(isset($emsg_array->errors))
				{
					foreach($emsg_array->errors as $key => $val)
					{
						$emsg_array1[] = $val[0];
					}
				}else{
					$emsg_array1 = $emsg_array;
				}
				echo '<div class="box error-box">'.implode('<br>',$emsg_array1).'</div>';
				$_SESSION['emsg_array'] = array();
			}
			if($_GET['emsg']=='regnewusr')
			{
				echo '<div class="box error-box">New user registration for your site is disabled, please contact your site administrator.</div>';
			}
			$sitename = $_GET['sitename'];
			?>
			<style>
			.form-row span{display:inline-block; width:90%; clear:both;}
			</style>
			<form name="registerform" id="registerform" action="" method="post">
			<input type="hidden" name="registernewuser" value="1" />
			<p class="form-row form-row-first">
			<label for="user_email"><?php _e('E-mail') ?><br />
			<input type="text" name="user_email" id="user_email" class="input-text" value="<?php echo esc_attr(wp_unslash($user_email)); ?>" size="25" />
			<span></span>
			</label>			
			</p>
			
			<?php /*?>
			<p class="form-row form-row-first">
			<label for="user_login"><?php _e('Username') ?><br />
			<input type="text" name="user_login" id="user_login" class="input-text" value="<?php echo esc_attr(wp_unslash($user_login)); ?>" /></label>
			</p>	
			<?php */?>
			<p class="form-row form-row-last">
			<label for="sitename"><?php _e('Sitename') ?><br />
			<input style="width: 50%;" type="text" name="sitename" id="sitename" class="input-text" value="<?php echo esc_attr(wp_unslash($sitename)); ?>" size="25" />
			.<?php echo $_SERVER['HTTP_HOST'];?>
			<span></span>
			</label>
			</p>
			
			<p class="form-row form-row-first">
			<label for="password">Password<br/>
			<input id="password" class="input-text" type="password" size="25" value="" name="password" />
			<span></span>
			</label>
			</p>	
			<p class="form-row form-row-last">
			<label for="repeat_password">Repeat password<br/>
			<input id="repeat_password" class="input-text" type="password" size="25" value="" name="repeat_password" />
			<span></span>
			</label>
			</p>
			
			<?php
			/**
			 * Fires following the 'E-mail' field in the user registration form.
			 *
			 * @since 2.1.0
			 */
			do_action( 'register_form' );
			?>
			<br class="clear" />
			<?php /*?><input type="hidden"  name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" /> <?php */?>
			<p class="cart" style="text-align:right;"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Register & Create Site'); ?>" />
			<span></span>
			</p>
			</form>
			<script>			
			jQuery(function(){
				var is_valid_email = 0;
				var is_valid_pw = 0;
				var is_valid_sitename = 0;
				regfrm_submit_button_hide();
				jQuery("#registerform #user_email").focus(function(){
					jQuery(this).next('span').html('');
					regfrm_submit_button_hide();
				});
				<?php if($_GET['sitename']){?>
				var varthisvar = jQuery("#registerform #sitename");
				val = jQuery.trim(varthisvar.val());
				if(val=='')
				{
					varthisvar.next('span').html('<font class="error">Please enter Sitename.</font>');
				}else
				if(val.length<5)
				{
					varthisvar.next('span').html('<font class="error">Site name should be atleast 5 letters long.</font>');
				}else
				if (/^[a-zA-Z0-9-]*$/.test(val) == false)
				{
					varthisvar.next('span').html('<font class="error">Site name should contain only a-z and 0-9 without any space.</font>');
				}else{
					varthisvar.next('span').html('processing, please wait...');	
					var ajax_url = '<?php echo get_permalink(); ?>';
					var data = {
						'regact': 'reg_check_sitename',
						'val': val
					};
					jQuery.post(ajax_url, data, function(response) {
						if(response=='site:notexists')
						{
							varthisvar.next('span').html('<font class="success">site name is available, please continue...</font>');
							is_valid_sitename = 1;
						}else{
							varthisvar.next('span').html('<font class="error">the site name already exists, please try another one.</font>');
						}
					});						
				}
				<?php }?>
				jQuery("#registerform #user_email").blur(function(){
					var varthisvar = jQuery(this);
					val = varthisvar.val();
					if(validateEmail(val))
					{
						varthisvar.next('span').html('processing, please wait...');	
						var ajax_url = '<?php echo get_permalink(); ?>';
						var data = {
							'regact': 'reg_check_email_user',
							'val': val
						};
						jQuery.post(ajax_url, data, function(response) {
							if(response=='username:notinuse')
							{
								varthisvar.next('span').html('<font class="success">you can use the E-mail.</font>');
								is_valid_email = 1;
								if(is_valid_sitename==1){ }else{
									is_valid_sitename = regfrm_submit_site_check();
								}
								regfrm_check_button(is_valid_email,is_valid_pw,is_valid_sitename);								
							}else{
								varthisvar.next('span').html('<font class="error">you cannot use the E-mail, please try another one.</font>');
							}
						});
					}else{
						varthisvar.next('span').html('<font class="error">Invalid E-mail: '+val+'</font>');
					}					
				});
				
				jQuery("#registerform #sitename").focus(function(){
					jQuery(this).next('span').html('');
					regfrm_submit_button_hide();
				});
				
				jQuery("#registerform #sitename").blur(function(){
					var varthisvar = jQuery("#registerform #sitename");
					val = jQuery.trim(varthisvar.val());
					if(val=='')
					{
						varthisvar.next('span').html('<font class="error">Please enter Sitename.</font>');
					}else
					if(val.length<5)
					{
						varthisvar.next('span').html('<font class="error">Site name should be atleast 5 letters long.</font>');
					}else
					if (/^[a-zA-Z0-9-]*$/.test(val) == false)
					{
						varthisvar.next('span').html('<font class="error">Site name should contain only a-z and 0-9 without any space.</font>');
					}else{
						varthisvar.next('span').html('processing, please wait...');	
						var ajax_url = '<?php echo get_permalink(); ?>';
						var data = {
							'regact': 'reg_check_sitename',
							'val': val
						};
						jQuery.post(ajax_url, data, function(response) {
							if(response=='site:notexists')
							{
								varthisvar.next('span').html('<font class="success">site name is available, please continue...</font>');
								is_valid_sitename = 1;
							}else{
								varthisvar.next('span').html('<font class="error">the site name already exists, please try another one.</font>');
							}
						});						
					}
					regfrm_check_button(is_valid_email,is_valid_pw,is_valid_sitename);							
				});
				
				
				jQuery("#registerform #password").focus(function(){
					jQuery(this).next('span').html('');
				});
				
				jQuery("#registerform #password").blur(function(){
					var varthisvar = jQuery(this);
					val = jQuery.trim(varthisvar.val());
					if(val=='')
					{
						varthisvar.next('span').html('<font class="error">Please enter Password.</font>');
					}else
					if(val.length<6)
					{
						varthisvar.next('span').html('<font class="error">Password should be atleast 6 letters long.</font>');
					}else{
						is_valid_pw = regfrm_check_password();
						regfrm_check_button(is_valid_email,is_valid_pw,is_valid_sitename);
					}
				});
				
				
				jQuery("#registerform #repeat_password").focus(function(){
					jQuery(this).next('span').html('');
					regfrm_submit_button_hide();
				});
				
				jQuery("#registerform #repeat_password").blur(function(){
					var varthisvar = jQuery(this);
					val = jQuery.trim(varthisvar.val());
					if(val=='')
					{
						varthisvar.next('span').html('<font class="error">Repeat Please enter Password.</font>');
					}else
					if(val.length<6)
					{
						varthisvar.next('span').html('<font class="error">Repeat password should be atleast 6 letters long.</font>');
					}else{
						is_valid_pw = regfrm_check_password();
						regfrm_check_button(is_valid_email,is_valid_pw,is_valid_sitename);
					}
				});
				
			});
			
			function regfrm_submit_site_check()
			{
				var varthisvar = jQuery("#registerform #sitename");
				val = jQuery.trim(varthisvar.val());
				if(val=='')
				{
					varthisvar.next('span').html('<font class="error">Please enter Sitename.</font>');
					return 0;
				}else
				if(val.length<5)
				{
					varthisvar.next('span').html('<font class="error">Site name should be atleast 5 letters long.</font>');
					return 0;
				}else{
					varthisvar.next('span').html('processing, please wait...');	
					var ajax_url = '<?php echo get_permalink(); ?>';
					var data = {
						'regact': 'reg_check_sitename',
						'val': val
					};
					jQuery.post(ajax_url, data, function(response) {
						if(response=='site:notexists')
						{
							varthisvar.next('span').html('<font class="success">site name is available, please continue...</font>');
							return 1;
						}else{
							varthisvar.next('span').html('<font class="error">the site name already exists, please try another one.</font>');
							return 0;
						}
					});						
				}
			}
			function regfrm_submit_button_hide()
			{
				jQuery("#registerform #wp-submit").hide();
				jQuery("#registerform #wp-submit").next('span').html('<a title="arrow" href="javascript:void(0);" class="more-button more-button-ltr">Click to Continue<span class="icon tick">&nbsp;</span></a>');
			}
			function regfrm_check_button(is_valid_email,is_valid_pw,is_valid_sitename)
			{
				if(is_valid_email==1 && is_valid_pw==1 && is_valid_sitename==1)
				{
					jQuery("#registerform #wp-submit").next('span').html('');
					jQuery("#registerform #wp-submit").show();
				}
			}
			function regfrm_check_password()
			{
				var password = jQuery("#registerform #password").val();
				var repeat_password = jQuery("#registerform #repeat_password").val();
				if(password.length>=6 && repeat_password.length>=6 && password!=repeat_password)
				{
					jQuery("#registerform #repeat_password").next('span').html('<font class="error">Password and Repeat password should be same.</font>');
				}else
				if(password.length>=6 && repeat_password.length>=6 && password==repeat_password)
				{
					jQuery("#registerform #repeat_password").next('span').html('<font class="success">Good password, please continue...</font>');
					return 1;
				}
				return 0;
			}
			// Function that validates email address through a regular expression.
			function validateEmail(sEmail) {
				var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
				if (filter.test(sEmail)) {
					return true;
				}
				else {
					return false;
				}
			}
			</script>
			<?php		
		}else{?>		
		<h2>You are already loged in.</h2>
		<h3>
		Please click the link to create new site >>  <a href="<?php echo site_url('wp-signup.php'); ?>"><?php _e('Create New Site','woothemes'); ?></a>
		</h3>

		<h3>
		Please logout by click >>  
		<a href="<?php echo wp_logout_url(); ?>"><?php _e('Logout','woothemes'); ?></a>
		</h3>		
			<?php
		}
		}
		$form = ob_get_contents();
		ob_end_clean();		
		return $form;
	}
	add_shortcode('aheadzen_registerform', 'aheadzen_register_form_shortcode');
}

add_action('before_signup_form','aheadzen_register_site_process_indicator');
function aheadzen_register_site_process_indicator()
{
	$progress_bar = 25;
	if(strstr($_SERVER['REQUEST_URI'],'/wp-signup.php'))
	{
		if($_SESSION['selected_theme'] && $_SESSION['my_templateid'])
		{
			$current_user = wp_get_current_user();
			if($current_user->ID){
				//continue
			}else{
				$page = aheadzen_get_registration_form_shortcode_page_detail();
				wp_redirect($page['url']);exit;
			}
			
		}else{
			$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ).'/?msg=theme-select';
			wp_redirect($shop_page_url);exit;
		}		
		$current2 = 'current';
		$progress_bar = 50;
	}elseif($_GET['ptyp']=='reg_fill_contacts'){
		$current3 = 'current';
		$progress_bar = 75;
	}elseif($_GET['ptyp']=='reg_upload_images'){
		$current4 = 'current';
		$progress_bar = 100;
	}elseif($_GET['ptyp']=='reg_fill_success'){
		$current5 = 'current';
		$progress_bar = 100;
	}else{
		$current1 = 'current';
	}
	?>
	<div class="group container">
	<ul class="reg_site_process_indicator">
		<?php
		if (is_user_logged_in()) {
		?>
		<li class="login_reg <?php echo $current1?>">Already Loged in</li>
		<?php
		}else{
		?>
		<li class="login_reg <?php echo $current1?>">Login/Registration</li>
		<?php
		}
		?>		
		<li class="site_edit_creation <?php echo $current2?>">Site Edit or Creation</li>
		<li class="fill_contact_details <?php echo $current3?>">Fill Contact Details</li>
		<!-- <li class="upload_images <?php echo $current4?>">Upload All images</li> -->
		<li class="site_success <?php echo $current5?>">Site Created successfully</li>
	</ul>
	<div class="meter">
		<span style="width:<?php echo $progress_bar;?>%"></span>
	</div>
	<?php 
	if($_SESSION['my_templateid']){
	$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ).'/?msg=theme-select';
	?>
	<div class="box info-box">You have selected "<b><?php echo get_the_title($_SESSION['my_templateid']);?></b>" to create your site. Please <a href="<?php echo $shop_page_url;?>">select new template site</a> if you want to change.</div>
	<?php }?>
	<?php
}

add_action('after_signup_form','aheadzen_after_signup_form_fun');
function aheadzen_after_signup_form_fun()
{
	echo '</div>';
}
 
function aheadzen_register_form_contact_details()
{
	global $current_user;
	$uid = $current_user->ID;
	$fb = get_user_meta( $uid, 'facebook',true);
	$gp = get_user_meta( $uid, 'google_plus',true);
	$twitter = get_user_meta( $uid, 'twitter',true);
	$linkedin = get_user_meta( $uid, 'linkedin',true);
	$gmap = get_user_meta( $uid, 'google_map',true);
	$youtube = get_user_meta( $uid, 'youtube',true);
	$website = get_user_meta( $uid, 'website',true);
	?>	
	
	<form name="registerform_contact" id="registerform_contact" action="" method="post">
	<input type="hidden" name="registerform_contact" value="1" />
	<?php 
	global $woocommerce; $checkout = $woocommerce->checkout();
	
	unset($checkout->checkout_fields['billing']['billing_company']);
	unset($checkout->checkout_fields['billing']['billing_vat']);
	
	foreach ($checkout->checkout_fields['billing'] as $key => $field) : ?>
	<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
	<?php endforeach; ?>
	
		
	<p class="form-row form-row-first">
	<label for="website"><?php _e('Website URL') ?><br />
	<input type="text" name="website" id="website" class="input-text" value="<?php echo ($website); ?>" /></label>
	</p>
	
	<p class="form-row form-row-last">
	<label for="fb"><?php _e('Facebook URL') ?><br />
	<input type="text" name="fb" id="fb" class="input-text" value="<?php echo ($fb); ?>" /></label>
	</p>	
	
	<p class="form-row form-row-first">
	<label for="gp"><?php _e('Google Plus URL') ?><br />
	<input type="text" name="gp" id="gp" class="input-text" value="<?php echo ($gp); ?>" /></label>
	</p>	
	<p class="form-row form-row-last">
	<label for="twitter"><?php _e('Twitter URL') ?><br />
	<input type="text" name="twitter" id="twitter" class="input-text" value="<?php echo ($twitter); ?>" /></label>
	</p>
	
	<p class="form-row form-row-first">
	<label for="linkedin"><?php _e('Linkedin URL') ?><br />
	<input type="text" name="linkedin" id="linkedin" class="input-text" value="<?php echo ($linkedin); ?>" /></label>
	</p>	
	<p class="form-row form-row-last">
	<label for="gmap"><?php _e('Google Map URL') ?><br />
	<input type="text" name="gmap" id="gmap" class="input-text" value="<?php echo ($gmap); ?>" /></label>
	</p>
	
	<p class="form-row form-row-first">
	<label for="youtube"><?php _e('Youtube/Vimeo Link') ?><br />
	<input type="text" name="youtube" id="youtube" class="input-text" value="<?php echo ($youtube); ?>" /></label>
	</p>	
	
		<?php
		/**
		 * Fires following the 'E-mail' field in the user registration form.
		 *
		 * @since 2.1.0
		 */
		do_action( 'register_form' );
		?>
		<br class="clear" />
		<p class="submit" style="float:right;"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php esc_attr_e('Save & Continue'); ?>" /></p>
	</form>
	<?php	
}

function aheadzen_register_form_upload_images()
{
?>
<p><br/></p>
<a href="#" class="image_upload_button"><h4>PLEASE UPLOAD ALL YOUR IMAGES</h4></a>
<p><br/><br/></p>
<form action="" method="post">
<input type="hidden" name="ptyp" value="reg_fill_success" />
<input type="submit" name="save_continue" value="Save & Continue" />
</form>
<?php
}

function aheadzen_get_registration_form_shortcode_page_detail()
{
	global $wpdb;
	$pid = $wpdb->get_var("select ID from $wpdb->posts where post_content like \"%[aheadzen_registerform]%\" and post_status='publish' and post_type='page' limit 1");
	$return = array();
	$return['pid']=$pid;
	$return['url']=get_permalink($pid);
	return $return;
}

add_filter('woocommerce_short_description','woocommerce_short_description_fun');
function woocommerce_short_description_fun($description)
{
	
	$pid = get_the_id();
	$mobile_app_theme = get_post_meta($pid,'mobile_app_theme',true);
	$signup_data = aheadzen_get_registration_form_shortcode_page_detail();
	//$link_url =  $signup_data['url'].'?my_templateid='.$pid;
	if($mobile_app_theme){
		$description .= '
		<form id="prd_detail_newsite" action="'.$signup_data['url'].'" method="get" name="prd_detail_newsite">
		<input type="hidden" name="my_templateid" value="'.$pid.'" />
		<input placeholder="your site name" type="text" class="sitename" name="sitename" value="" style="width:150px;" /> <b>.'.$_SERVER['HTTP_HOST'].'</b>		<a onclick="document.prd_detail_newsite.submit();" href="javascript:void(0);" class="more-button more-button-ltr">Create New Site<span style="background-image:url(\'http://icons.iconseeker.com/png/32/reixi-set-mac/home-85.png\')" class="icon ">&nbsp;</span></a>
		<br /></form>';
	}	
	return $description;
}


function mobile_app_importer_blog($source_blog_id)
{
/**
 * Sample code
 *
 * This code will copy all posts, pages and menus in the source blog. It also updates
 * the dates of the posts and pages
 **/
	include_once( WP_CONTENT_DIR . '/plugins/blogtemplates/nbt-api.php' );
	global $current_user;
	$userid = $current_user->ID;
	$blog_id = get_current_blog_id();
	include_once(ABSPATH.'wp-admin/includes/file.php');
	$args = array(
			'to_copy' => array(
				'settings' 	=> true,
				'posts'		=> true,
				'pages'		=> true,
				'menus'		=> true,
				'terms'		=> true,
				'users'		=> true,
				'files'		=> true
			),
			'pages_ids'		=> array( 'all-pages' ),
			'post_category' => array( 'all-categories' ),
			'template_id'	=> 1,
			//'additional_tables' => array('az_'.$source_blog_id.'_'.$source_blog_id.'_revslider_css','az_'.$source_blog_id.'_'.$source_blog_id.'_revslider_settings','az_'.$source_blog_id.'_'.$source_blog_id.'_revslider_sliders','az_'.$source_blog_id.'_'.$source_blog_id.'_revslider_slides'),
			//'additional_tables' => array('wp_'.$source_blog_id.'_'.$source_blog_id.'_revslider_css','wp_'.$source_blog_id.'_'.$source_blog_id.'_revslider_settings','wp_'.$source_blog_id.'_'.$source_blog_id.'_revslider_sliders','wp_'.$source_blog_id.'_'.$source_blog_id.'_revslider_slides'),
            'block_posts_pages' => false,
            'update_dates' => false
		);
	
	
	nbt_api_copy_contents_to_new_blog( $source_blog_id, $blog_id, $userid, $args );
	session_destroy();
	echo '<script>window.location.href="'.site_url().'";</script>';
	exit;
}

function aheadzen_mysitedeleting_fun($mysitedeleting)
{
	$frm_detail = aheadzen_get_registration_form_shortcode_page_detail();
	$blog_details = get_blog_details($mysitedeleting);
	?>
	<h2>Delete Site</h2>
	<h5>You want to delete the site <a href="<?php echo $blog_details->siteurl;?>" target="_blank"><?php echo $blog_details->siteurl;?></a>.</h5>
	<h6>Once the site deleted, all data will be removed and you never get it back any more.</h6>
	<h6>Please confirm before delete the site.</h6>
	<form name="delete_site_frm" id="delete_site_frm" action="<?php echo $frm_detail['url'];?>" method="post">
	<input type="hidden" name="mysitedeleting" value="<?php echo $mysitedeleting;?>" />
	<a title="remove" onclick="document.delete_site_frm.submit();" href="javascript:void(0);" class="more-button more-button-ltr"> Yes, Delete Site <span class="icon remove">&nbsp;</span></a>
	</form>
	<?php
}

add_action('woocommerce_after_my_account','woocommerce_after_my_account_fun_aheadzen');
function woocommerce_after_my_account_fun_aheadzen()
{
?>
<br /><br />
<h2>Change Password</h2>
<h5>Please <a href="<?php echo wc_customer_edit_account_url();?>" style="text-decoration:underline;">click the link</a> to change the password</h5>
<br /><br />
<?php
}

add_action('woocommerce_before_my_account','woocommerce_before_my_account_fun_aheadzen');
function woocommerce_before_my_account_fun_aheadzen()
{
	global  $current_user;
	
	?>
	<h2>My Sites <a style="float:right;margin-top: 0;" title="arrow" href="<?php echo $shop_page_url;?>" class="more-button more-button-ltr">Create New Site <span class="icon arrow">&nbsp;</span></a></h2>
	<?php
	$blogs = get_blogs_of_user($current_user->ID);
	if ( !empty($blogs) ) { ?>

			<p><?php _e( 'Sites you are already a member of:' ) ?></p>
			<ul class="myaccount_sites_listing short arrow">
				<?php foreach ( $blogs as $blog ) {
				//wpmu_delete_blog( $blog_id, true );
				//get_permalink( get_option('woocommerce_myaccount_page_id') )
					if($blog->userblog_id==1){ }else{
					$frm_detail = aheadzen_get_registration_form_shortcode_page_detail();
					$home_url = get_home_url( $blog->userblog_id );
						echo '<li><a href="' . esc_url( $home_url ) . '">' . $home_url . '</a>
						<a class="mysite_view" target="_blank" href="' . esc_url( $home_url ) . '">view</a>
						<a class="mysite_edit" target="_blank" href="' . esc_url( $home_url ) . '/?editing=1">edit</a>
						<a class="mysite_delete" href="' . $frm_detail['url'] . '?mysitedeleting='.$blog->userblog_id.'">delete</a>
						</li>';
					}
				} ?>
			</ul>
			<?php
			$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
			?>
			<div style="padding:15px;"></div>
	<?php }
}