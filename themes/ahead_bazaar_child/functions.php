<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

function format_template($content) {
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
return $content;
}
remove_action( 'admin_notices', 'woothemes_updater_notice' );


//add_action( 'wp_print_scripts', 'de_script', 100 );
//add_action( 'wp_loaded', 'de_script', 100 );
//add_action( 'wp_head', 'de_script', 100 );
function de_script() {
	
	if($_REQUEST['test'])
	{
		print_r(wp_print_styles());
		echo '<br><br>';
		print_r(wp_print_scripts());
		
		$print_scripts = wp_print_styles();
		if($print_scripts)
		{
			
			for($i=0;$i<count($print_scripts);$i++)
			{
				echo "<br><br> wp_dequeue_styles( '" . $print_scripts[$i]."' );<br>wp_deregister_styles( '".$print_scripts[$i]."' );<br> ";	
			}
		}
	}
	
	if(is_home() || is_front_page() || is_single())
	{
		wp_dequeue_script( 'jquery-core' );//
		wp_deregister_script( 'jquery-core' ); //

		wp_dequeue_script( 'jquery-migrate' );//
		wp_deregister_script( 'jquery-migrate' );//
		
		wp_dequeue_script( 'jquery' );//
		wp_deregister_script( 'jquery' );//
		wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', false, '2.1.0');
		
		wp_dequeue_script( 'Advancedlazyload' );//
		wp_deregister_script( 'Advancedlazyload' );//
		
		
		wp_dequeue_script( 'bp-legacy-js' );
		wp_deregister_script( 'bp-legacy-js' );
		
		wp_dequeue_script( 'bp-confirm' );
		wp_deregister_script( 'bp-confirm' );
		
		//wp_dequeue_script( 'themepunchtools' );//
		//wp_deregister_script( 'themepunchtools' );//
		
		//wp_dequeue_script( 'revolution-slider-jquery.themepunch.revolution.min' );//
		//wp_deregister_script( 'revolution-slider-jquery.themepunch.revolution.min' );//
		
		wp_dequeue_script( 'thickbox' );
		wp_deregister_script( 'thickbox' );
		
		//wp_dequeue_script( 'underscore' );//
		//wp_deregister_script( 'underscore' );//
		
		//wp_dequeue_script( 'shortcode' );//
		//wp_deregister_script( 'shortcode' );//
		
		wp_dequeue_script( 'media-upload' );
		wp_deregister_script( 'media-upload' );
		
		wp_dequeue_script( 'admin-bar' );
		wp_deregister_script( 'admin-bar' );
		
		//wp_dequeue_script( 'jquery-colorbox-easing-flexslider-imagesloaded-tiptip' );//
		//wp_deregister_script( 'jquery-colorbox-easing-flexslider-imagesloaded-tiptip' );//
		
		wp_dequeue_script( 'yit-layout' );
		wp_deregister_script( 'yit-layout' );
		
		wp_dequeue_script( 'jquery-custom' );
		wp_deregister_script( 'jquery-custom' );
		
		wp_dequeue_script( 'comment-reply' );
		wp_deregister_script( 'comment-reply' );
		
		wp_dequeue_script( 'bbpress-editor' );
		wp_deregister_script( 'bbpress-editor' );
		
		wp_dequeue_script( 'jquery-edittable-script' );
		wp_deregister_script( 'jquery-edittable-script' );
		
		wp_dequeue_script( 'jquery-bpopup-script' );
		wp_deregister_script( 'jquery-bpopup-script' );
		
		wp_dequeue_script( 'swatches-and-photos' );
		wp_deregister_script( 'swatches-and-photos' );
		
		wp_dequeue_script( 'jquery-blockui' );
		wp_deregister_script( 'jquery-blockui' );
		
		//wp_dequeue_script( 'woocommerce' );//
		//wp_deregister_script( 'woocommerce' );//
		
		//wp_dequeue_script( 'jquery-cookie' );//
		//wp_deregister_script( 'jquery-cookie' );//
		
		wp_dequeue_script( 'wc-cart-fragments' );
		wp_deregister_script( 'wc-cart-fragments' );
		
		wp_dequeue_script( 'yith-woocompare-main' );
		wp_deregister_script( 'yith-woocompare-main' );
		
		wp_dequeue_script( 'jquery-colorbox' );
		wp_deregister_script( 'jquery-colorbox' );
		
		wp_dequeue_script( 'responsive-theme' );
		wp_deregister_script( 'responsive-theme' );
		
		wp_dequeue_script( 'jquery-yith-wcwl' );
		wp_deregister_script( 'jquery-yith-wcwl' );
		
		wp_dequeue_script( 'shortcode_twitter' );
		wp_deregister_script( 'shortcode_twitter' );
		
		wp_dequeue_script( 'shortcode_cycle_js' );
		wp_deregister_script( 'shortcode_cycle_js' );
		
		wp_dequeue_script( 'shortcode_js' );
		wp_deregister_script( 'shortcode_js' );
		
		wp_dequeue_script( 'shortcode_theme_js' );
		wp_deregister_script( 'shortcode_theme_js' );
		
		wp_dequeue_script( 'widgets_theme_js' );
		wp_deregister_script( 'widgets_theme_js' );		
		
		
		//wp_dequeue_script( 'yit-woocommerce' );//
		//wp_deregister_script( 'yit-woocommerce' ); //
		
		
	}
	
	
   
}

//add_action( 'wp_footer', 'wp_footer_dilrang' );
function wp_footer_dilrang()
{

wp_register_script( 'jquery-core' ); 
wp_enqueue_script( 'jquery-core' );

wp_register_script( 'jquery-migrate' );
wp_enqueue_script( 'jquery-migrate' );

wp_register_script( 'Advancedlazyload' );
wp_enqueue_script( 'Advancedlazyload' );		

wp_register_script( 'themepunchtools' );
wp_enqueue_script( 'themepunchtools' );

wp_register_script( 'revolution-slider-jquery.themepunch.revolution.min' );
wp_enqueue_script( 'revolution-slider-jquery.themepunch.revolution.min' );

wp_register_script( 'underscore' );
wp_enqueue_script( 'underscore' );

wp_register_script( 'shortcode' );
wp_enqueue_script( 'shortcode' );	

wp_register_script( 'jquery-colorbox-easing-flexslider-imagesloaded-tiptip' );
wp_enqueue_script( 'jquery-colorbox-easing-flexslider-imagesloaded-tiptip' );

wp_register_script( 'woocommerce' );
wp_enqueue_script( 'woocommerce' );

wp_register_script( 'jquery-cookie' );
wp_enqueue_script( 'jquery-cookie' );

wp_register_script( 'yit-woocommerce' );
wp_enqueue_script( 'yit-woocommerce' );


wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', false, '2.1.0');
}



/****************************
//WordPress Login Form Short Code
[loginform redirect="http://dilrang.com/"]
*****************************/
function pippin_login_form_shortcode( $atts, $content = null ) {
 
	extract( shortcode_atts( array(
      'redirect' => ''
      ), $atts ) );
 
	if (!is_user_logged_in()) {
		if($redirect) {
			$redirect_url = $redirect;
		} else {
			$redirect_url = get_permalink();
		}
		$form = wp_login_form(array('echo' => false, 'redirect' => $redirect_url ));
	} 
	return $form;
}
add_shortcode('loginform', 'pippin_login_form_shortcode');


/****************************
//WordPress register  Form Short Code
[registerform]
*****************************/
function pippin_register_form_shortcode( $atts, $content = null ) {
 
	extract( shortcode_atts( array(
      'redirect' => ''
      ), $atts ) );
 
	if (!is_user_logged_in()) {
		ob_start();
		?>
		<form method="post" class="register">

			<?php if ( get_option( 'woocommerce_registration_email_for_username' ) == 'no' ) : ?>

				<p class="form-row form-row-first">
					<label for="reg_username"><?php _e( 'Username', 'yit' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
				</p>

				<p class="form-row form-row-wide">

			<?php else : ?>
				<p class="form-row form-row-wide">
			<?php endif; ?>
				<label for="reg_email"><?php _e( 'Email', 'yit' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
			</p>

			<div class="clear"></div>
			<p class="form-row form-row-wide">
				<label for="reg_password"><?php _e( 'Password', 'yit' ); ?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
			</p>

			<div class="clear"></div>
			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
            <?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>

			<p class="form-row">
                <?php wp_nonce_field( 'woocommerce-register', 'register') ?>
				<input type="submit" class="button" name="register" value="<?php _e( 'Register', 'yit' ); ?>" />
			</p>

		</form>
        <?php
		$form = ob_get_contents();
		ob_end_clean();
		
	} 
	return $form;
}
add_shortcode('registerform', 'pippin_register_form_shortcode');

add_action('signup_finished','signup_finished_funcode');
function signup_finished_funcode()
{	
global $wpdb, $blogname, $blog_title, $errors, $domain, $path;
	$slug = 'appdev-child';
	$encoded_slug = urlencode( $slug );
	$activeurl = str_replace('&amp;','&',(wp_nonce_url( 'http://'.$domain.$path. 'wp-admin/themes.php?action=activate&stylesheet='.$encoded_slug , 'switch-theme_' . $slug )));
?>
	<script>window.location.href="<?php echo $activeurl;?>";</script>
<?php
	exit;
}

//$themes = wp_prepare_themes_for_js( array( wp_get_theme('appdev-child')) );
//$theme = wp_get_theme('appdev-child');
//echo '<pre>';
//print_r($theme);exit;
