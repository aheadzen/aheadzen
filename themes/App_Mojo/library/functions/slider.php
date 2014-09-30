<?php
//----------------------------------------------------------------------//
// Initiate the plugin to add custom post type
//----------------------------------------------------------------------//

add_action("init", "aheadzen_posttype_slider");
function aheadzen_posttype_slider()
{
	global $aheadzen_admin_url;
	register_post_type(	'slider', 
		array(	'label' 			=> __('Slider','aheadzen'),
				'labels' => array(	
				'name' 					=> __('Sliders','aheadzen'),
				'singular_name' 		=> __('Slider','aheadzen'),
				'add_new' 				=> __('Add Slider','aheadzen'),
				'add_new_item' 			=> __('Add New Slider','aheadzen'),
				'edit' 					=> __('Edit','aheadzen'),
				'edit_item' 			=> __('Edit Slider','aheadzen'),
				'new_item' 				=> __('New Slider','aheadzen'),
				'view_item'				=> __('View Slider','aheadzen'),
				'search_items' 			=> __('Search Slider','aheadzen'),
				'not_found' 			=> __('No Slider found','aheadzen'),
				'not_found_in_trash' 	=> __('No Slider found in trash','aheadzen')	),
		'public' 			=> true,
		'can_export'		=> true,
		'show_ui' 			=> true, // UI in admin panel
		'_builtin' 			=> false, // It's a custom post type, not built in
		'_edit_link' 		=> 'post.php?post=%d',
		'capability_type' 	=> 'post',
		'hierarchical' 		=> false,
		'rewrite' 			=> array("slug" => "sliders"), // Permalinks
		'query_var' 		=> "sliders", // This goes to the WP_Query schema
		'supports' 			=> array('title','custom-fields','thumbnail') , 
		'menu_position' 	=> 5,
		'show_in_nav_menus'	=> false ,
		'taxonomies'		=> array()
		)
	);
}

/************************************
//Define the custom box
***************************************/
// backwards compatible
add_action('admin_init', 'aheadzen_slider_add_custom_box', 1);

/* Do something with the data entered */
add_action('save_post', 'aheadzen_slider_save_postdata');

/* Adds a box to the main column on the Post and Page edit screens */
function aheadzen_slider_add_custom_box() {
    add_meta_box( 'myplugin_sectionid', __( 'Slider Settings','aheadzen'),'slider_inner_custom_box', 'slider' );
	do_action('aheadzen_slider_add_custom_box_post');
}

/* Prints the box content */
function slider_inner_custom_box() {
global $post;
?>

<table border="0" cellpadding="5" cellspacing="5" width="100%">
  <tr>
    <td width="20%"><?php _e("Enter Full URL",'aheadzen')?></td>
    <td><input type="text" id= "the_url" name="the_url" class="the_url" style="width:80%" value="<?php echo get_post_meta($post->ID,'the_url',true);?>">
      <br />
      <small>
      <?php _e('Enter Full URL. eg: http://aheadzen.com/affiliates/','aheadzen');?>
      </small> </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><b><?php _e('Please note that slider image should be 1130px x 421px (by width & height). <br> Upload Slider Image from "Featured Image" Section','aheadzen');?></b></td>
  </tr>
</table>
<?php
}


/* When the post is saved, saves our custom data */
function aheadzen_slider_save_postdata( $post_id ) {

  // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
  // to do anything
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;

  
  // Check permissions
  if ( 'slider' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
      return $post_id;
	  
	   // OK, we're authenticated: we need to find and save the data
	  update_post_meta($post_id,'the_url',$_POST['the_url']);
	  update_post_meta($post_id,'desc',$_POST['desc']);
	  update_post_meta($post_id,'pos',$_POST['pos']);
  } 
   return $mydata;
}


/**
 * Columns for Products page
 *
 * @access public
 * @param mixed $columns
 * @return array
 */
function aheadzen_edit_slider_columns($columns){
	$columns = array();
	$columns["cb"] = "<input type=\"checkbox\" />";
	$columns["name"] = __("Name", 'aheadzen');
	$columns["thumb"] = __("Image", 'aheadzen');
	$columns["url"] = __("URL", 'aheadzen');
	$columns["date"] = __("Date", 'aheadzen');
	return $columns;
}

add_filter('manage_edit-slider_columns', 'aheadzen_edit_slider_columns');


/**
 * Custom Columns for Products page
 *
 * @access public
 * @param mixed $column
 * @return void
 */
function aheadzen_custom_slider_columns( $column ) {
	global $post, $woocommerce;
	$product = new WC_Product($post->ID);
	$url = get_post_meta($post->ID,'the_url',true);
	switch ($column) {
		case "thumb" :
			echo $product->get_image();
		break;
		case "url" :
			echo $url;
		break;
		case "name" :
			$edit_link = get_edit_post_link( $post->ID );
			$title = _draft_or_post_title();
			$post_type_object = get_post_type_object( $post->post_type );
			$can_edit_post = current_user_can( $post_type_object->cap->edit_post, $post->ID );

			echo '<strong><a class="row-title" href="'.$edit_link.'">' . $title.'</a>';

			_post_states( $post );

			echo '</strong>';

			if ( $post->post_parent > 0 )
				echo '&nbsp;&nbsp;&larr; <a href="'. get_edit_post_link($post->post_parent) .'">'. get_the_title($post->post_parent) .'</a>';

			// Excerpt view
			if (isset($_GET['mode']) && $_GET['mode']=='excerpt') echo apply_filters('the_excerpt', $post->post_excerpt);

			// Get actions
			$actions = array();

			$actions['id'] = 'ID: ' . $post->ID;

			if ( $can_edit_post && 'trash' != $post->post_status ) {
				$actions['inline hide-if-no-js'] = '<a href="#" class="editinline" title="' . esc_attr( __( 'Edit this item inline', 'woocommerce' ) ) . '">' . __( 'Quick&nbsp;Edit', 'woocommerce' ) . '</a>';
			}
			if ( current_user_can( $post_type_object->cap->delete_post, $post->ID ) ) {
				if ( 'trash' == $post->post_status )
					$actions['untrash'] = "<a title='" . esc_attr( __( 'Restore this item from the Trash', 'woocommerce' ) ) . "' href='" . wp_nonce_url( admin_url( sprintf( $post_type_object->_edit_link . '&amp;action=untrash', $post->ID ) ), 'untrash-' . $post->post_type . '_' . $post->ID ) . "'>" . __( 'Restore', 'woocommerce' ) . "</a>";
				elseif ( EMPTY_TRASH_DAYS )
					$actions['trash'] = "<a class='submitdelete' title='" . esc_attr( __( 'Move this item to the Trash', 'woocommerce' ) ) . "' href='" . get_delete_post_link( $post->ID ) . "'>" . __( 'Trash', 'woocommerce' ) . "</a>";
				if ( 'trash' == $post->post_status || !EMPTY_TRASH_DAYS )
					$actions['delete'] = "<a class='submitdelete' title='" . esc_attr( __( 'Delete this item permanently', 'woocommerce' ) ) . "' href='" . get_delete_post_link( $post->ID, '', true ) . "'>" . __( 'Delete Permanently', 'woocommerce' ) . "</a>";
			}
			if ( $post_type_object->public ) {
				if ( in_array( $post->post_status, array( 'pending', 'draft' ) ) ) {
					if ( $can_edit_post )
						$actions['view'] = '<a href="' . esc_url( add_query_arg( 'preview', 'true', get_permalink( $post->ID ) ) ) . '" title="' . esc_attr( sprintf( __( 'Preview &#8220;%s&#8221;', 'woocommerce' ), $title ) ) . '" rel="permalink">' . __( 'Preview', 'woocommerce' ) . '</a>';
				} elseif ( 'trash' != $post->post_status ) {
					$actions['view'] = '<a href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( sprintf( __( 'View &#8220;%s&#8221;', 'woocommerce' ), $title ) ) . '" rel="permalink">' . __( 'View', 'woocommerce' ) . '</a>';
				}
			}
			$actions = apply_filters( 'post_row_actions', $actions, $post );

			echo '<div class="row-actions">';

			$i = 0;
			$action_count = sizeof($actions);

			foreach ( $actions as $action => $link ) {
				++$i;
				( $i == $action_count ) ? $sep = '' : $sep = ' | ';
				echo "<span class='$action'>$link$sep</span>";
			}
			echo '</div>';

			get_inline_data( $post );

			/* Custom inline data for woocommerce */
			echo '
				<div class="hidden" id="woocommerce_inline_' . $post->ID . '">
					<div class="menu_order">' . $post->menu_order . '</div>
					<div class="sku">' . $product->sku . '</div>
					<div class="regular_price">' . $product->regular_price . '</div>
					<div class="sale_price">' . $product->sale_price . '</div>
					<div class="weight">' . $product->weight . '</div>
					<div class="length">' . $product->length . '</div>
					<div class="width">' . $product->width . '</div>
					<div class="height">' . $product->height . '</div>
					<div class="visibility">' . $product->visibility . '</div>
					<div class="stock_status">' . $product->stock_status . '</div>
					<div class="stock">' . $product->stock . '</div>
					<div class="manage_stock">' . $product->manage_stock . '</div>
					<div class="featured">' . $product->featured . '</div>
					<div class="product_type">' . $product->product_type . '</div>
					<div class="product_is_virtual">' . $product->virtual . '</div>
				</div>
			';

		break;
	}
}

add_action('manage_slider_posts_custom_column', 'aheadzen_custom_slider_columns', 2 );



add_action('aheadzen_home_slider','aheadzen_home_slider');
function aheadzen_home_slider()
{
if(!aheadzen_get_option('aheadzen_hide_slider_home'))
{
		$args = array(
			'posts_per_page'	=> -1,
			'post_type'			=> 'slider',
			);
		// The Query
		query_posts( $args );
?>
<?php if ( have_posts()) : ?>
<section id="slider-wrapper">
<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery('.flexslider').flexslider({
			animation: "fade",              //String: Select your animation type, "fade" or "slide"
			slideDirection: "horizontal",   //String: Select the sliding direction, "horizontal" or "vertical"
			slideshow: true,                //Boolean: Animate slider automatically
			slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
			animationDuration: 700,         //Integer: Set the speed of animations, in milliseconds
			directionNav: true,             //Boolean: Create navigation for previous/next navigation? (true/false)
			controlNav: true,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
			keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
			mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
			prevText: "Previous",           //String: Set the text for the "previous" directionNav item
			nextText: "Next",               //String: Set the text for the "next" directionNav item
			pausePlay: false,               //Boolean: Create pause/play dynamic element
			pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
			playText: 'Play',               //String: Set the text for the "play" pausePlay item
			randomize: false,               //Boolean: Randomize slide order
			slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
			animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
			pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
			pauseOnHover: false,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
			controlsContainer: ".flexslider-container",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
			start: function(){},            //Callback: function(slider) - Fires when the slider loads the first slide
			before: function(){},           //Callback: function(slider) - Fires asynchronously with each slider animation
			after: function(){},            //Callback: function(slider) - Fires after each slider animation completes
			end: function(){}               //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
		});
	});
</script>
<div class="flexslider-holder">
    <div class="flexslider-container">
      <div class="flexslider">
	  	<ul class="slides">
	<?php // The Loop
	while ( have_posts() ) : the_post(); ?>
	<?php
	$pid = get_the_ID();
	if (has_post_thumbnail($pid, 'full')) {
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($pid), 'full');
	$title = get_the_title();
	$link = get_post_meta($pid,'the_url',true);
	if(!$link){$link='#';}
	//$thumb = get_post_thumbnail_id();
	//$image = aheadzen_thumbnail_resize($thumb, '', '', '', true, 90);
	?>
	<li> <a href='<?php echo $link; ?>'><img src='<?php echo $large_image_url[0]; ?>' alt=''/></a> </li>
	<?php }?>
	<?php endwhile; ?>
		</ul>
		</div>
    </div>
  </div>
</section>
<?php endif; ?>	
<?php wp_reset_query(); // Reset Query?>
<?php }?>
<?php
}
?>
