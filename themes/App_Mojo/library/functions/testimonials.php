<?php
//----------------------------------------------------------------------//
// Initiate the plugin to add custom post type
//----------------------------------------------------------------------//

add_action("init", "aheadzen_posttype_testimonial");
function aheadzen_posttype_testimonial()
{
	global $aheadzen_admin_url;
	register_post_type(	'testimonial', 
		array(	'label' 			=> __('Testimonial','aheadzen'),
				'labels' => array(	
				'name' 					=> __('Testimonials','aheadzen'),
				'singular_name' 		=> __('Testimonial','aheadzen'),
				'add_new' 				=> __('Add Testimonial','aheadzen'),
				'add_new_item' 			=> __('Add New Testimonial','aheadzen'),
				'edit' 					=> __('Edit','aheadzen'),
				'edit_item' 			=> __('Edit Testimonial','aheadzen'),
				'new_item' 				=> __('New Testimonial','aheadzen'),
				'view_item'				=> __('View Testimonial','aheadzen'),
				'search_items' 			=> __('Search Testimonial','aheadzen'),
				'not_found' 			=> __('No Testimonial found','aheadzen'),
				'not_found_in_trash' 	=> __('No Testimonial found in trash','aheadzen')	),
		'public' 			=> true,
		'can_export'		=> true,
		'show_ui' 			=> true, // UI in admin panel
		'_builtin' 			=> false, // It's a custom post type, not built in
		'_edit_link' 		=> 'post.php?post=%d',
		'capability_type' 	=> 'post',
		'hierarchical' 		=> false,
		'rewrite' 			=> array("slug" => "sliders"), // Permalinks
		'query_var' 		=> "sliders", // This goes to the WP_Query schema
		'supports' 			=> array('title','editor','thumbnail') , 
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
add_action('admin_init', 'aheadzen_testimonial_add_custom_box', 1);

/* Do something with the data entered */
add_action('save_post', 'aheadzen_testimonial_save_postdata');

/* Adds a box to the main column on the Post and Page edit screens */
function aheadzen_testimonial_add_custom_box() {
    add_meta_box( 'myplugin_sectionid', __( 'Testimonial Settings','aheadzen'),'testimonial_inner_custom_box', 'testimonial' );
	do_action('aheadzen_slider_add_custom_box_post');
}

/* Prints the box content */
function testimonial_inner_custom_box() {
global $post;
?>

<table border="0" cellpadding="5" cellspacing="5" width="100%">
  <tr>
    <td width="20%"><?php _e("Client Designation",'aheadzen')?></td>
    <td><input type="text" id= "name" name="designation" class="name" style="width:80%" value="<?php echo get_post_meta($post->ID,'designation',true);?>">
      <br />
      <small>
      <?php _e('Enter Designation of client.','aheadzen');?>
      </small> </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  
</table>
<?php
}


/* When the post is saved, saves our custom data */
function aheadzen_testimonial_save_postdata( $post_id ) {

  // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
  // to do anything
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;

  
  // Check permissions
  if ( 'testimonial' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
      return $post_id;
	  
	   // OK, we're authenticated: we need to find and save the data
	  update_post_meta($post_id,'designation',$_POST['designation']);
  } 
   return $mydata;
}


/********************************************************
TESTIMONIAL WIDGET
********************************************************/
if(!class_exists('aheadzen_testimonial_widget')){
	class aheadzen_testimonial_widget extends WP_Widget {
		function aheadzen_testimonial_widget() {
		//Constructor
			$widget_ops = array('classname' => 'testimonial', 'description' =>__('Testimonials','aheadzen'));		
			$this->WP_Widget('testimonial',__('my: Testimonials','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];	
			$align = empty($instance['align']) ? '' : $instance['align'];				
			$num = empty($instance['num']) ? '10' : $instance['num'];
			
			$withoutborder = empty($instance['withoutborder']) ? '' : $instance['withoutborder'];
			if($withoutborder)
			{				
				$before_widget = str_replace('content-main','content-main-none',$before_widget);
			}
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
			}
			echo $before_widget;
			?>
            <?php if($title){?>
            <h2 class="border-title <?php echo $titlesize.' '.$align;?>"><font <?php echo aheadzen_inline_edit_code($this->get_field_id('title'));?>><?php echo $title;?></font><span></span></h2>
			<?php aheadzen_inline_head_tinymce($this->get_field_id('title'));?>
            <div class="margin15"></div>
            <?php }?>
             <div class="testimonial-wrapper">
                    
						<?php
							$args = array(
									'post_type' => 'testimonial',
									'posts_per_page' => $num,
									);
						// The Query
							$the_query = new WP_Query( $args );
							global $post;
							// The Loop
							if ( $the_query->have_posts() ) {
								echo '<ul class="quotes_wrapper">';
								$counter=0;
								while ( $the_query->have_posts() ) {
									$counter++;
									$the_query->the_post();
									$pid=get_the_id();
									$designation = get_post_meta($pid,'designation',true);
									?>
									<li>
										<figure <?php echo aheadzen_inline_edit_code('editpost-testimonial-image-'.$pid);?> class="testimonial-thumb <?php if(($counter%2)==0){echo 'alignright';}?> animate" data-animation="fadeInUp">
											<span class="item-mask"> </span>
											<?php
											if ( has_post_thumbnail()) {
												echo get_the_post_thumbnail($post_id, array(180,206));
											}else{
											?>
											<img src="<?php echo get_template_directory_uri();?>/images/default_user.png" alt="" />
											<?php
											}
											aheadzen_inline_image('editpost-testimonial-image-'.$pid);
											?>
											
										</figure>
										<div class="testimonial-content-wrapper">
											<div class="author-meta">
												<p <?php echo aheadzen_inline_edit_code('editpost-testimonial-title-'.$pid);?>><?php the_title();?></p>
												<?php aheadzen_inline_head_tinymce('editpost-testimonial-title-'.$pid);?>
												<?php if($designation){?>
												<span <?php echo aheadzen_inline_edit_code('editpost-testimonial-customdesignation-'.$pid);?> > <?php echo $designation;?> </span>
												<?php aheadzen_inline_head_tinymce('editpost-testimonial-customdesignation-'.$pid);?>
												<?php }?>
											</div>
											<blockquote <?php echo aheadzen_inline_edit_code('editpost-testimonial-description-'.$pid);?>> <?php echo $post->post_content;?> </blockquote>
											<?php aheadzen_inline_tinymce('editpost-testimonial-description-'.$pid);?>
										</div>
									</li>
									<?php
								}
								echo '</ul>';
							} else {
								// no posts found
							}
							/* Restore original Post Data */
							wp_reset_postdata();
						?>
                             
                </div>
             <div class="margin50"></div>
			<?php
			echo $after_widget;
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;		
			return $new_instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array() );		
			$title = strip_tags($instance['title']);
			$titlesize = strip_tags($instance['titlesize']);
			$align = strip_tags($instance['align']);
			$num = intval($instance['num']);
			if(!$num){$num=4;}
			
		global  $title_font_size_arr,$title_text_align_arr;
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />	
	</label></p>    
	
	
	<?php 
	aheadzen_title_text_align_dl_fun($this->get_field_id('align'),$this->get_field_name('align'),$align);
	?>	
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize'),$this->get_field_name('titlesize'),$titlesize);
	?>
	
   
	<p><label for="<?php  echo $this->get_field_id('withoutborder'); ?>">
	<input class="widefat" id="<?php  echo $this->get_field_id('withoutborder'); ?>" name="<?php echo $this->get_field_name('withoutborder'); ?>" type="checkbox" value="1" <?php if($withoutborder){echo 'checked';}?>  />
	<?php _e('Show Data without borders (simple inner html only)?','aheadzen');?>	
	</label></p>
	
    <p><label for="<?php  echo $this->get_field_id('num'); ?>"><?php _e('Number Of listing to show','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo esc_attr($num); ?>" />	
	</label></p>
	
	
	<style>
	.widget-inside .edit_testimonial_front{ display:none;}
	</style>
	<div class="edit_testimonial_front">
	<?php
	global $wpdb;
	$pid = $wpdb->get_var("select post_id from $wpdb->postmeta where meta_value='tpl_testimonial.php' and meta_key='_wp_page_template' limit 1");
	if($pid)
	{
	?>
	<br>
	<a href="<?php echo get_permalink($pid);?>/?editing=1" target="_blank"><h3>Manage Testimonial settings from here >></h3></a>
	<?php
	}else{
	echo '<h5>';
	_e('Go to wp-admin > Create new Page(eg:Testimonial as title) > select template -- "Testimonials" > Save','aheadzen');
	echo '</h5>';
	}	
	?>
   </div>
   <br>
   
   <?php
	}}
	register_widget('aheadzen_testimonial_widget');
}

?>