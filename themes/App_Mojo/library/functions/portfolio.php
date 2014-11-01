<?php
//----------------------------------------------------------------------//
// Initiate the plugin to add custom post type
//----------------------------------------------------------------------//

add_action("init", "aheadzen_posttype_portfolio");
function aheadzen_posttype_portfolio()
{
	global $aheadzen_admin_url;
	register_post_type(	'portfolio', 
		array(	'label' 			=> __('Portfolio','aheadzen'),
				'labels' => array(	
				'name' 					=> __('Portfolio','aheadzen'),
				'singular_name' 		=> __('Portfolio','aheadzen'),
				'add_new' 				=> __('Add Portfolio','aheadzen'),
				'add_new_item' 			=> __('Add New Portfolio','aheadzen'),
				'edit' 					=> __('Edit','aheadzen'),
				'edit_item' 			=> __('Edit Portfolio','aheadzen'),
				'new_item' 				=> __('New Portfolio','aheadzen'),
				'view_item'				=> __('View Portfolio','aheadzen'),
				'search_items' 			=> __('Search Portfolio','aheadzen'),
				'not_found' 			=> __('No Portfolio found','aheadzen'),
				'not_found_in_trash' 	=> __('No Portfolio found in trash','aheadzen')	),
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

/********************************************************
Portfolio WIDGET
********************************************************/
if(!class_exists('aheadzen_portfolio_widget')){
	class aheadzen_portfolio_widget extends WP_Widget {
		function aheadzen_portfolio_widget() {
		//Constructor
			$widget_ops = array('classname' => 'portfolio', 'description' =>__('Portfolio/collection list','aheadzen'));		
			$this->WP_Widget('portfolio',__('my: Portfolio','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
		global $wpdb;
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];
			$align = empty($instance['align']) ? '' : $instance['align'];
			$num = empty($instance['num']) ? '4' : $instance['num'];
			
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
			
			<?php
				$args = array(
						'post_type' => 'portfolio',
						'posts_per_page' => $num,
						);
				// The Query
				$the_query = new WP_Query( $args );
				global $post;
				// The Loop
				$post_data_arr = array();
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$pid=get_the_id();
					$designation = get_post_meta($pid,'designation',true);
						$post_data = array();
						//$sql = "select t.name from $wpdb->terms t join $wpdb->term_taxonomy tt on tt.term_id=t.term_id join ";
						$big_image = wp_get_attachment_url( get_post_thumbnail_id($pid) );
						$post_data['id']=$pid;
						$post_data['title']=get_the_title();
						$post_data['cat']=$category;
						$post_data['bimage']=$big_image;
						$post_data['link']=get_permalink();
						$post_data['image']=get_the_post_thumbnail($pid, array(300,300));
						$post_data_arr[] = $post_data;
					}
				}
			?>
			    <div class="portfolio-container animate" data-animation="pulse">
                    <?php if(count($post_data_arr)>0){
						for($i=0;$i<count($post_data_arr);$i++){
						$pdata = $post_data_arr[$i];
						$pid = $pdata['id'];
					?>
                    <div class="portfolio one-third column blog webdesign">
                        <div <?php echo aheadzen_inline_edit_code('editpost-portfolio-image-'.$pid);?> class="portfolio-thumb">
                            <?php echo $pdata['image'];?>
                            <div class="image-overlay">
                                <a href="<?php echo $pdata['link'];?>" class="link"><span class="icon-link"></span></a>
                                <a href="<?php echo $pdata['bimage'];?>" class="zoom" data-gal="prettyPhoto[gallery]"><span class="icon-search"></span></a>
                            </div>
                        </div>
						<?php aheadzen_inline_image('editpost-portfolio-image-'.$pid);?>
                        <div class="portfolio-detail">
                            <div class="portfolio-title">
                                <h4><a href="#" <?php echo aheadzen_inline_edit_code('editpost-portfolio-title-'.$pid);?>><?php echo $pdata['title'];?></a></h4>
								<?php aheadzen_inline_head_tinymce('editpost-portfolio-title-'.$pid);?>
                            </div>
                        </div>
                    </div>
					<?php 
						}
					}?>					
					
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
		
	
	<div class="edit_portfolio_front">
	<?php
	global $wpdb;
	$pid = $wpdb->get_var("select post_id from $wpdb->postmeta where meta_value='tpl_portfolio.php' and meta_key='_wp_page_template' limit 1");
	if($pid)
	{
	?>
	<br>
	<a href="<?php echo get_permalink($pid);?>/?editing=1" target="_blank"><h3>Manage Portfolio settings from here >></h3></a>
	<?php
	}else{
	echo '<h5>';
	_e('Go to wp-admin > Create new Page(eg:Portfolio as title) > select template -- "Portfolio" > Save','aheadzen');
	echo '</h5>';
	}	
	?>
   </div>
   <br>
   <?php
   
	}}
	register_widget('aheadzen_portfolio_widget');
}

?>