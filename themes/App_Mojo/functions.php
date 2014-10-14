<?php
$admin_path = TEMPLATEPATH . '/admin/';
$aheadzen_admin_url = get_stylesheet_directory_uri() . '/admin/';
define('WPW_ADMIN_PATH',$admin_path);
define('WPW_ADMIN_URL',$aheadzen_admin_url);


/**
 * Tell WordPress to run aheadzen_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'aheadzen_theme_setup' );

add_theme_support( 'post-thumbnails' );


if ( ! function_exists( 'aheadzen_theme_setup' ) ):
function aheadzen_theme_setup() {

	/* Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use a find and replace
	 * to change 'aheadzen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'aheadzen', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );
	
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Main menu', 'aheadzen' ),
		'footer'   => __( 'Footer link', 'aheadzen' ),
	) );
}
endif; // aheadzen_setup

add_filter('widget_text', 'do_shortcode'); //add shortcodes in widgets


/*Include the external files*/
include_once('library/functions/widgets.php');
include_once('library/functions/widget_functions.php');
include_once('library/functions/testimonials.php');
include_once('library/functions/portfolio.php');
if(!is_child_theme())
{
	include_once('library/functions/auto_demo_setup.php');
}

if(is_admin())
{
	include_once('library/functions/itune_google_play_store_menu.php');
	include_once('library/functions/google_play_store_settings.php');
	include_once('library/functions/itune_settings.php');
}

/*
Front end editor body widht adjust in case of full width 
To appear the editor settings properly.
*/
add_action('wp_head','edit_body_plugin_css');
function edit_body_plugin_css()
{
	if($_GET['editing'] == '1')
	{
	?>
	<style>
	.edit_image,.delete_image{left: auto;position: absolute;right: 5px;top:5px;}
	.edit_image{right:50px;}
	.style-picker-ico {left: 2px !important;}
	body {margin: 0 auto;width: 90%;}
	#header {margin-top: 15px !important;}
	#header {position: relative !important; z-index: 0!important;}
	#home{margin-top: 20px;}
	</style>
	
	<?php
	}

}

require get_template_directory() . '/inc/customizer.php';


/*
	Front end editor plugin settings
	If "editing" = 1, it will show front end as edit mode
	else as ussual visitor mode.
*/
if( !$_GET['editing'] == 'yes'){
// Disable Front end editor
function fee_disable( $disable ) {
    return $_GET['editing'] != '1';
}
add_filter( 'front_end_editor_disable', 'fee_disable' );
}



/*Just test code to collect widget data */
if($_GET['test'])
{
$aheadzen_title = get_option('widget_aheadzen_title');
print_r($aheadzen_title);

echo '<br><br>';
$sidebar_arr = get_option('sidebars_widgets');
$content1_arr = $sidebar_arr['content1'];
if($content1_arr)
{
	for($i=0;$i<count($content1_arr);$i++)
	{
		$widget_title = $content1_arr[$i];
		if(strstr($widget_title,'aheadzen_title-'))
		{
			$widget_title_arr = explode('-',$widget_title);
			$aheadzen_title_index =  $widget_title_arr[count($widget_title_arr)-1];
			echo $title = $aheadzen_title[$aheadzen_title_index]['title'];
			$title_id = str_replace(' ','',$title);
		}
	}
}

print_r($sidebar_arr['content1']);
exit;
}


/*Custom menu new widget title wise settings (added new custom menu for widgets)*/
if ( !class_exists('JMO_Custom_Nav')) {
class JMO_Custom_Nav {
public function add_nav_menu_meta_boxes() {
add_meta_box(
'wl_thememenu_nav_link',
__('Theme Menu Settings'),
array( $this, 'nav_menu_link'),
'nav-menus',
'side',
'low'
);
}
public function nav_menu_link() {?>
<div id="posttype-wl-login" class="posttypediv">
<div id="posttype-theme" class="tabs-panel tabs-panel-active">
<ul id ="posttype-theme-tabs" class="categorychecklist form-no-clear">
<li>
<label class="menu-item-title">
<input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> Home Link
</label>
<input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="custom">
<input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="Home">
<input type="hidden" class="menu-item-url" name="menu-item[-1][menu-item-url]" value="<?php //bloginfo('wpurl'); ?>/#home">
<input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="wl-home">
</li>

<?php
$aheadzen_title = get_option('widget_aheadzen_title');
$sidebar_arr = get_option('sidebars_widgets');
$content1_arr = $sidebar_arr['content1'];
if($content1_arr)
{
	$counter = 1;
	for($i=0;$i<count($content1_arr);$i++)
	{
		$widget_title = $content1_arr[$i];
		if(strstr($widget_title,'aheadzen_title-'))
		{
			$widget_title_arr = explode('-',$widget_title);
			$aheadzen_title_index =  $widget_title_arr[count($widget_title_arr)-1];
			$title = $aheadzen_title[$aheadzen_title_index]['title'];
			$arr_find = array(' ','&','`','~','!','@','#','$','%','^','*','(',')','=','+','<','>','?','\\','|','/','\'','"','{','}','[',']',':',';');
			$arr_replace = array('','-','','','','','','','','','','','','','','','','','','','','','','','','','','','');
			$title_id = str_replace($arr_find,$arr_replace,$title);
			$counter++;
			?>
<li>
	<label class="menu-item-title">
	<input type="checkbox" class="menu-item-checkbox" name="menu-item[-<?php echo $counter;?>][menu-item-object-id]" value="-2"> <?php echo $title;?>
	</label>
	<input type="hidden" class="menu-item-type" name="menu-item[-<?php echo $counter;?>][menu-item-type]" value="custom">
	<input type="hidden" class="menu-item-title" name="menu-item[-<?php echo $counter;?>][menu-item-title]" value="<?php echo $title;?>">
	<input type="hidden" class="menu-item-url" name="menu-item[-<?php echo $counter;?>][menu-item-url]" value="<?php //bloginfo('wpurl'); ?>#<?php echo $title_id;?>">
	<input type="hidden" class="menu-item-classes" name="menu-item[-<?php echo $counter;?>][menu-item-classes]" value="wl-content-area1">
</li>			
			<?php
		}
	}
}
?>

</ul>
</div>

<p class="button-controls">
<span class="list-controls">


</span>
<span class="add-to-menu">
<input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-post-type-menu-item" id="submit-posttype-wl-login">
<span class="spinner"></span>
</span>
</p>
</div>
<?php }
}
}
 
$custom_nav = new JMO_Custom_Nav;
 
add_action('admin_init', array($custom_nav, 'add_nav_menu_meta_boxes'));

/*Contact Form Submit Email*/
if($_POST['contact_frm'])
{
	$toemail = $_POST['toeml'];
	$name = $_POST['txtname'];
	$txtemail = $_POST['txtemail'];
	$txtphone = $_POST['txtphone'];
	$txtmessage = nl2br($_POST['txtmessage']);	
	
	if(!$toemail){
		$toemail = get_option( 'admin_email' );
	}
	
	$subject=__('Contact Inquiry','aheadzen');
	$message='Good Day,<br><br><br>Some one with below information want contact you.<br><br>';
	$message .='Name : '.$name.'<br>';
	$message .='Email : '.$txtemail.'<br>';
	$message .='Phone : '.$txtphone.'<br>';
	$message .='Message : <br>'.$txtmessage.'<br>';
	$message .='<br><br><br>Thank You.';
	
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= 'To: '.$toemail.' <'.$toemail.'>' . "\r\n";
	$headers .= 'From: '.$txtemail .' <'.$txtemail.'>'  . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	
	/*echo "Header : headers <br>";
	echo "From : $fromEmail  Name : $fromEmailName <br>";
	echo "To : $toEmail  Name : $toEmailName <br>";
	echo "Subject $subject <br>";
	echo "$message";
	exit;*/
	mail($toEmail, $subject, $message, $headers);
	
	echo '<div class="message">'.__('Your details sent successfully.','aheadzen').'</div>';
	 exit;
}else
if($_POST['action']=='fanfabsavefeaturedimg') /*Featured image save & skin css settings*/
{
	$attach_id = $_POST['aid'];
	$post_id = $_POST['pid'];
	 update_option($post_id,$attach_id);
	 exit;
}else
if($_POST['action']=='setdisplayskin')
{
	$skin = $_POST['skin'];
	$pattern = $_POST['pattern'];
	$layout = $_POST['layout'];
	
	if($skin){update_option('aheadzen_skin',$skin);}
	if($pattern){update_option('aheadzen_pattern',$pattern);}
	if($layout){update_option('aheadzen_layout',$layout);}
	echo 'Updated success';
	exit;
}

/*Body class settings as per layout settings */
function aheadzen_body_classes( $classes ) {
	$aheadzen_layout = get_option('aheadzen_layout');
	if ( $aheadzen_layout=='boxed' ) {
		$classes[] = 'boxed';
	}
	return $classes;
}
add_filter( 'body_class', 'aheadzen_body_classes' );


/*Remove admin bar from front End*/
//add_filter('show_admin_bar', '__return_false');


// add links/menus to the admin bar
function aheadzen_admin_bar_render() {
	global $wp_admin_bar;
	
	$arg = array(
		'parent' => false, // use 'false' for a root menu, or pass the ID of the parent menu
		'id' => 'edit_template', // link ID, defaults to a sanitized title value
		'meta' => array('class' => 'edit_website_link') // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
	);
	if($_GET['editing'])
	{
		$arg['title']= __('VIEW UPDATED - click to see');
		$arg['href']= site_url();
		$arg['meta']['target']= '_blank';
	}else{
		$arg['title']= __('EDIT YOUR WEBSITE');
		$arg['href']= site_url('?editing=1');
	}
	$wp_admin_bar->add_menu($arg);
	
	if($_GET['editing'])
	{
		$wp_admin_bar->add_menu( array(
			'parent' => false,
			'id'    => 'inline_edit_success_msg',
			'title' => '',
			'meta' => array('class' => 'inline_edit_success_msg'),
			//'href'	=> site_url('?editing=html')
		));
		
	}
}
add_action( 'wp_before_admin_bar_render', 'aheadzen_admin_bar_render' );

 /*
if($_GET['editing']==1)
{
$_GET['barley_editor'] = 'off';
remove_filter('edit_post_link', 'barley_custom_edit_post_link');
}
*/