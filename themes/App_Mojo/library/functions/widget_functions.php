<?php

/********************************************************
TITLE WIDGET
********************************************************/
$title_font_size_arr = array(
						'hugefonts' => 	get_template_directory_uri().'/images/icons/font_huge.png',
						'largefonts' => get_template_directory_uri().'/images/icons/font_large.png',
						'mediumfonts' =>get_template_directory_uri().'/images/icons/font_medium.png',
						'normalfonts' =>get_template_directory_uri().'/images/icons/font-normal.png',
						'smallfonts' =>	get_template_directory_uri().'/images/icons/font-small.png',
					);

$title_text_align_arr = array(
						'leftalign' => 		get_template_directory_uri().'/images/icons/align_left.png',
						'centeralign' =>	get_template_directory_uri().'/images/icons/align_center.png',
						'rightalign' => 	get_template_directory_uri().'/images/icons/align_right.png',
					);



if(!class_exists('aheadzen_content_title_widget')){
	class aheadzen_content_title_widget extends WP_Widget {
		function aheadzen_content_title_widget() {
		//Constructor
			$widget_ops = array('classname' => 'aheadzen_title', 'description' =>__('Main Title widget','aheadzen'));		
			$this->WP_Widget('aheadzen_title',__('my: Main Title','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? 'Title Here' : $instance['title'];
			$align = empty($instance['align']) ? '' : $instance['align'];
			$hide = empty($instance['hide']) ? '' : $instance['hide'];
			$arr_find = array(' ','&','`','~','!','@','#','$','%','^','*','(',')','=','+','<','>','?','\\','|','/','\'','"','{','}','[',']',':',';');
			$arr_replace = array('','-','','','','','','','','','','','','','','','','','','','','','','','','','','','');
			$title_id = str_replace($arr_find,$arr_replace,$title);
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
			}
			
			if($hide){
			?>
			<div id="<?php echo $title_id;?>" style="clear: both;width: 100%;">
			<p>&nbsp;</p>
			</div>
			<?php
			}else{
			//echo str_replace('<div class="content-main"><div class="container">','',$before_widget);
			echo str_replace('container','',$before_widget);
			?>			
			<div id="<?php echo $title_id;?>"  class="main-title">
				<div class="container">
					<h2 <?php echo aheadzen_inline_edit_code($this->get_field_id('title'));?> class="<?php echo $align;?>"><?php echo $title;?></h2>
				</div>
			</div>
			<?php aheadzen_inline_head_tinymce($this->get_field_id('title'));
			
			//echo str_replace('</div></div>','',$after_widget);
			echo $after_widget;			
			}			
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;		
			return $new_instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array() );		
			$title = ($instance['title']);
			$align = ($instance['align']);
			$hide = ($instance['hide']);
			
			
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />	
	</label></p>	
	
	<?php 
	aheadzen_title_text_align_dl_fun($this->get_field_id('align'),$this->get_field_name('align'),$align);
	?>
   
   <p><label for="<?php  echo $this->get_field_id('hide'); ?>">
	<input class="widefat" id="<?php  echo $this->get_field_id('hide'); ?>" name="<?php echo $this->get_field_name('hide'); ?>" type="checkbox" value="1" <?php if($hide){echo 'checked';}?>  />
	<?php _e('Do you want to hide title?','aheadzen');?>	
	</label>
	<br><small><?php _e('To get the Custom menu tab settings only.','aheadzen');?></small>
	</p> 
	
	<a class="widget-control-remove" href="#<?php  echo $this->get_field_id(''); ?>">Delete</a>
	<?php
	}}
	register_widget('aheadzen_content_title_widget');
}


/********************************************************
PURCHASE NOW WIDGET
********************************************************/
if(!class_exists('aheadzen_purchase_now_widget')){
	class aheadzen_purchase_now_widget extends WP_Widget {
		function aheadzen_purchase_now_widget() {
		//Constructor
			$widget_ops = array('classname' => 'aheadzen_purchase_now', 'description' =>__('Purchase Now','aheadzen'));		
			$this->WP_Widget('aheadzen_purchase_now',__('my: Purchase Now','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$desc = empty($instance['desc']) ? '' : $instance['desc'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];
			$buttons = empty($instance['buttons']) ? '' : $instance['buttons'];
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($desc==''){$desc='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($buttons==''){$buttons='<a data-delay="100" data-animation="bounceIn" href="#" >Sample Button </a> <a data-delay="100" data-animation="bounceIn" href="#" >Sample Button </a>';}
			}
			$withoutborder = empty($instance['withoutborder']) ? '' : $instance['withoutborder'];
			if($withoutborder)
			{				
				$before_widget = str_replace('content-main','content-main-none',$before_widget);
			}
			echo $before_widget;
			
			?>
			<div class="container">
            <div class="aligncenter welcome">
                <div class="margin35"></div>
                <?php if($title){?><h1 <?php echo aheadzen_inline_edit_code($this->get_field_id('title'));?> class="<?php echo $titlesize;?>"><?php echo $title;?></h1>
				<?php aheadzen_inline_head_tinymce($this->get_field_id('title'));?>
				<?php }?>
                <?php if($desc){?>
				<div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc'));?>><?php echo $desc;?></div>
                <?php aheadzen_inline_tinymce($this->get_field_id('desc'));?>
				<?php }?>
                <div class="margin20"></div>
				 
				<div <?php echo aheadzen_inline_edit_code($this->get_field_id('buttons'));?> class="button_set">
				<?php echo $buttons;?>
				</div>
				<?php aheadzen_inline_tinymce($this->get_field_id('buttons'));?>
				
            </div>
            </div>
			<?php
			echo $after_widget;
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;
			if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['desc'] =  $new_instance['desc'];
			}
			else {
				$instance['desc'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['desc'] ) ) ); // wp_filter_post_kses() expects slashed
			}
			return $new_instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array() );		
			$title = ($instance['title']);
			$titlesize = ($instance['titlesize']);
			$desc = ($instance['desc']);
			$buttons = ($instance['buttons']);
			
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />	
	</label></p>
	
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize'),$this->get_field_name('titlesize'),$titlesize);
	?>
	
	<p><label for="<?php  echo $this->get_field_id('withoutborder'); ?>">
	<input class="widefat" id="<?php  echo $this->get_field_id('withoutborder'); ?>" name="<?php echo $this->get_field_name('withoutborder'); ?>" type="checkbox" value="1" <?php if($withoutborder){echo 'checked';}?>  />
	<?php _e('Show Data without borders (simple inner html only)?','aheadzen');?>	
	</label></p>
	
    <p><label for="<?php  echo $this->get_field_id('desc'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo ($desc); ?></textarea> 
	</label></p>
    
	<p><label for="<?php  echo $this->get_field_id('buttons'); ?>"><?php _e('Button Links','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('buttons'); ?>" name="<?php echo $this->get_field_name('buttons'); ?>"><?php echo esc_attr($buttons); ?></textarea> 
	<small><?php _e('eg:<br /> &lt;a data-delay="100" data-animation="bounceIn" href="#" &gt;Your Button Title &lt;/a&gt;','aheadzen');?></small>
	</label></p>
	
	<?php
	}}
	register_widget('aheadzen_purchase_now_widget');
}



/********************************************************
SERVICES WIDGET
********************************************************/
if(!class_exists('aheadzen_services_widget')){
	class aheadzen_services_widget extends WP_Widget {
		function aheadzen_services_widget() {
		//Constructor
			$widget_ops = array('classname' => 'aheadzen_services', 'description' =>__('Services','aheadzen'));		
			$this->WP_Widget('aheadzen_services',__('my: Services','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];
			$align = empty($instance['align']) ? '' : $instance['align'];
			
			$icon1 = empty($instance['icon1']) ? 'icon-laptop' : $instance['icon1'];
			$title1 = empty($instance['title1']) ? '' : $instance['title1'];
			$titlesize1 = empty($instance['titlesize1']) ? '' : $instance['titlesize1'];
			$desc1 = empty($instance['desc1']) ? '' : $instance['desc1'];
			
			$icon2 = empty($instance['icon2']) ? 'icon-laptop' : $instance['icon2'];
			$title2 = empty($instance['title2']) ? '' : $instance['title2'];
			$titlesize2 = empty($instance['titlesize2']) ? '' : $instance['titlesize2'];
			$desc2 = empty($instance['desc2']) ? '' : $instance['desc2'];
			
			$icon3 = empty($instance['icon3']) ? 'icon-magic' : $instance['icon3'];
			$title3 = empty($instance['title3']) ? '' : $instance['title3'];
			$titlesize3 = empty($instance['titlesize3']) ? '' : $instance['titlesize3'];
			$desc3 = empty($instance['desc3']) ? '' : $instance['desc3'];
			
			$icon4 = empty($instance['icon4']) ? 'icon-magic' : $instance['icon4'];
			$title4 = empty($instance['title4']) ? '' : $instance['title4'];
			$titlesize4 = empty($instance['titlesize4']) ? '' : $instance['titlesize4'];
			$desc4 = empty($instance['desc4']) ? '' : $instance['desc4'];
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($title1==''){$title1='Edit Sub Title Here';}
				if($title2==''){$title2='Edit Sub Title Here';}
				if($title3==''){$title3='Edit Sub Title Here';}
				if($title4==''){$title4='Edit Sub Title Here';}
				if($desc1==''){$desc1='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc2==''){$desc2='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc3==''){$desc3='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc4==''){$desc4='Hello this is sample content for you. Your description for the content are can be editable from here.';}
			}
			
			$withoutborder = empty($instance['withoutborder']) ? '' : $instance['withoutborder'];
			if($withoutborder)
			{				
				$before_widget = str_replace('content-main','content-main-none',$before_widget);
			}
			echo $before_widget;
			?>
            <?php
			if($title1 && $title2 && $title3 && $title4)
			{
				$class1 = 'one-fourth ';
				$class2 = 'one-fourth ';
				$class3 = 'one-fourth ';
				$class4 = 'one-fourth last';
			}elseif(($title1 && $title2 && $title3 && $title4=='') || ($title1 && $title2 && $title3=='' && $title4) || ($title1 && $title2=='' && $title3 && $title4) || ($title1=='' && $title2 && $title3 && $title4))
			{
				$class1 = 'one-third ';
				$class2 = 'one-third ';
				$class3 = 'one-third ';
				$class4 = 'one-third ';
				if(($title1 && $title2 && $title3 && $title4=='')){$class3 .='last';}
				if(($title1 && $title2 && $title3=='' && $title4) || ($title1 && $title2=='' && $title3 && $title4) || ($title1=='' && $title2 && $title3 && $title4)){$class4 .='last';}
			}elseif(($title1 && $title2 && $title3=='' && $title4=='') || ($title1 && $title2=='' && $title3 && $title4=='') || ($title1 && $title2=='' && $title3=='' && $title4) || ($title1=='' && $title2 && $title3 && $title4=='') || ($title1=='' && $title2 && $title3=='' && $title4) || ($title1=='' && $title2=='' && $title3 && $title4))
			{
				$class1 = 'one-half ';
				$class2 = 'one-half ';
				$class3 = 'one-half ';
				$class4 = 'one-half ';
				if(($title1 && $title2 && $title3=='' && $title4=='')){$class2 .='last';}
				if(($title1 && $title2=='' && $title3 && $title4=='') || ($title1=='' && $title2 && $title3 && $title4=='')){$class3 .='last';}
				if(($title1 && $title2=='' && $title3=='' && $title4) || ($title1=='' && $title2 && $title3=='' && $title4) || ($title1=='' && $title2=='' && $title3 && $title4)){$class4 .='last';}
			}elseif(($title1=='' && $title2=='' && $title3=='' && $title4) || ($title1=='' && $title2=='' && $title3 && $title4=='') || ($title1=='' && $title2 && $title3=='' && $title4=='') || ($title1 && $title2=='' && $title3=='' && $title4==''))
			{
				$class1 = 'last ';
				$class2 = 'last ';
				$class3 = 'last ';
				$class4 = 'last ';
			}
			?>
			<?php if($title){?>
            <h2  class="border-title <?php echo $titlesize.' '.$align;?>"><font <?php echo aheadzen_inline_edit_code($this->get_field_id('title'));?>><?php echo $title;?></font><span></span></h2>
			<div class="clear"></div>
			<?php aheadzen_inline_head_tinymce($this->get_field_id('title'));?>
            <?php }?>
			<?php if($title1 || $desc1){?>
			<div class="<?php echo $class1;?> column no-space">
                    <div class="service">
                        <?php if($icon1){?>
						<span class="<?php echo $icon1;?> animate" data-animation="rollIn" data-delay="100"></span>
						<?php aheadzen_inline_iconset($this->get_field_id('icon1'));?>
						<?php }?>
                        <div class="margin20"></div>
                         <?php if($title1){?><h4 <?php echo aheadzen_inline_edit_code($this->get_field_id('title1'));?> class="<?php echo $titlesize1;?>"><?php echo $title1;?></h4>
						<?php aheadzen_inline_head_tinymce($this->get_field_id('title1'));?> 
						 <?php }?>
						 <br />
                        <div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc1'));?>><?php echo $desc1;?></div>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc1'));?>
                    </div>
                </div>
			<?php }?>
			<?php if($title2  || $desc2){?>
            <div class="<?php echo $class2;?> column no-space">
                <div class="service">
                    <?php if($icon2){?><span class="<?php echo $icon2;?> special animate" data-animation="rollIn" data-delay="300"></span>
					<?php aheadzen_inline_iconset($this->get_field_id('icon2'));?>
					<?php }?>
                    <div class="margin20"></div>
                    <?php if($title2){?><h4 <?php echo aheadzen_inline_edit_code($this->get_field_id('title2'));?> class="<?php echo $titlesize2;?>"><?php echo $title2;?></h4>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title2'));?>
					<?php }?>
					<br />
                    <div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc2'));?>><?php echo $desc2;?></div>
					<?php aheadzen_inline_tinymce($this->get_field_id('desc2'));?>
                </div>
            </div>
			<?php }?>
			<?php if($title3  || $desc3){?>
            <div class="<?php echo $class3;?> column no-space">
                <div class="service">
                    <?php if($icon3){?><span class="<?php echo $icon3;?> special animate" data-animation="rollIn" data-delay="500"></span>
					<?php aheadzen_inline_iconset($this->get_field_id('icon3'));?>
					<?php }?>
                    <div class="margin20"></div>
                    <?php if($title3){?><h4 <?php echo aheadzen_inline_edit_code($this->get_field_id('title3'));?> class="<?php echo $titlesize3;?>"><?php echo $title3;?></h4>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title3'));?>
					<?php }?>
                    <br />
					<div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc3'));?>><?php echo $desc3;?></div>
					<?php aheadzen_inline_tinymce($this->get_field_id('desc3'));?>
                </div>
            </div>
			<?php }?>
			<?php if($title4 || $desc4){?>
            <div class="<?php echo $class4;?> column no-space last">
                <div class="service">
                    <?php if($icon4){?><span class="<?php echo $icon4;?> special animate" data-animation="rollIn" data-delay="700"></span>
					<?php aheadzen_inline_iconset($this->get_field_id('icon4'));?>
					<?php }?>
                    <div class="margin20"></div>
                    <?php if($title4){?><h4 <?php echo aheadzen_inline_edit_code($this->get_field_id('title4'));?> class="<?php echo $titlesize4;?>"><?php echo $title4;?></h4>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title4'));?>
					<?php }?>
					<br />
                    <div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc4'));?>><?php echo $desc4;?></div>
					<?php aheadzen_inline_tinymce($this->get_field_id('desc4'));?>
                </div>
            </div>
			<?php }?>
			
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
			$title = ($instance['title']);
			$titlesize = strip_tags($instance['titlesize']);
			$align = strip_tags($instance['align']);
			
			$icon1 = ($instance['icon1']);
			$title1 = ($instance['title1']);
			$titlesize1 = ($instance['titlesize1']);
			$desc1 = ($instance['desc1']);
			
			$icon2 = ($instance['icon2']);
			$title2 = ($instance['title2']);
			$titlesize2 = ($instance['titlesize2']);
			$desc2 = ($instance['desc2']);
			
			$icon3 = ($instance['icon3']);
			$title3 = ($instance['title3']);
			$titlesize3 = ($instance['titlesize3']);
			$desc3 = ($instance['desc3']);
			
			$icon4 = ($instance['icon4']);
			$title4 = ($instance['title4']);
			$titlesize4 = ($instance['titlesize4']);
			$desc4 = ($instance['desc4']);
			
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($title1==''){$title1='Edit Sub Title Here';}
				if($title2==''){$title2='Edit Sub Title Here';}
				if($title3==''){$title3='Edit Sub Title Here';}
				if($title4==''){$title4='Edit Sub Title Here';}
				if($desc1==''){$desc1='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc2==''){$desc2='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc3==''){$desc3='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc4==''){$desc4='Hello this is sample content for you. Your description for the content are can be editable from here.';}
			}
			
			$withoutborder = ($instance['withoutborder']);

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
	
    <h2><?php _e('Service 1 Content','aheadzen');?></h2>
    <p><label for="<?php  echo $this->get_field_id('icon1'); ?>"><?php _e('Select Icon','aheadzen');?>: 
    
	<?php aheadzen_widget_iconset($this->get_field_id('icon1'),$this->get_field_name('icon1'),$icon1);?>
	
   </label></p>
    
     <p><label for="<?php  echo $this->get_field_id('title1'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo esc_attr($title1); ?>" />	
	</label></p>
    
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize1'),$this->get_field_name('titlesize1'),$titlesize1);
	?>
	
    <p><label for="<?php  echo $this->get_field_id('desc1'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo esc_attr($desc1); ?></textarea> 
	</label></p>
    
    
     <h2><?php _e('Service 2 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('icon2'); ?>"><?php _e('Select Icon','aheadzen');?>: 
	<?php aheadzen_widget_iconset($this->get_field_id('icon2'),$this->get_field_name('icon2'),$icon2);?>
   </label></p>
    
     <p><label for="<?php  echo $this->get_field_id('title2'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo esc_attr($title2); ?>" />	
	</label></p>
    
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize2'),$this->get_field_name('titlesize2'),$titlesize2);
	?>
   
    <p><label for="<?php  echo $this->get_field_id('desc2'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc2'); ?>" name="<?php echo $this->get_field_name('desc2'); ?>"><?php echo esc_attr($desc2); ?></textarea> 
	</label></p>
    
    
    <h2><?php _e('Service 3 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('icon3'); ?>"><?php _e('Select Icon','aheadzen');?>: 
   <?php aheadzen_widget_iconset($this->get_field_id('icon3'),$this->get_field_name('icon3'),$icon3);?>
   </label></p>
    
     <p><label for="<?php  echo $this->get_field_id('title3'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" type="text" value="<?php echo esc_attr($title3); ?>" />	
	</label></p>
    
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize3'),$this->get_field_name('titlesize3'),$titlesize3);
	?>
   
    <p><label for="<?php  echo $this->get_field_id('desc3'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc3'); ?>" name="<?php echo $this->get_field_name('desc3'); ?>"><?php echo esc_attr($desc3); ?></textarea> 
	</label></p>
    
    
    <h2><?php _e('Service 4 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('icon4'); ?>"><?php _e('Select Icon','aheadzen');?>: 
    <?php aheadzen_widget_iconset($this->get_field_id('icon4'),$this->get_field_name('icon4'),$icon4);?>
   </label></p>
    
     <p><label for="<?php  echo $this->get_field_id('title4'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title4'); ?>" name="<?php echo $this->get_field_name('title4'); ?>" type="text" value="<?php echo esc_attr($title4); ?>" />	
	</label></p>
    
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize4'),$this->get_field_name('titlesize4'),$titlesize4);
	?>
   
    <p><label for="<?php  echo $this->get_field_id('desc4'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc4'); ?>" name="<?php echo $this->get_field_name('desc4'); ?>"><?php echo esc_attr($desc4); ?></textarea> 
	</label></p>
    
   	<?php
	}}
	register_widget('aheadzen_services_widget');
}

/********************************************************
FEATURES 1 WIDGET
********************************************************/
if(!class_exists('aheadzen_features1_widget')){
	class aheadzen_features1_widget extends WP_Widget {
		function aheadzen_features1_widget() {
		//Constructor
			$widget_ops = array('classname' => 'features1', 'description' =>__('Features Type 1','aheadzen'));		
			$this->WP_Widget('features1',__('my: Features Type 1','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];
			$align = empty($instance['align']) ? '' : $instance['align'];
			
			$mimg = empty($instance['mimg']) ? '' : $instance['mimg'];
			$mpos = empty($instance['mpos']) ? 'left' : $instance['mpos'];

			$icon1 = empty($instance['icon1']) ? 'icon-one' : $instance['icon1'];
			$title1 = empty($instance['title1']) ? '' : $instance['title1'];
			$titlesize1 = empty($instance['titlesize1']) ? '' : $instance['titlesize1'];
			$desc1 = empty($instance['desc1']) ? '' : $instance['desc1'];
			
			$icon2 = empty($instance['icon2']) ? 'icon-two' : $instance['icon2'];
			$title2 = empty($instance['title2']) ? '' : $instance['title2'];
			$titlesize2 = empty($instance['titlesize2']) ? '' : $instance['titlesize2'];
			$desc2 = empty($instance['desc2']) ? '' : $instance['desc2'];
			
			$icon3 = empty($instance['icon3']) ? 'icon-three' : $instance['icon3'];
			$title3 = empty($instance['title3']) ? '' : $instance['title3'];
			$titlesize3 = empty($instance['titlesize3']) ? '' : $instance['titlesize3'];
			$desc3 = empty($instance['desc3']) ? '' : $instance['desc3'];
			
			$icon4 = empty($instance['icon4']) ? 'icon-three' : $instance['icon4'];
			$title4 = empty($instance['title4']) ? '' : $instance['title4'];
			$titlesize4 = empty($instance['titlesize4']) ? '' : $instance['titlesize4'];
			$desc4 = empty($instance['desc4']) ? '' : $instance['desc4'];
			
			
			$mimg_arr = aheadzen_get_image_name_attchment_id($mimg);
			$mimg=$mimg_arr[0];
			$attachment_id=$mimg_arr[1];
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($mimg==''){$mimg = get_template_directory_uri().'/images/mobile-two.png';}
				if($title1==''){$title1='Edit Sub Title Here';}
				if($title2==''){$title2='Edit Sub Title Here';}
				if($title3==''){$title3='Edit Sub Title Here';}
				if($title4==''){$title4='Edit Sub Title Here';}
				if($desc1==''){$desc1='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc2==''){$desc2='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc3==''){$desc3='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc4==''){$desc4='Hello this is sample content for you. Your description for the content are can be editable from here.';}
			}
			
			$withoutborder = empty($instance['withoutborder']) ? '' : $instance['withoutborder'];
			if($withoutborder)
			{				
				$before_widget = str_replace('content-main','content-main-none',$before_widget);
			}
			echo $before_widget;
			?>
            <?php if($title){?>
            <h2 class="border-title <?php echo $titlesize.' '.$align;?>"><font <?php echo aheadzen_inline_edit_code($this->get_field_id('title'));?>><?php echo $title;?></font><span></span></h2>
            <div class="margin15"></div>
			<?php aheadzen_inline_head_tinymce($this->get_field_id('title'));?>
            <?php }?>		
			<?php if($mpos=='left'){?>
			<?php if($mimg){?>
			<div class="one-half column">
                    <img <?php echo aheadzen_inline_edit_code($this->get_field_id('mimg'));?> src="<?php echo $mimg;?>" alt="" title="" class="aligncenter rollImage animate" data-animation="fadeInLeft" />
                </div>
				<?php
				if($mimg && $attachment_id==''){
					$attachment_id = aheadzen_get_attachment_id($mimg);
				}
				aheadzen_inline_image($this->get_field_id('mimg'),$attachment_id);
				}?>
                <div class="one-half column last">
					<?php if($title1 || $desc1){?>
                    <div class="custom-services">
                        <span class="icons <?php echo $icon1;?> animate" data-animation="bounceIn"></span>
						<?php aheadzen_inline_iconset($this->get_field_id('icon1'));?>
                        <?php if($title1){?><h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title1'));?> class="<?php echo $titlesize1;?>"><?php echo $title1;?></h3>
						<?php aheadzen_inline_head_tinymce($this->get_field_id('title1'));?>
						<?php }?>
                        <?php if($desc1){?><div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc1'));?>><?php echo $desc1;?></div>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc1'));?>
						<?php }?>
                    </div>
                    <div class="margin35"></div>
					<?php }?>
					<?php if($title2 || $desc2){?>
                    <div class="custom-services">
                        <span class="icons <?php echo $icon2;?> animate" data-animation="bounceIn"></span>
						<?php aheadzen_inline_iconset($this->get_field_id('icon2'));?>
                        <?php if($title2){?><h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title2'));?> class="<?php echo $titlesize2;?>"><?php echo $title2;?></h3>
						<?php aheadzen_inline_head_tinymce($this->get_field_id('title2'));?>
						<?php }?>
                        <?php if($desc2){?><div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc2'));?>><?php echo $desc2;?></div>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc2'));?>
						<?php }?>
                    </div>
                    <div class="margin35"></div>
					<?php }?>
					<?php if($title3  || $desc3){?>
                    <div class="custom-services">
                        <span class="icons <?php echo $icon3;?> animate" data-animation="bounceIn"></span>
						<?php aheadzen_inline_iconset($this->get_field_id('icon3'));?>
                        <?php if($title3){?><h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title3'));?> class="<?php echo $titlesize3;?>"><?php echo $title3;?></h3>
						<?php aheadzen_inline_head_tinymce($this->get_field_id('title3'));?>
						<?php }?>
                        <?php if($desc3){?><div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc3'));?>><?php echo $desc3;?></div>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc3'));?>
						<?php }?>
                    </div>
					<?php }?>
					<?php if($title4 || $desc4){?>
                    <div class="custom-services">
                        <span class="icons <?php echo $icon4;?> animate" data-animation="bounceIn"></span>
						<?php aheadzen_inline_iconset($this->get_field_id('icon4'));?>
                        <?php if($title4){?><h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title4'));?> class="<?php echo $titlesize4;?>"><?php echo $title4;?></h3>
						<?php aheadzen_inline_head_tinymce($this->get_field_id('title4'));?>
						<?php }?>
                        <?php if($desc4){?><div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc4'));?>><?php echo $desc4;?></div>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc4'));?>
						<?php }?>
                    </div>
					<?php }?>
                </div>
			<?php
			}else{
			?>
			    <div class="one-half column">
                     <?php if($title1){?>
                    <div class="custom-services">
                        <span class="icons <?php echo $icon1;?> animate" data-animation="bounceIn"></span>
						<?php aheadzen_inline_iconset($this->get_field_id('icon1'));?>
                        <h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title1'));?>><?php echo $title1;?></h3>
						<?php aheadzen_inline_head_tinymce($this->get_field_id('title1'));?>
                        <div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc1'));?>><?php echo $desc1;?></div>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc1'));?>
                    </div>
                    <div class="margin35"></div>
					<?php }?>
					<?php if($title2){?>
                    <div class="custom-services">
                        <span class="icons <?php echo $icon2;?> animate" data-animation="bounceIn"></span>
						<?php aheadzen_inline_iconset($this->get_field_id('icon2'));?>
                        <h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title2'));?>><?php echo $title2;?></h3>
						<?php aheadzen_inline_head_tinymce($this->get_field_id('title2'));?>
                        <div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc2'));?>><?php echo $desc2;?></div>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc2'));?>
                    </div>
                    <div class="margin35"></div>
					<?php }?>
					<?php if($title3){?>
                    <div class="custom-services">
                        <span class="icons <?php echo $icon3;?> animate" data-animation="bounceIn"></span>
						<?php aheadzen_inline_iconset($this->get_field_id('icon3'));?>
                        <h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title3'));?>><?php echo $title3;?></h3>
						<?php aheadzen_inline_head_tinymce($this->get_field_id('title3'));?>
                        <div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc3'));?>><?php echo $desc3;?></div>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc3'));?>
                    </div>
					<div class="margin35"></div>
					<?php }?>
					<?php if($title4){?>
                    <div class="custom-services">
                        <span class="icons <?php echo $icon4;?> animate" data-animation="bounceIn"></span>
						<?php aheadzen_inline_iconset($this->get_field_id('icon4'));?>
                        <h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title4'));?>><?php echo $title4;?></h3>
						<?php aheadzen_inline_head_tinymce($this->get_field_id('title4'));?>
                        <div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc4'));?>><?php echo $desc4;?></div>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc4'));?>
                    </div>
					<?php }?>
                </div>
				<?php if($mimg){?>
				<div class="one-half column last">
                    <img <?php echo aheadzen_inline_edit_code($this->get_field_id('mimg'));?> src="<?php echo $mimg;?>" alt="" title="" class="aligncenter rollImage animate" data-animation="fadeInLeft" />
                </div>
				<?php
				if($mimg && $attachment_id==''){
					$attachment_id = aheadzen_get_attachment_id($mimg);
				}
				aheadzen_inline_image($this->get_field_id('mimg'),$attachment_id);
				}?>
			<?php			
			}?>
			
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
			$title = ($instance['title']);
			$titlesize = strip_tags($instance['titlesize']);
			$align = strip_tags($instance['align']);
			
			$mimg = ($instance['mimg']);
			$mpos = ($instance['mpos']);
			
			$icon1 = ($instance['icon1']);
			$title1 = ($instance['title1']);
			$titlesize1 = ($instance['titlesize1']);
			$desc1 = ($instance['desc1']);
			
			$icon2 = ($instance['icon2']);
			$title2 = ($instance['title2']);
			$titlesize2 = ($instance['titlesize2']);
			$desc2 = ($instance['desc2']);
			
			$icon3 = ($instance['icon3']);
			$title3 = ($instance['title3']);
			$titlesize3 = ($instance['titlesize3']);
			$desc3 = ($instance['desc3']);
			
			$icon4 = ($instance['icon4']);
			$title4 = ($instance['title4']);
			$titlesize4 = ($instance['titlesize4']);
			$desc4 = ($instance['desc4']);
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($title1==''){$title1='Edit Sub Title Here';}
				if($title2==''){$title2='Edit Sub Title Here';}
				if($title3==''){$title3='Edit Sub Title Here';}
				if($title4==''){$title4='Edit Sub Title Here';}
				if($desc1==''){$desc1='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc2==''){$desc2='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc3==''){$desc3='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc4==''){$desc4='Hello this is sample content for you. Your description for the content are can be editable from here.';}
			}
			
			$withoutborder = ($instance['withoutborder']);
			
			$mpos_arr = array(
						'left'	=> get_template_directory_uri().'/images/icons/align_left.png',
						'right'	=> get_template_directory_uri().'/images/icons/align_right.png',
						);
		
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
	<?php
	aheadzen_title_image_select_dl_fun($this->get_field_id('mimg'),$this->get_field_name('mimg'),$mimg,__('Main Image','aheadzen'));
	?>	
	
    <p><label for="<?php  echo $this->get_field_id('mpos'); ?>"><?php _e('Display Image on','aheadzen');?>: 
    </label>
	<div class="clearboth"></div>
	<style>
	.myselected{border:solid 2px red;}
	.left.leftalign {display: inline-block;height: 35px;width: 35px;text-align: center;background-position: center bottom;background-repeat: no-repeat;}
	.right.rightalign {display: inline-block;height: 35px;width: 35px;text-align: center;background-position: center bottom;background-repeat: no-repeat;}
	</style>
	<script>
	function set_selection_img_align(val,hidden_id)
	{
		jQuery('#'+hidden_id).val(val);
		jQuery('.option_'+hidden_id).removeClass( "myselected" );
		jQuery('.option_'+hidden_id+'.'+val).addClass( "myselected" );		
	}
	</script>
	<input class="widefat" id="<?php  echo $this->get_field_id('mpos'); ?>" name="<?php echo $this->get_field_name('mpos'); ?>" type="hidden" value="<?php echo esc_attr($mpos); ?>" />
	
	<?php foreach($mpos_arr as $key=>$val){?>
    <label onclick="set_selection_img_align('<?php echo $key;?>','<?php echo $this->get_field_id('mpos'); ?>')" class="<?php echo 'option_'.$this->get_field_id('mpos'); ?> <?php echo $key;?> <?php echo $key.'align';?> <?php if($mpos==$key){echo 'myselected';}?>" style="background-image: url('<?php echo $val;?>');">
	</label>
	<?php }?>
   </p>
    
    <h2><?php _e('Feature 1 Content','aheadzen');?></h2>
    <p><label for="<?php  echo $this->get_field_id('icon1'); ?>"><?php _e('Select Icon','aheadzen');?>: 
    <?php aheadzen_widget_iconset($this->get_field_id('icon1'),$this->get_field_name('icon1'),$icon1);?>
   </label></p>
    
     <p><label for="<?php  echo $this->get_field_id('title1'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo esc_attr($title1); ?>" />	
	</label>
	<br><small><?php _e('keep blank to hide the complete section.','aheadzen');?></small>
	</p>
    
	 <?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize1'),$this->get_field_name('titlesize1'),$titlesize1);
	?>
   
    <p><label for="<?php  echo $this->get_field_id('desc1'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo esc_attr($desc1); ?></textarea> 
	</label></p>
    
    
     <h2><?php _e('Feature 2 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('icon2'); ?>"><?php _e('Select Icon','aheadzen');?>: 
    <?php aheadzen_widget_iconset($this->get_field_id('icon2'),$this->get_field_name('icon2'),$icon2);?>
   </label></p>
    
     <p><label for="<?php  echo $this->get_field_id('title2'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo esc_attr($title2); ?>" />	
	</label>
	<br><small><?php _e('keep blank to hide the complete section.','aheadzen');?></small>
	</p>
    
	
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize2'),$this->get_field_name('titlesize2'),$titlesize2);
	?>
   
    <p><label for="<?php  echo $this->get_field_id('desc2'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc2'); ?>" name="<?php echo $this->get_field_name('desc2'); ?>"><?php echo esc_attr($desc2); ?></textarea> 
	</label></p>
    
    
    <h2><?php _e('Feature 3 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('icon3'); ?>"><?php _e('Select Icon','aheadzen');?>: 
    <?php aheadzen_widget_iconset($this->get_field_id('icon3'),$this->get_field_name('icon3'),$icon3);?>
   </label></p>
    
     <p><label for="<?php  echo $this->get_field_id('title3'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" type="text" value="<?php echo esc_attr($title3); ?>" />	
	</label>
	<br><small><?php _e('keep blank to hide the complete section.','aheadzen');?></small>
	</p>
    
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize3'),$this->get_field_name('titlesize3'),$titlesize3);
	?>
	
    <p><label for="<?php  echo $this->get_field_id('desc3'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc3'); ?>" name="<?php echo $this->get_field_name('desc3'); ?>"><?php echo esc_attr($desc3); ?></textarea> 
	</label></p>
	
	<h2><?php _e('Feature 4 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('icon4'); ?>"><?php _e('Select Icon','aheadzen');?>: 
    <?php aheadzen_widget_iconset($this->get_field_id('icon4'),$this->get_field_name('icon4'),$icon4);?>
   </label></p>
    
     <p><label for="<?php  echo $this->get_field_id('title4'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title4'); ?>" name="<?php echo $this->get_field_name('title4'); ?>" type="text" value="<?php echo esc_attr($title4); ?>" />	
	</label>
	<br><small><?php _e('keep blank to hide the complete section.','aheadzen');?></small>
	</p>
    
	 <?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize4'),$this->get_field_name('titlesize4'),$titlesize4);
	?>
   
    <p><label for="<?php  echo $this->get_field_id('desc4'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc4'); ?>" name="<?php echo $this->get_field_name('desc4'); ?>"><?php echo esc_attr($desc4); ?></textarea> 
	</label></p>
    
    
    
   	<?php
	}}
	register_widget('aheadzen_features1_widget');

}	
	

/********************************************************
FEATURES 2 WIDGET
********************************************************/
if(!class_exists('aheadzen_features2_widget')){
	class aheadzen_features2_widget extends WP_Widget {
		function aheadzen_features2_widget() {
		//Constructor
			$widget_ops = array('classname' => 'features2', 'description' =>__('Features Type 2','aheadzen'));		
			$this->WP_Widget('features2',__('my: Features Type 2','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];
			$align = empty($instance['align']) ? '' : $instance['align'];
			
			$icon1 = empty($instance['icon1']) ? 'icon-one' : $instance['icon1'];
			$title1 = empty($instance['title1']) ? '' : $instance['title1'];
			$titlesize1 = empty($instance['titlesize1']) ? '' : $instance['titlesize1'];
			$desc1 = empty($instance['desc1']) ? '' : $instance['desc1'];
			$image1 = empty($instance['image1']) ? '' : $instance['image1'];
			
			$attachment_id1=$attachment_id2=$attachment_id3='';
			
			$mimg_arr1 = aheadzen_get_image_name_attchment_id($image1);
			$image1=$mimg_arr1[0];
			$attachment_id1=$mimg_arr1[1];
			
			$icon2 = empty($instance['icon2']) ? 'icon-two' : $instance['icon2'];
			$title2 = empty($instance['title2']) ? '' : $instance['title2'];
			$titlesize2 = empty($instance['titlesize2']) ? '' : $instance['titlesize2'];
			$desc2 = empty($instance['desc2']) ? '' : $instance['desc2'];
			$image2 = empty($instance['image2']) ? '' : $instance['image2'];
			$mimg_arr2 = aheadzen_get_image_name_attchment_id($image2);
			$image2=$mimg_arr2[0];
			$attachment_id2=$mimg_arr2[1];
			
			$icon3 = empty($instance['icon3']) ? 'icon-three' : $instance['icon3'];
			$title3 = empty($instance['title3']) ? '' : $instance['title3'];
			$titlesize3 = empty($instance['titlesize3']) ? '' : $instance['titlesize3'];
			$desc3 = empty($instance['desc3']) ? '' : $instance['desc3'];
			$image3 = empty($instance['image3']) ? '' : $instance['image3'];
			$mimg_arr3 = aheadzen_get_image_name_attchment_id($image3);
			$image3=$mimg_arr3[0];
			$attachment_id3=$mimg_arr3[1];
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($image1==''){$image1 = get_template_directory_uri().'/images/bar-chart.png';}
				if($image2==''){$image2 = get_template_directory_uri().'/images/bar-chart.png';}
				if($image3==''){$image3 = get_template_directory_uri().'/images/bar-chart.png';}
				if($title1==''){$title1='Edit Sub Title Here';}
				if($title2==''){$title2='Edit Sub Title Here';}
				if($title3==''){$title3='Edit Sub Title Here';}
				if($desc1==''){$desc1='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc2==''){$desc2='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc3==''){$desc3='Hello this is sample content for you. Your description for the content are can be editable from here.';}
			}
			
			$withoutborder = empty($instance['withoutborder']) ? '' : $instance['withoutborder'];
			if($withoutborder)
			{				
				$before_widget = str_replace('content-main','content-main-none',$before_widget);
			}
			echo $before_widget;
			?>
            <?php if($title){?>
            <h2 class="border-title <?php echo $titlesize.' '.$align;?>"><font <?php echo aheadzen_inline_edit_code($this->get_field_id('title'));?>><?php echo $title;?></font><span></span></h2>
            <div class="margin15"></div>
            <?php aheadzen_inline_head_tinymce($this->get_field_id('title'));?>
			<?php }?>
			<?php
			$first = 0;
			$second = 0;
			$third = 0;
			if($title1 || $desc1 || $image1)
			{
				$first = 1;
			}
			if($title1 || $desc1 || $image2)
			{
				$second = 1;
			}
			if($title1 || $desc1 || $image3)
			{
				$third = 1;
			}
			if($first && $second && $third)
			{
				$class1 = 'one-third ';
				$class2 = 'one-third ';
				$class3 = 'one-third last';
			}elseif(($first && $second && $third=='') || ($first && $second=='' && $third) || ($first=='' && $second && $third))
			{
				$class1 = 'one-half ';
				$class2 = 'one-half ';
				$class3 = 'one-half ';
				if(($first && $second && $third=='')){$class2 .='last';}
				if(($first && $second=='' && $third) || ($first=='' && $second && $third)){$class3 .='last';}
				
			}elseif(($first=='' && $second=='' && $third) || ($first=='' && $second && $third=='') || ($first && $second=='' && $third==''))
			{
				$class1 = 'last ';
				$class2 = 'last ';
				$class3 = 'last ';
			}
			?>
			<?php if($first){?>
			<div class="<?php echo $class1;?> column">
				<div class="custom-services" style="<?php if($icon1=='' || $icon1=='select-one'){echo 'padding-left: 0;';}?>">
					<span data-animation="bounceIn" class="icons <?php echo $icon1?> animate bounceIn"></span>
					<?php aheadzen_inline_iconset($this->get_field_id('icon1'));?>
					<?php if($title1){?><h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title1'));?> class="<?php echo $titlesize1;?>"><?php echo $title1;?></h3>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title1'));?>
					<?php }?>
					<?php if($image1){?><div class="featured2_imgdiv"><img <?php echo aheadzen_inline_edit_code($this->get_field_id('image1'));?> class="feature2img" src="<?php echo $image1;?>" alt=""></div>
					<?php aheadzen_inline_image($this->get_field_id('image1'),$attachment_id1); }?>
					
					<div class="feature2desc" <?php echo aheadzen_inline_edit_code($this->get_field_id('desc1'));?>><?php echo $desc1;?></div>
					<?php aheadzen_inline_tinymce($this->get_field_id('desc1'));?>
				</div>
			</div>
			<?php }?>
			<?php if($second){?>
			<div class="<?php echo $class2;?> column">
				<div class="custom-services" style="<?php if($icon2=='' || $icon2=='select-one'){echo 'padding-left: 0;';}?>">
					<span data-animation="bounceIn" class="icons <?php echo $icon2?> animate bounceIn"></span>
					<?php aheadzen_inline_iconset($this->get_field_id('icon2'));?>
					<?php if($title2){?><h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title2'));?> class="<?php echo $titlesize2;?>"><?php echo $title2;?></h3>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title2'));?>
					<?php }?>
					<?php if($image2){?><div class="featured2_imgdiv"><img <?php echo aheadzen_inline_edit_code($this->get_field_id('image2'));?> class="feature2img" src="<?php echo $image2;?>" alt=""></div>
					<?php aheadzen_inline_image($this->get_field_id('image2'),$attachment_id2); }?>
					<div class="feature2desc" <?php echo aheadzen_inline_edit_code($this->get_field_id('desc2'));?>><?php echo $desc2;?></div>
					<?php aheadzen_inline_tinymce($this->get_field_id('desc2'));?>
				</div>
			</div>
			<?php }?>
			<?php if($third){?>
			<div class="<?php echo $class3;?> column ">
				<div class="custom-services" style="<?php if($icon3=='' || $icon3=='select-one'){echo 'padding-left: 0;';}?>">
					<span data-animation="bounceIn" class="icons <?php echo $icon3?> animate bounceIn"></span>
					<?php aheadzen_inline_iconset($this->get_field_id('icon3'));?>
					<?php if($title3){?><h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title3'));?> class="<?php echo $titlesize3;?>"><?php echo $title3;?></h3>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title3'));?>
					<?php }?>
					<?php if($image3){?><div class="featured2_imgdiv"><img <?php echo aheadzen_inline_edit_code($this->get_field_id('image3'));?> class="feature2img" src="<?php echo $image3;?>" alt=""></div>
					<?php aheadzen_inline_image($this->get_field_id('image3'),$attachment_id3); }?>
					<div class="feature2desc" <?php echo aheadzen_inline_edit_code($this->get_field_id('desc3'));?>><?php echo $desc3;?></div>
					<?php aheadzen_inline_tinymce($this->get_field_id('desc3'));?>
				</div>
			</div>
			<?php }?>
			
             <div class="margin15"></div>
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
			$title = ($instance['title']);
			$titlesize = strip_tags($instance['titlesize']);
			$align = strip_tags($instance['align']);
			
			$icon1 = ($instance['icon1']);
			$title1 = ($instance['title1']);
			$titlesize1 = ($instance['titlesize1']);
			$desc1 = ($instance['desc1']);
			$image1 = ($instance['image1']);
			
			$icon2 = ($instance['icon2']);
			$title2 = ($instance['title2']);
			$titlesize2 = ($instance['titlesize2']);
			$desc2 = ($instance['desc2']);
			$image2 = ($instance['image2']);
			
			$icon3 = ($instance['icon3']);
			$title3 = ($instance['title3']);
			$titlesize3 = ($instance['titlesize3']);
			$desc3 = ($instance['desc3']);
			$image3 = ($instance['image3']);
			
			$icon4 = ($instance['icon4']);
			$title4 = ($instance['title4']);
			$titlesize4 = ($instance['titlesize4']);
			$desc4 = ($instance['desc4']);
			
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($title1==''){$title1='Edit Sub Title Here';}
				if($title2==''){$title2='Edit Sub Title Here';}
				if($title3==''){$title3='Edit Sub Title Here';}
				if($title4==''){$title4='Edit Sub Title Here';}
				if($desc1==''){$desc1='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc2==''){$desc2='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc3==''){$desc3='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc4==''){$desc4='Hello this is sample content for you. Your description for the content are can be editable from here.';}
			}
			
			$withoutborder  = ($instance['withoutborder']);
	
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
    
	
	<h2><?php _e('Feature 1 Content','aheadzen');?></h2>
    <p><label for="<?php  echo $this->get_field_id('icon1'); ?>"><?php _e('Select Icon','aheadzen');?>: 
    <?php aheadzen_widget_iconset($this->get_field_id('icon1'),$this->get_field_name('icon1'),$icon1);?>
   </label></p>
    
     <p><label for="<?php  echo $this->get_field_id('title1'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo esc_attr($title1); ?>" />	
	</label>
	<br><small><?php _e('keep blank to hide the complete section.','aheadzen');?></small>
	</p>
    
	 
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize1'),$this->get_field_name('titlesize1'),$titlesize1);
	?>
   
    <p><label for="<?php  echo $this->get_field_id('desc1'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo esc_attr($desc1); ?></textarea> 
	</label></p>
	
	<?php
	aheadzen_title_image_select_dl_fun($this->get_field_id('image1'),$this->get_field_name('image1'),$image1,__('Image URL','aheadzen'));
	?>
	  
    
     <h2><?php _e('Feature 2 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('icon2'); ?>"><?php _e('Select Icon','aheadzen');?>: 
    <?php aheadzen_widget_iconset($this->get_field_id('icon2'),$this->get_field_name('icon2'),$icon2);?>
   </label></p>
    
     <p><label for="<?php  echo $this->get_field_id('title2'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo esc_attr($title2); ?>" />	
	</label>
	<br><small><?php _e('keep blank to hide the complete section.','aheadzen');?></small>
	</p>
    
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize2'),$this->get_field_name('titlesize2'),$titlesize2);
	?>
   
    <p><label for="<?php  echo $this->get_field_id('desc2'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc2'); ?>" name="<?php echo $this->get_field_name('desc2'); ?>"><?php echo esc_attr($desc2); ?></textarea> 
	</label></p>
    
	<?php
	aheadzen_title_image_select_dl_fun($this->get_field_id('image2'),$this->get_field_name('image2'),$image2,__('Image URL','aheadzen'));
	?>
	  
    <h2><?php _e('Feature 3 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('icon3'); ?>"><?php _e('Select Icon','aheadzen');?>: 
    <?php aheadzen_widget_iconset($this->get_field_id('icon3'),$this->get_field_name('icon3'),$icon3);?>
   </label></p>
    
     <p><label for="<?php  echo $this->get_field_id('title3'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" type="text" value="<?php echo esc_attr($title3); ?>" />	
	</label>
	<br><small><?php _e('keep blank to hide the complete section.','aheadzen');?></small>
	</p>
    
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize3'),$this->get_field_name('titlesize3'),$titlesize3);
	?>
   
    <p><label for="<?php  echo $this->get_field_id('desc3'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc3'); ?>" name="<?php echo $this->get_field_name('desc3'); ?>"><?php echo esc_attr($desc3); ?></textarea> 
	</label></p>    
	<?php
	aheadzen_title_image_select_dl_fun($this->get_field_id('image3'),$this->get_field_name('image3'),$image3,__('Image URL','aheadzen'));
	?>
   	<?php
	}}
	register_widget('aheadzen_features2_widget');
}


/********************************************************
PRICE TABLE WIDGET
********************************************************/
if(!class_exists('aheadzen_pricetable_widget')){
	class aheadzen_pricetable_widget extends WP_Widget {
		function aheadzen_pricetable_widget() {
		//Constructor
			$widget_ops = array('classname' => 'pricetable', 'description' =>__('Price Table','aheadzen'));		
			$this->WP_Widget('pricetable',__('my: Price Table','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];
			$align = empty($instance['align']) ? '' : $instance['align'];
			
			$title1 = empty($instance['title1']) ? 'Plan 1' : $instance['title1'];
			$price1 = empty($instance['price1']) ? '0' : $instance['price1'];
			$priceper1 = empty($instance['priceper1']) ? 'Month' : $instance['priceper1'];
			$moneyback1 = empty($instance['moneyback1']) ? '' : $instance['moneyback1'];
			$desc1 = empty($instance['desc1']) ? '' : $instance['desc1'];
			$desc1 = '<li>'.str_replace('<br />','</li><li>',nl2br($desc1)).'</li>';
			$buttontitle1 = empty($instance['buttontitle1']) ? 'Learn More' : $instance['buttontitle1'];
			$buttonlink1 = empty($instance['buttonlink1']) ? '#' : $instance['buttonlink1'];
			$isactive1 = empty($instance['isactive1']) ? '' : 'active';
			
			$title2 = empty($instance['title2']) ? 'Plan 2' : $instance['title2'];
			$price2 = empty($instance['price2']) ? '0' : $instance['price2'];
			$priceper2 = empty($instance['priceper2']) ? 'Month' : $instance['priceper2'];
			$moneyback2 = empty($instance['moneyback2']) ? '' : $instance['moneyback2'];
			$desc2 = empty($instance['desc2']) ? '' : $instance['desc2'];
			$desc2 = '<li>'.str_replace('<br />','</li><li>',nl2br($desc2)).'</li>';
			$buttontitle2 = empty($instance['buttontitle2']) ? 'Learn More' : $instance['buttontitle2'];
			$buttonlink2 = empty($instance['buttonlink2']) ? '#' : $instance['buttonlink2'];
			$isactive2 = empty($instance['isactive2']) ? '' : 'active';
			
			$title3 = empty($instance['title3']) ? 'Plan 3' : $instance['title3'];
			$price3 = empty($instance['price3']) ? '0' : $instance['price3'];
			$priceper3 = empty($instance['priceper3']) ? 'Month' : $instance['priceper3'];
			$moneyback3 = empty($instance['moneyback3']) ? '' : $instance['moneyback3'];
			$desc3 = empty($instance['desc3']) ? '' : $instance['desc3'];
			$desc3 = '<li>'.str_replace('<br />','</li><li>',nl2br($desc3)).'</li>';
			$buttontitle3 = empty($instance['buttontitle3']) ? 'Learn More' : $instance['buttontitle3'];
			$buttonlink3 = empty($instance['buttonlink3']) ? '#' : $instance['buttonlink3'];
			$isactive3 = empty($instance['isactive3']) ? '' : 'active';
			
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($title1==''){$title1='Edit Sub Title Here';}
				if($title2==''){$title2='Edit Sub Title Here';}
				if($title3==''){$title3='Edit Sub Title Here';}
				
				if($price1==''){$price1='$10';}
				if($price2==''){$price2='$20';}
				if($price3==''){$price3='$50';}
				
				if($moneyback1==''){$moneyback1='Change Money Back Gaurantee Content';}
				if($moneyback2==''){$moneyback2='Change Money Back Gaurantee Content';}
				if($moneyback3==''){$moneyback3='Change Money Back Gaurantee Content';}
				
				if($desc1==''){$desc1='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc2==''){$desc2='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc3==''){$desc3='Hello this is sample content for you. Your description for the content are can be editable from here.';}
			}
			
			$withoutborder = empty($instance['withoutborder']) ? '' : $instance['withoutborder'];
			if($withoutborder)
			{				
				$before_widget = str_replace('content-main','content-main-none',$before_widget);
			}
			
			
			if($title1 && $title2 && $title3)
			{
				$class1 = 'one-third ';
				$class2 = 'one-third ';
				$class3 = 'one-third last';
			}elseif(($title1 && $title2 && $title3=='') || ($title1 && $title2=='' && $title3) || ($title1=='' && $title2 && $title3))
			{
				$class1 = 'one-half ';
				$class2 = 'one-half ';
				$class3 = 'one-half ';
				if(($title1 && $title2 && $title3=='')){$class2 .='last';}
				if(($title1 && $title2=='' && $title3) || ($title1=='' && $title2 && $title3)){$class3 .='last';}
				
			}elseif(($title1=='' && $title2=='' && $title3) || ($title1=='' && $title2 && $title3=='') || ($title1 && $title2=='' && $title3==''))
			{
				$class1 = 'last ';
				$class2 = 'last ';
				$class3 = 'last ';
			}
			
			echo $before_widget;
			?>
            <?php if($title){?>
            <h2 class="border-title <?php echo $titlesize.' ' .$align;?>"><font <?php echo aheadzen_inline_edit_code($this->get_field_id('title'));?>><?php echo $title;?></font><span></span></h2>
            <div class="margin15"></div>
            <?php aheadzen_inline_head_tinymce($this->get_field_id('title'));?>
			<?php }?>
			<div class="<?php echo $class1;?> column">
                    <div class="<?php if(aheadzen_is_editing()){ }else{echo 'pr-tb-col';}?> <?php echo $isactive1;?> animate" data-animation="flipInY">
                        <div class="tb-header">
                            <div class="tb-title">
                                <h5 <?php echo aheadzen_inline_edit_code($this->get_field_id('title1'));?>><?php echo $title1;?></h5>
								<?php aheadzen_inline_head_tinymce($this->get_field_id('title1'));?>
                            </div>
                            <div class="price"><font <?php echo aheadzen_inline_edit_code($this->get_field_id('price1'));?>><?php echo $price1;?></font> <?php if($priceper1){?><span><?php echo __('Per','aheadzen').' '.$priceper1;?></span><?php }?> </div>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('price1'));?>
                            <?php if($moneyback1){?>
							<div class="guarantee">
                                <p <?php echo aheadzen_inline_edit_code($this->get_field_id('moneyback1'));?>><?php echo $moneyback1;?></p>
								<?php aheadzen_inline_head_tinymce($this->get_field_id('moneyback1'));?>
                            </div>
							<?php }?>
                        </div>
                        <ul <?php echo aheadzen_inline_edit_code($this->get_field_id('desc1'));?> class="tb-content">
                            <?php echo $desc1;?>
                        </ul>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc1'));?>
                        <div class="buy-now">
                            <a class="button small" href="<?php echo $buttonlink1;?>" <?php echo aheadzen_inline_edit_code($this->get_field_id('buttontitle1'));?>><?php echo $buttontitle1;?></a>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('buttonlink1'));?>
                        </div>
                    </div>
                </div>
                <div class="<?php echo $class2;?> column">
                     <div class="<?php if(aheadzen_is_editing()){ }else{echo 'pr-tb-col';}?> <?php echo $isactive2;?> animate" data-animation="flipInY">
                        <div class="tb-header">
                            <div class="tb-title">
                                <h5 <?php echo aheadzen_inline_edit_code($this->get_field_id('title2'));?>><?php echo $title2;?></h5>
								<?php aheadzen_inline_head_tinymce($this->get_field_id('title2'));?>
                            </div>
                            <div class="price"> <font <?php echo aheadzen_inline_edit_code($this->get_field_id('price2'));?>><?php echo $price2;?></font> <?php if($priceper2){?><span><?php echo __('Per','aheadzen').' '.$priceper2;?></span><?php }?> </div>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('price2'));?>
                            <div class="guarantee">
                                <p <?php echo aheadzen_inline_edit_code($this->get_field_id('moneyback2'));?>><?php echo $moneyback2;?></p>
								<?php aheadzen_inline_head_tinymce($this->get_field_id('moneyback2'));?>
                            </div>
                        </div>
                        <ul <?php echo aheadzen_inline_edit_code($this->get_field_id('desc2'));?> class="tb-content">
                            <?php echo $desc2;?>
                        </ul>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc2'));?>
                        <div class="buy-now">
                            <a class="button small" href="<?php echo $buttonlink2;?>" <?php echo aheadzen_inline_edit_code($this->get_field_id('buttontitle2'));?>><?php echo $buttontitle2;?></a>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('buttonlink2'));?>
                        </div>
                    </div>
                </div>
                <div class="<?php echo $class3;?> column	">
                     <div class="<?php if(aheadzen_is_editing()){ }else{echo 'pr-tb-col';}?> <?php echo $isactive3;?> animate" data-animation="flipInY">
                        <div class="tb-header">
                            <div class="tb-title">
                                <h5 <?php echo aheadzen_inline_edit_code($this->get_field_id('title3'));?>><?php echo $title3;?></h5>
								<?php aheadzen_inline_head_tinymce($this->get_field_id('title3'));?>
                            </div>
                            <div class="price"> <font <?php echo aheadzen_inline_edit_code($this->get_field_id('price3'));?>><?php echo $price3;?></font> <?php if($priceper3){?><span><?php echo __('Per','aheadzen').' '.$priceper3;?></span><?php }?> </div>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('price3'));?>
                            <div class="guarantee">
                                <p <?php echo aheadzen_inline_edit_code($this->get_field_id('moneyback3'));?>><?php echo $moneyback3;?></p>
								<?php aheadzen_inline_head_tinymce($this->get_field_id('moneyback3'));?>
                            </div>
                        </div>
                        <ul <?php echo aheadzen_inline_edit_code($this->get_field_id('desc3'));?> class="tb-content">
                            <?php echo $desc3;?>
                        </ul>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc3'));?>
                        <div class="buy-now">
                            <a class="button small" href="<?php echo $buttonlink3;?>" <?php echo aheadzen_inline_edit_code($this->get_field_id('buttontitle3'));?>><?php echo $buttontitle3;?></a>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('buttonlink3'));?>
                        </div>
                    </div>
                </div>
                <div class="margin75"></div>
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
			$title = ($instance['title']);
			$titlesize = strip_tags($instance['titlesize']);
			$align = strip_tags($instance['align']);
			
			$title1 = ($instance['title1']);
			$price1 = ($instance['price1']);
			$priceper1 = ($instance['priceper1']);
			$moneyback1 = ($instance['moneyback1']);
			$desc1 = ($instance['desc1']);
			$buttontitle1 = ($instance['buttontitle1']);
			$buttonlink1 = ($instance['buttonlink1']);
			$isactive1 = ($instance['isactive1']);
			
			$title2 = ($instance['title2']);
			$price2 = ($instance['price2']);
			$priceper2 = ($instance['priceper2']);
			$moneyback2 = ($instance['moneyback2']);
			$desc2 = ($instance['desc2']);
			$buttontitle2 = ($instance['buttontitle2']);
			$buttonlink2 = ($instance['buttonlink2']);
			$isactive2 = ($instance['isactive2']);
			
			$title3 = ($instance['title3']);
			$price3 = ($instance['price3']);
			$priceper3 = ($instance['priceper3']);
			$moneyback3 = ($instance['moneyback3']);
			$desc3 = ($instance['desc3']);
			$buttontitle3 = ($instance['buttontitle3']);
			$buttonlink3 = ($instance['buttonlink3']);
			$isactive3 = ($instance['isactive3']);
			
			$withoutborder = ($instance['withoutborder']);
			
			$priceper2_arr = array(
							'' =>__('Select One','aheadzen'),
							'Month' => __('Month','aheadzen'),
							'Year' => __('Year','aheadzen'),
							);
			
			
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
	
	<h2><?php _e('Price 1 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('title1'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo esc_attr($title1); ?>" />	
	</label></p>
	<p><label for="<?php  echo $this->get_field_id('price1'); ?>"><?php _e('Price','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('price1'); ?>" name="<?php echo $this->get_field_name('price1'); ?>" type="text" value="<?php echo esc_attr($price1); ?>" />	
	<?php _e('eg : $40','aheadzen');?>
	</label></p>	
    <p><label for="<?php  echo $this->get_field_id('priceper1'); ?>"><?php _e('Price for','aheadzen');?>: 
    <select class="widefat" id="<?php  echo $this->get_field_id('priceper1'); ?>" name="<?php echo $this->get_field_name('priceper1'); ?>">
    <?php foreach($priceper2_arr as $key=>$val){?>
    <option value="<?php echo $key;?>" <?php if($priceper1==$key){echo 'myselected';}?>> <?php echo $val;?></option>
    <?php }?>
    </select>
   </label></p>
   <p><label for="<?php  echo $this->get_field_id('moneyback1'); ?>"><?php _e('Money Back Message','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('moneyback1'); ?>" name="<?php echo $this->get_field_name('moneyback1'); ?>" type="text" value="<?php echo esc_attr($moneyback1); ?>" />	
	<?php _e('eg: Money Back Gaurantee','aheadzen');?>
	</label></p>   
    <p><label for="<?php  echo $this->get_field_id('desc1'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo esc_attr($desc1); ?></textarea> 
	</label>
	<br><small><?php _e('Please add new line enter(press enter for each new line) to get formatted listing','aheadzen');?></small>
	</p>
	 <p><label for="<?php  echo $this->get_field_id('buttontitle1'); ?>"><?php _e('Button Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('buttontitle1'); ?>" name="<?php echo $this->get_field_name('buttontitle1'); ?>" type="text" value="<?php echo esc_attr($buttontitle1); ?>" />	
	<?php _e('eg: Learn More','aheadzen');?>
	</label></p>
	<p><label for="<?php  echo $this->get_field_id('buttonlink1'); ?>"><?php _e('Button Link','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('buttonlink1'); ?>" name="<?php echo $this->get_field_name('buttonlink1'); ?>" type="text" value="<?php echo esc_attr($buttonlink1); ?>" />
	</label></p>
	<p><label for="<?php  echo $this->get_field_id('isactive1'); ?>">
	<input class="widefat" id="<?php  echo $this->get_field_id('isactive1'); ?>" name="<?php echo $this->get_field_name('isactive1'); ?>" type="checkbox" value="1" <?php if($isactive1){echo 'checked';}?>  />
	<?php _e('Highlite this?','aheadzen');?>	
	</label></p>
    
    
     <h2><?php _e('Price 2 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('title2'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo esc_attr($title2); ?>" />	
	</label></p>
	<p><label for="<?php  echo $this->get_field_id('price2'); ?>"><?php _e('Price','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('price2'); ?>" name="<?php echo $this->get_field_name('price2'); ?>" type="text" value="<?php echo esc_attr($price2); ?>" />	
	<?php _e('eg : $40','aheadzen');?>
	</label></p>	
    <p><label for="<?php  echo $this->get_field_id('priceper2'); ?>"><?php _e('Price for','aheadzen');?>: 
    <select class="widefat" id="<?php  echo $this->get_field_id('priceper2'); ?>" name="<?php echo $this->get_field_name('priceper2'); ?>">
    <?php foreach($priceper2_arr as $key=>$val){?>
    <option value="<?php echo $key;?>" <?php if($priceper2==$key){echo 'myselected';}?>> <?php echo $val;?></option>
    <?php }?>
    </select>
   </label></p>
   <p><label for="<?php  echo $this->get_field_id('moneyback2'); ?>"><?php _e('Money Back Message','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('moneyback2'); ?>" name="<?php echo $this->get_field_name('moneyback2'); ?>" type="text" value="<?php echo esc_attr($moneyback2); ?>" />	
	<?php _e('eg: Money Back Gaurantee','aheadzen');?>
	</label></p>   
    <p><label for="<?php  echo $this->get_field_id('desc2'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc2'); ?>" name="<?php echo $this->get_field_name('desc2'); ?>"><?php echo esc_attr($desc2); ?></textarea> 
	</label>
	<br><small><?php _e('Please add new line enter(press enter for each new line) to get formatted listing','aheadzen');?></small>
	</p>
	 <p><label for="<?php  echo $this->get_field_id('buttontitle2'); ?>"><?php _e('Button Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('buttontitle2'); ?>" name="<?php echo $this->get_field_name('buttontitle2'); ?>" type="text" value="<?php echo esc_attr($buttontitle2); ?>" />	
	<?php _e('eg: Learn More','aheadzen');?>
	</label></p>
	<p><label for="<?php  echo $this->get_field_id('buttonlink2'); ?>"><?php _e('Button Link','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('buttonlink2'); ?>" name="<?php echo $this->get_field_name('buttonlink2'); ?>" type="text" value="<?php echo esc_attr($buttonlink2); ?>" />
	</label></p>
    <p><label for="<?php  echo $this->get_field_id('isactive2'); ?>">
	<input class="widefat" id="<?php  echo $this->get_field_id('isactive2'); ?>" name="<?php echo $this->get_field_name('isactive2'); ?>" type="checkbox" value="1" <?php if($isactive2){echo 'checked';}?>  />
	<?php _e('Highlite this?','aheadzen');?>	
	</label></p>
	
    
    <h2><?php _e('Price 3 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('title3'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" type="text" value="<?php echo esc_attr($title3); ?>" />	
	</label></p>
	<p><label for="<?php  echo $this->get_field_id('price3'); ?>"><?php _e('Price','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('price3'); ?>" name="<?php echo $this->get_field_name('price3'); ?>" type="text" value="<?php echo esc_attr($price3); ?>" />	
	<?php _e('eg : $40','aheadzen');?>
	</label></p>	
    <p><label for="<?php  echo $this->get_field_id('priceper3'); ?>"><?php _e('Price for','aheadzen');?>: 
    <select class="widefat" id="<?php  echo $this->get_field_id('priceper3'); ?>" name="<?php echo $this->get_field_name('priceper3'); ?>">
    <?php foreach($priceper2_arr as $key=>$val){?>
    <option value="<?php echo $key;?>" <?php if($priceper3==$key){echo 'myselected';}?>> <?php echo $val;?></option>
    <?php }?>
    </select>
   </label></p>
   <p><label for="<?php  echo $this->get_field_id('moneyback3'); ?>"><?php _e('Money Back Message','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('moneyback3'); ?>" name="<?php echo $this->get_field_name('moneyback3'); ?>" type="text" value="<?php echo esc_attr($moneyback3); ?>" />	
	<?php _e('eg: Money Back Gaurantee','aheadzen');?>
	</label></p>   
    <p><label for="<?php  echo $this->get_field_id('desc3'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc3'); ?>" name="<?php echo $this->get_field_name('desc3'); ?>"><?php echo esc_attr($desc3); ?></textarea> 
	</label>
	<br><small><?php _e('Please add new line enter(press enter for each new line) to get formatted listing','aheadzen');?></small>
	</p>
	 <p><label for="<?php  echo $this->get_field_id('buttontitle3'); ?>"><?php _e('Button Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('buttontitle3'); ?>" name="<?php echo $this->get_field_name('buttontitle3'); ?>" type="text" value="<?php echo esc_attr($buttontitle3); ?>" />	
	<?php _e('eg: Learn More','aheadzen');?>
	</label></p>
	<p><label for="<?php  echo $this->get_field_id('buttonlink3'); ?>"><?php _e('Button Link','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('buttonlink3'); ?>" name="<?php echo $this->get_field_name('buttonlink3'); ?>" type="text" value="<?php echo esc_attr($buttonlink3); ?>" />
	</label></p>
    <p><label for="<?php  echo $this->get_field_id('isactive3'); ?>">
	<input class="widefat" id="<?php  echo $this->get_field_id('isactive3'); ?>" name="<?php echo $this->get_field_name('isactive3'); ?>" type="checkbox" value="1" <?php if($isactive3){echo 'checked';}?>  />
	<?php _e('Highlite this?','aheadzen');?>	
	</label></p>
   	<?php
	}}
	register_widget('aheadzen_pricetable_widget');
}




/********************************************************
SPECIAL OFFERS WIDGET
********************************************************/
if(!class_exists('aheadzen_specialoffers_widget')){
	class aheadzen_specialoffers_widget extends WP_Widget {
		function aheadzen_specialoffers_widget() {
		//Constructor
			$widget_ops = array('classname' => 'specialoffers', 'description' =>__('Special Offers','aheadzen'));		
			$this->WP_Widget('specialoffers',__('my: Special Offers','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];
			$align = empty($instance['align']) ? '' : $instance['align'];
			
			$per1 = empty($instance['per1']) ? '11' : $instance['per1'];
			$round1 = empty($instance['round1']) ? 'donutchart1' : $instance['round1'];
			$title1 = empty($instance['title1']) ? '' : $instance['title1'];
			$code1 = empty($instance['code1']) ? '' : $instance['code1'];
			$desc1 = empty($instance['desc1']) ? '' : $instance['desc1'];
			$button1 = empty($instance['button1']) ? 'Select' : $instance['button1'];
			$buttonstyle1 = empty($instance['buttonstyle1']) ? 'red' : $instance['buttonstyle1'];
			$buttonlink1 = empty($instance['buttonlink1']) ? '#' : $instance['buttonlink1'];
			
			$per2 = empty($instance['per2']) ? '31' : $instance['per2'];
			$round2 = empty($instance['round2']) ? 'donutchart2' : $instance['round2'];
			$title2 = empty($instance['title2']) ? '' : $instance['title2'];
			$code2 = empty($instance['code2']) ? '' : $instance['code2'];
			$desc2 = empty($instance['desc2']) ? '' : $instance['desc2'];
			$button2 = empty($instance['button2']) ? 'Select' : $instance['button2'];
			$buttonstyle2 = empty($instance['buttonstyle2']) ? 'coral' : $instance['buttonstyle2'];
			$buttonlink2 = empty($instance['buttonlink2']) ? '#' : $instance['buttonlink2'];
			
			$per3 = empty($instance['per3']) ? '51' : $instance['per3'];
			$round3 = empty($instance['round3']) ? 'donutchart3' : $instance['round3'];
			$title3 = empty($instance['title3']) ? '' : $instance['title3'];
			$code3 = empty($instance['code3']) ? '' : $instance['code3'];
			$desc3 = empty($instance['desc3']) ? '' : $instance['desc3'];
			$button3 = empty($instance['button3']) ? 'Select' : $instance['button3'];
			$buttonstyle3 = empty($instance['buttonstyle3']) ? 'blue' : $instance['buttonstyle3'];
			$buttonlink3 = empty($instance['buttonlink3']) ? '#' : $instance['buttonlink3'];
			
			$per4 = empty($instance['per4']) ? '78' : $instance['per4'];
			$round4 = empty($instance['round4']) ? 'donutchart4' : $instance['round4'];
			$title4 = empty($instance['title4']) ? '' : $instance['title4'];
			$code4 = empty($instance['code4']) ? '' : $instance['code4'];
			$desc4 = empty($instance['desc4']) ? '' : $instance['desc4'];
			$button4 = empty($instance['button4']) ? 'Select' : $instance['button4'];
			$buttonstyle4 = empty($instance['buttonstyle4']) ? 'green' : $instance['buttonstyle4'];
			$buttonlink4 = empty($instance['buttonlink4']) ? '#' : $instance['buttonlink4'];
			
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($title1==''){$title1='Edit Sub Title Here';}
				if($title2==''){$title2='Edit Sub Title Here';}
				if($title3==''){$title3='Edit Sub Title Here';}
				if($title4==''){$title4='Edit Sub Title Here';}
				
				if($per1==''){$per1='11';}
				if($per2==''){$per2='21';}
				if($per3==''){$per3='31';}
				if($per4==''){$per4='41';}
				
				if($code1==''){$code1='Code: XF235';}
				if($code2==''){$code2='Code: XF235';}
				if($code3==''){$code3='Code: XF235';}
				if($code4==''){$code4='Code: XF235';}
				
				if($desc1==''){$desc1='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc2==''){$desc2='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc3==''){$desc3='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc4==''){$desc4='Hello this is sample content for you. Your description for the content are can be editable from here.';}
			}
			
			$withoutborder = empty($instance['withoutborder']) ? '' : $instance['withoutborder'];
			if($withoutborder)
			{				
				$before_widget = str_replace('content-main','content-main-none',$before_widget);
			}
			echo $before_widget;
			?>
            <?php if($title){?>
            <h2 class="border-title <?php echo $titlesize.' '.$align;?>"><font <?php echo aheadzen_inline_edit_code($this->get_field_id('title'));?>><?php echo $title;?></font><span></span></h2>
			<div class="margin30"></div>
            <?php aheadzen_inline_head_tinymce($this->get_field_id('title'));?>
			<?php }?>                
                <div class="one-fourth column">
                    <div class="progress-bar-wrapper">
                        <div id="<?php echo $round1;?>" data-percent="<?php echo $per1;?>">Save<br /></div>
                        <div class="progress-bar-content">
                            <h4 <?php echo aheadzen_inline_edit_code($this->get_field_id('title1'));?>><?php echo $title1;?></h4>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('title1'));?>
                            <?php if($code1){?>
							<span <?php echo aheadzen_inline_edit_code($this->get_field_id('code1'));?> class="code"><?php echo $code1;?></span>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('code1'));?>
							<?php }?>
                            <div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc1'));?>><?php echo $desc1;?></div>
							<?php aheadzen_inline_tinymce($this->get_field_id('desc1'));?>
                            <a href="<?php echo $buttonlink1;?>" class="button small <?php echo $buttonstyle1?>" <?php echo aheadzen_inline_edit_code($this->get_field_id('button1'));?>><?php echo $button1;?></a>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('button1'));?>
                        </div>
                    </div>
                </div>
                <div class="one-fourth column">
                    <div class="progress-bar-wrapper">
                        <div id="<?php echo $round2;?>" data-percent="<?php echo $per2;?>">Save<br /></div>
                        <div class="progress-bar-content">
                            <h4 <?php echo aheadzen_inline_edit_code($this->get_field_id('title2'));?>><?php echo $title2;?></h4>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('title2'));?>
                            <?php if($code2){?>
							<span <?php echo aheadzen_inline_edit_code($this->get_field_id('code2'));?> class="code"><?php echo $code2;?></span>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('code2'));?>
							<?php }?>
                            <div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc2'));?>><?php echo $desc2;?></div>
							<?php aheadzen_inline_tinymce($this->get_field_id('desc2'));?>
                            <a href="<?php echo $buttonlink2;?>" class="button small <?php echo $buttonstyle2?>" <?php echo aheadzen_inline_edit_code($this->get_field_id('button2'));?>><?php echo $button2;?></a>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('button2'));?>
                        </div>
                    </div>
                </div>
                <div class="one-fourth column">
                    <div class="progress-bar-wrapper">
                        <div id="<?php echo $round3;?>" data-percent="<?php echo $per3;?>">Save<br /></div>
                        <div class="progress-bar-content">
                            <h4 <?php echo aheadzen_inline_edit_code($this->get_field_id('title3'));?>><?php echo $title3;?></h4>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('title3'));?>
                            <?php if($code3){?>
							<span <?php echo aheadzen_inline_edit_code($this->get_field_id('code3'));?> class="code"><?php echo $code3;?></span>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('code3'));?>
							<?php }?>
                            <div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc3'));?>><?php echo $desc3;?></div>
							<?php aheadzen_inline_tinymce($this->get_field_id('desc3'));?>
                            <a href="<?php echo $buttonlink3;?>" class="button small <?php echo $buttonstyle3?>" <?php echo aheadzen_inline_edit_code($this->get_field_id('button3'));?>><?php echo $button3;?></a>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('button3'));?>
                        </div>
                    </div>
                </div>
				<div class="one-fourth column last">
                    <div class="progress-bar-wrapper">
                        <div id="<?php echo $round4;?>" data-percent="<?php echo $per4;?>">Save<br /></div>
                        <div class="progress-bar-content">
                            <h4 <?php echo aheadzen_inline_edit_code($this->get_field_id('title4'));?>><?php echo $title4;?></h4>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('title4'));?>
                            <?php if($code4){?>
							<span <?php echo aheadzen_inline_edit_code($this->get_field_id('code4'));?> class="code"><?php echo $code4;?></span>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('code4'));?>
							<?php }?>
                            <div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc4'));?>><?php echo $desc4;?></div>
							<?php aheadzen_inline_tinymce($this->get_field_id('desc4'));?>
                            <a href="<?php echo $buttonlink4;?>" class="button small <?php echo $buttonstyle4?>" <?php echo aheadzen_inline_edit_code($this->get_field_id('button4'));?>><?php echo $button4;?></a>
							<?php aheadzen_inline_head_tinymce($this->get_field_id('button4'));?>
                        </div>
                    </div>
                </div>
                <div class="margin80"></div>
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
			$title = ($instance['title']);
			$titlesize = strip_tags($instance['titlesize']);
			$align = strip_tags($instance['align']);
			
			$per1 = ($instance['per1']);
			$round1 = ($instance['round1']);
			$title1 = ($instance['title1']);
			$code1 = ($instance['code1']);
			$desc1 = ($instance['desc1']);
			$button1 = ($instance['button1']);
			$buttonstyle1 = ($instance['buttonstyle1']);
			$buttonlink1 = ($instance['buttonlink1']);
			
			$per2 = ($instance['per2']);
			$round2 = ($instance['round2']);
			$title2 = ($instance['title2']);
			$code2 = ($instance['code2']);
			$desc2 = ($instance['desc2']);
			$button2 = ($instance['button2']);
			$buttonstyle2 = ($instance['buttonstyle2']);
			$buttonlink2 = ($instance['buttonlink2']);
			
			$per3 = ($instance['per3']);
			$round3 = ($instance['round3']);
			$title3 = ($instance['title3']);
			$code3 = ($instance['code3']);
			$desc3 = ($instance['desc3']);
			$button3 = ($instance['button3']);
			$buttonstyle3 = ($instance['buttonstyle3']);
			$buttonlink3 = ($instance['buttonlink3']);
			
			$per4 = ($instance['per4']);
			$round4 = ($instance['round4']);
			$title4 = ($instance['title4']);
			$code4 = ($instance['code4']);
			$desc4 = ($instance['desc4']);
			$button4 = ($instance['button4']);
			$buttonstyle4 = ($instance['buttonstyle4']);
			$buttonlink4 = ($instance['buttonlink4']);
			
			$withoutborder = ($instance['withoutborder']);
			
			
			$round_arr = array(
					'donutchart1'	=> 'Donut Chart 1',
					'donutchart2'	=> 'Donut Chart 2',
					'donutchart3'	=> 'Donut Chart 3',
					'donutchart4'	=> 'Donut Chart 4',
					 );
			
			$buttonstyle_arr = array(
					'red'	=> 'Red',
					'coral'	=> 'Coral',
					'green'	=> 'Green',
					'blue'	=> 'Blue',
					 );
			
			
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
	
	<h2><?php _e('Offer 1 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('per1'); ?>"><?php _e('Offer Percentage','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('per1'); ?>" name="<?php echo $this->get_field_name('per1'); ?>" type="text" value="<?php echo esc_attr($per1); ?>" />	
	</label><?php _e('eg: 20 OR 50 OR 75 etc...','aheadzen');?></p>
	
	<p><label for="<?php  echo $this->get_field_id('round1'); ?>"><?php _e('Select Round Effect','aheadzen');?>: 
    <select class="widefat" id="<?php  echo $this->get_field_id('round1'); ?>" name="<?php echo $this->get_field_name('round1'); ?>">
    <option value=""><?php _e('Select One','aheadzen');?></option>
	<?php foreach($round_arr as $key=>$val){?>
    <option value="<?php echo $key;?>" <?php if($round1==$key){echo 'selected';}?>> <?php echo $val;?></option>
    <?php }?>
    </select>
   </label></p>
   
     <p><label for="<?php  echo $this->get_field_id('title1'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo esc_attr($title1); ?>" />	
	</label></p>
	
	 <p><label for="<?php  echo $this->get_field_id('code1'); ?>"><?php _e('Coupon Code','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('code1'); ?>" name="<?php echo $this->get_field_name('code1'); ?>" type="text" value="<?php echo esc_attr($code1); ?>" />	
	</label><?php _e('eg: Code: XF235 etc...','aheadzen');?></p>
	
    <p><label for="<?php  echo $this->get_field_id('desc1'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo esc_attr($desc1); ?></textarea> 
	</label></p>
	
	<p><label for="<?php  echo $this->get_field_id('button1'); ?>"><?php _e('Button Text','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('button1'); ?>" name="<?php echo $this->get_field_name('button1'); ?>" type="text" value="<?php echo esc_attr($button1); ?>" />	
	</label><?php _e('eg: Select','aheadzen');?></p>
	
	<p><label for="<?php  echo $this->get_field_id('buttonstyle1'); ?>"><?php _e('Button Style','aheadzen');?>: 
    <select class="widefat" id="<?php  echo $this->get_field_id('buttonstyle1'); ?>" name="<?php echo $this->get_field_name('buttonstyle1'); ?>">
    <option value=""><?php _e('Select One','aheadzen');?></option>
	<?php foreach($buttonstyle_arr as $key=>$val){?>
    <option value="<?php echo $key;?>" <?php if($buttonstyle1==$key){echo 'selected';}?>> <?php echo $val;?></option>
    <?php }?>
    </select>
   </label></p>  
   
	<p><label for="<?php  echo $this->get_field_id('buttonlink1'); ?>"><?php _e('Button Link','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('buttonlink1'); ?>" name="<?php echo $this->get_field_name('buttonlink1'); ?>" type="text" value="<?php echo esc_attr($buttonlink1); ?>" />	
	</label><?php _e('eg: full url link for button click','aheadzen');?></p>
	
	
    
     <h2><?php _e('Offer 2 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('per2'); ?>"><?php _e('Offer Percentage','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('per2'); ?>" name="<?php echo $this->get_field_name('per2'); ?>" type="text" value="<?php echo esc_attr($per2); ?>" />	
	</label><?php _e('eg: 20 OR 50 OR 75 etc...','aheadzen');?></p>
	
	<p><label for="<?php  echo $this->get_field_id('round2'); ?>"><?php _e('Select Round Effect','aheadzen');?>: 
    <select class="widefat" id="<?php  echo $this->get_field_id('round2'); ?>" name="<?php echo $this->get_field_name('round2'); ?>">
    <option value=""><?php _e('Select One','aheadzen');?></option>
	<?php foreach($round_arr as $key=>$val){?>
    <option value="<?php echo $key;?>" <?php if($round2==$key){echo 'selected';}?>> <?php echo $val;?></option>
    <?php }?>
    </select>
   </label></p>
   
     <p><label for="<?php  echo $this->get_field_id('title2'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo esc_attr($title2); ?>" />	
	</label></p>
	
	 <p><label for="<?php  echo $this->get_field_id('code2'); ?>"><?php _e('Coupon Code','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('code2'); ?>" name="<?php echo $this->get_field_name('code2'); ?>" type="text" value="<?php echo esc_attr($code2); ?>" />	
	</label><?php _e('eg: Code: XF235 etc...','aheadzen');?></p>
	
    <p><label for="<?php  echo $this->get_field_id('desc2'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc2'); ?>" name="<?php echo $this->get_field_name('desc2'); ?>"><?php echo esc_attr($desc2); ?></textarea> 
	</label></p>
	
	<p><label for="<?php  echo $this->get_field_id('button2'); ?>"><?php _e('Button Text','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('button2'); ?>" name="<?php echo $this->get_field_name('button2'); ?>" type="text" value="<?php echo esc_attr($button2); ?>" />	
	</label><?php _e('eg: Select','aheadzen');?></p>
	
	<p><label for="<?php  echo $this->get_field_id('buttonstyle2'); ?>"><?php _e('Button Style','aheadzen');?>: 
    <select class="widefat" id="<?php  echo $this->get_field_id('buttonstyle2'); ?>" name="<?php echo $this->get_field_name('buttonstyle2'); ?>">
    <option value=""><?php _e('Select One','aheadzen');?></option>
	<?php foreach($buttonstyle_arr as $key=>$val){?>
    <option value="<?php echo $key;?>" <?php if($buttonstyle2==$key){echo 'selected';}?>> <?php echo $val;?></option>
    <?php }?>
    </select>
   </label></p>  
   
	<p><label for="<?php  echo $this->get_field_id('buttonlink2'); ?>"><?php _e('Button Link','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('buttonlink2'); ?>" name="<?php echo $this->get_field_name('buttonlink2'); ?>" type="text" value="<?php echo esc_attr($buttonlink2); ?>" />	
	</label><?php _e('eg: full url link for button click','aheadzen');?></p>    
    
    <h2><?php _e('Offer 3 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('per3'); ?>"><?php _e('Offer Percentage','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('per3'); ?>" name="<?php echo $this->get_field_name('per3'); ?>" type="text" value="<?php echo esc_attr($per3); ?>" />	
	</label><?php _e('eg: 20 OR 50 OR 75 etc...','aheadzen');?></p>
	
	<p><label for="<?php  echo $this->get_field_id('round3'); ?>"><?php _e('Select Round Effect','aheadzen');?>: 
    <select class="widefat" id="<?php  echo $this->get_field_id('round3'); ?>" name="<?php echo $this->get_field_name('round3'); ?>">
    <option value=""><?php _e('Select One','aheadzen');?></option>
	<?php foreach($round_arr as $key=>$val){?>
    <option value="<?php echo $key;?>" <?php if($round3==$key){echo 'selected';}?>> <?php echo $val;?></option>
    <?php }?>
    </select>
   </label></p>
   
     <p><label for="<?php  echo $this->get_field_id('title3'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" type="text" value="<?php echo esc_attr($title3); ?>" />	
	</label></p>
	
	 <p><label for="<?php  echo $this->get_field_id('code3'); ?>"><?php _e('Coupon Code','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('code3'); ?>" name="<?php echo $this->get_field_name('code3'); ?>" type="text" value="<?php echo esc_attr($code3); ?>" />	
	</label><?php _e('eg: Code: XF235 etc...','aheadzen');?></p>
	
    <p><label for="<?php  echo $this->get_field_id('desc3'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc3'); ?>" name="<?php echo $this->get_field_name('desc3'); ?>"><?php echo esc_attr($desc3); ?></textarea> 
	</label></p>
	
	<p><label for="<?php  echo $this->get_field_id('button3'); ?>"><?php _e('Button Text','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('button3'); ?>" name="<?php echo $this->get_field_name('button3'); ?>" type="text" value="<?php echo esc_attr($button3); ?>" />	
	</label><?php _e('eg: Select','aheadzen');?></p>
	
	<p><label for="<?php  echo $this->get_field_id('buttonstyle3'); ?>"><?php _e('Button Style','aheadzen');?>: 
    <select class="widefat" id="<?php  echo $this->get_field_id('buttonstyle3'); ?>" name="<?php echo $this->get_field_name('buttonstyle3'); ?>">
    <option value=""><?php _e('Select One','aheadzen');?></option>
	<?php foreach($buttonstyle_arr as $key=>$val){?>
    <option value="<?php echo $key;?>" <?php if($buttonstyle3==$key){echo 'selected';}?>> <?php echo $val;?></option>
    <?php }?>
    </select>
   </label></p>  
   
	<p><label for="<?php  echo $this->get_field_id('buttonlink3'); ?>"><?php _e('Button Link','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('buttonlink3'); ?>" name="<?php echo $this->get_field_name('buttonlink3'); ?>" type="text" value="<?php echo esc_attr($buttonlink3); ?>" />	
	</label><?php _e('eg: full url link for button click','aheadzen');?></p>	
	
	<h2><?php _e('Offer 4 Content','aheadzen');?></h2>
    <p><label for="<?php  echo $this->get_field_id('per4'); ?>"><?php _e('Offer Percentage','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('per4'); ?>" name="<?php echo $this->get_field_name('per4'); ?>" type="text" value="<?php echo esc_attr($per4); ?>" />	
	</label><?php _e('eg: 20 OR 50 OR 75 etc...','aheadzen');?></p>
	
	<p><label for="<?php  echo $this->get_field_id('round4'); ?>"><?php _e('Select Round Effect','aheadzen');?>: 
    <select class="widefat" id="<?php  echo $this->get_field_id('round4'); ?>" name="<?php echo $this->get_field_name('round4'); ?>">
    <option value=""><?php _e('Select One','aheadzen');?></option>
	<?php foreach($round_arr as $key=>$val){?>
    <option value="<?php echo $key;?>" <?php if($round4==$key){echo 'selected';}?>> <?php echo $val;?></option>
    <?php }?>
    </select>
   </label></p>
   
     <p><label for="<?php  echo $this->get_field_id('title4'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title4'); ?>" name="<?php echo $this->get_field_name('title4'); ?>" type="text" value="<?php echo esc_attr($title4); ?>" />	
	</label></p>
	
	 <p><label for="<?php  echo $this->get_field_id('code4'); ?>"><?php _e('Coupon Code','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('code4'); ?>" name="<?php echo $this->get_field_name('code4'); ?>" type="text" value="<?php echo esc_attr($code4); ?>" />	
	</label><?php _e('eg: Code: XF235 etc...','aheadzen');?></p>
	
    <p><label for="<?php  echo $this->get_field_id('desc4'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc4'); ?>" name="<?php echo $this->get_field_name('desc4'); ?>"><?php echo esc_attr($desc4); ?></textarea> 
	</label></p>
	
	<p><label for="<?php  echo $this->get_field_id('button4'); ?>"><?php _e('Button Text','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('button4'); ?>" name="<?php echo $this->get_field_name('button4'); ?>" type="text" value="<?php echo esc_attr($button4); ?>" />	
	</label><?php _e('eg: Select','aheadzen');?></p>
	
	<p><label for="<?php  echo $this->get_field_id('buttonstyle4'); ?>"><?php _e('Button Style','aheadzen');?>: 
    <select class="widefat" id="<?php  echo $this->get_field_id('buttonstyle4'); ?>" name="<?php echo $this->get_field_name('buttonstyle4'); ?>">
    <option value=""><?php _e('Select One','aheadzen');?></option>
	<?php foreach($buttonstyle_arr as $key=>$val){?>
    <option value="<?php echo $key;?>" <?php if($buttonstyle4==$key){echo 'selected';}?>> <?php echo $val;?></option>
    <?php }?>
    </select>
   </label></p>  
   
	<p><label for="<?php  echo $this->get_field_id('buttonlink4'); ?>"><?php _e('Button Link','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('buttonlink4'); ?>" name="<?php echo $this->get_field_name('buttonlink4'); ?>" type="text" value="<?php echo esc_attr($buttonlink4); ?>" />	
	</label><?php _e('eg: full url link for button click','aheadzen');?></p>
    
   	<?php
	}}
	register_widget('aheadzen_specialoffers_widget');
}



/********************************************************
Contact US WIDGET
********************************************************/
if(!class_exists('aheadzen_contactus_widget')){
	class aheadzen_contactus_widget extends WP_Widget {
		function aheadzen_contactus_widget() {
		//Constructor
			$widget_ops = array('classname' => 'aheadzen_contactus_now', 'description' =>__('Contact Us','aheadzen'));		
			$this->WP_Widget('contact_us',__('my: Contact Us','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$map = empty($instance['map']) ? '' : $instance['map'];
			$desc = empty($instance['desc']) ? '' : $instance['desc'];
			$desc2 = empty($instance['desc2']) ? '' : $instance['desc2'];
			$location = empty($instance['location']) ? '' : $instance['location'];
			$support1 = empty($instance['support1']) ? '' : $instance['support1'];
			$support2 = empty($instance['support2']) ? '' : $instance['support2'];
			$isform = empty($instance['isform']) ? '0' : $instance['isform'];
			$fb = empty($instance['fb']) ? '' : $instance['fb'];
			$gp = empty($instance['gp']) ? '' : $instance['gp'];
			$tw = empty($instance['tw']) ? '' : $instance['tw'];
			$ln = empty($instance['ln']) ? '' : $instance['ln'];
			$maplink = empty($instance['maplink']) ? '' : $instance['maplink'];
			$video = empty($instance['video']) ? '' : $instance['video'];
			$eml = empty($instance['eml']) ? '' : $instance['eml'];
			
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($desc==''){$desc='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc2==''){$desc2='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($location==''){$location='Edit Your Location Here';}
				if($support1==''){$support1='Edit Your Support Content Here';}
				if($support2==''){$support2='Edit Your Support Content Here';}
				if($fb==''){$fb='#';}
				if($gp==''){$gp='#';}
				if($tw==''){$tw='#';}
				if($ln==''){$ln='#';}
				if($maplink==''){$maplink='#';}
				if($video==''){$video='#';}
				if($eml==''){$eml='#';}
				
			}
			
			$withoutborder = empty($instance['withoutborder']) ? '' : $instance['withoutborder'];
			if($withoutborder)
			{				
				$before_widget = str_replace('content-main','content-main-none',$before_widget);
			}
			echo $before_widget;
			?>
			 <div class="location">
                    <h4 <?php echo aheadzen_inline_edit_code($this->get_field_id('title'));?> class="map-title"><?php echo $title;?></h4>                    
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title'));?>
                    <?php if($map){?>
					<div id="map"><?php echo $map;?> </div>
					<?php }?>
                    
                    <div class="margin55"></div>
                    <div class="contact-info">
					<?php if($desc){?><div class="margin10"></div><p <?php echo aheadzen_inline_edit_code($this->get_field_id('desc'));?>><?php echo nl2br($desc);?></p><div class="margin10"></div>
					<?php aheadzen_inline_tinymce($this->get_field_id('desc'));?>
					<?php }?>
                        <?php if($location){?>
						<h4>Contact Details</h4>
						<div class="one-third column" <?php echo aheadzen_inline_edit_code($this->get_field_id('location'));?>>
                            <?php echo nl2br($location);?>
							<?php aheadzen_inline_tinymce($this->get_field_id('location'));?>
                        </div>
						<?php }?>
						<?php if($support1){?>
						    <div class="one-third column" <?php echo aheadzen_inline_edit_code($this->get_field_id('support1'));?>>
                              <?php if($support1){ echo nl2br($support1);?>
							<?php aheadzen_inline_tinymce($this->get_field_id('support1'));?>
							<?php  }?>
                            </div>
							<?php }?>
						<?php if($support2){?>
							<div class="one-third column last" <?php echo aheadzen_inline_edit_code($this->get_field_id('support2'));?>>
                                <?php if($support2){ echo nl2br($support2);?>
								<?php aheadzen_inline_tinymce($this->get_field_id('support2'));?>
								<?php }?>
                            </div>
                        
						<?php }?>		
                        <div class="margin20"> </div>
                        <?php if($desc2){?><div class="margin10"></div><p <?php echo aheadzen_inline_edit_code($this->get_field_id('desc2'));?>><?php echo nl2br($desc2);?></p><div class="margin10"></div><div class="margin50"> </div>
						<?php aheadzen_inline_tinymce($this->get_field_id('desc2'));?>
						<?php }?>
						
						<?php if($isform){
						}else{?>
                        <div id="ajax_contact_msg"></div>
                        <form name="frmcontact" action="<?php echo site_url();?>/" class="contact-frm" method="post" onsubmit="return" />
                            <input type="hidden" name="contact_frm" value="1" />
							<input type="hidden" name="toeml" value="<?php echo $eml;?>" />
							<input type="text" required="" placeholder="Name" name="txtname" />
                            <p class="twocolumn">
                                <input type="email" required="" placeholder="Email" name="txtemail" />
                                <input type="tel" placeholder="Phone" name="txtphone" />
                            </p>
                            <textarea placeholder="Message" name="txtmessage"></textarea>
                            <input type="submit" class="button contact_submit" value="Submit" name="btnsend" />
                        </form>
						<?php }?>
						
					<div class="margin30"> </div>	
					<ul class="social-media">
					<?php $nw='target="_blank"';?>
					<?php if($fb){?> <li><a <?php echo $nw;?> href="<?php echo trim($fb);?>" class="icon-facebook"></a></li><?php }?>
					<?php if($gp){?><li><a <?php echo $nw;?> href="<?php echo trim($gp);?>" class="icon-gplus"></a></li><?php }?>
					<?php if($tw){?><li><a <?php echo $nw;?> href="<?php echo trim($tw);?>" class="icon-twitter"></a></li><?php }?>
					<?php if($ln){?><li><a <?php echo $nw;?> href="<?php echo trim($ln);?>" class="icon-linkedin"></a></li><?php }?>
					<?php if($maplink){?><li><a <?php echo $nw;?> href="<?php echo trim($maplink);?>" class="icon-pin"></a></li><?php }?>
					<?php if($video){?><li><a <?php echo $nw;?> href="<?php echo trim($video);?>" class="icon-video"></a></li><?php }?>
					<?php if($eml){?><li><a <?php echo $nw;?> href="mailto:<?php echo trim($eml);?>" class="icon-mail"></a></li><?php }?>
					</ul>
					<div class="margin20"> </div>
                    </div>
                </div>
		
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
			$title = $instance['title'];
			$map = $instance['map'];
			$desc = ($instance['desc']);
			$location = ($instance['location']);
			$support1 = ($instance['support1']);
			$support2 = ($instance['support2']);
			$desc2 = ($instance['desc2']);
			$isform = ($instance['isform']);
			$fb = ($instance['fb']);
			$tw = ($instance['tw']);
			$gp = ($instance['gp']);
			$ln = ($instance['ln']);
			$maplink = ($instance['maplink']);
			$video = ($instance['video']);
			$eml = ($instance['eml']);
			
			$withoutborder = ($instance['withoutborder']);
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />	
	</label></p>
	
	<p><label for="<?php  echo $this->get_field_id('withoutborder'); ?>">
	<input class="widefat" id="<?php  echo $this->get_field_id('withoutborder'); ?>" name="<?php echo $this->get_field_name('withoutborder'); ?>" type="checkbox" value="1" <?php if($withoutborder){echo 'checked';}?>  />
	<?php _e('Show Data without borders (simple inner html only)?','aheadzen');?>	
	</label></p>
	
	<p><label for="<?php  echo $this->get_field_id('map'); ?>"><?php _e('Map Code','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('map'); ?>" name="<?php echo $this->get_field_name('map'); ?>"><?php echo esc_attr($map); ?></textarea> 
	</label><?php _e('eg: Map iframe code from map.google.com with proper height & width','aheadzen');?></p>
    
    <p><label for="<?php  echo $this->get_field_id('desc'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo esc_attr($desc); ?></textarea> 
	</label></p>
    
    <p><label for="<?php  echo $this->get_field_id('location'); ?>"><?php _e('Address Location','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>"><?php echo esc_attr($location); ?></textarea> 
	</label><?php _e('eg: your address, city,state, zip..... ','aheadzen');?></p>
	
	<p><label for="<?php  echo $this->get_field_id('support1'); ?>"><?php _e('Support Details','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('support1'); ?>" name="<?php echo $this->get_field_name('support1'); ?>"><?php echo esc_attr($support1); ?></textarea> 
	</label><?php _e('eg: support person,phone, email... ','aheadzen');?></p>
	
	<p><label for="<?php  echo $this->get_field_id('support2'); ?>"><?php _e('Contact Details','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('support2'); ?>" name="<?php echo $this->get_field_name('support2'); ?>"><?php echo esc_attr($support2); ?></textarea> 
	</label><?php _e('eg: contact person,phone, email... ','aheadzen');?></p>
    
	<p><label for="<?php  echo $this->get_field_id('desc2'); ?>"><?php _e('Bottom Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc2'); ?>" name="<?php echo $this->get_field_name('desc2'); ?>"><?php echo esc_attr($desc2); ?></textarea> 
	</label></p>
	
	<p><label for="<?php  echo $this->get_field_id('isform'); ?>">
	<input class="widefat" id="<?php  echo $this->get_field_id('isform'); ?>" name="<?php echo $this->get_field_name('isform'); ?>" type="checkbox" value="1" <?php if($isform){echo 'checked';}?>  />
	<?php _e('Hide Contact form?','aheadzen');?>	
	</label></p>
	
	<p><label for="<?php  echo $this->get_field_id('fb'); ?>"><?php _e('Facebook URL','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('fb'); ?>" name="<?php echo $this->get_field_name('fb'); ?>" type="text" value="<?php echo esc_attr($fb); ?>" />	
	</label>
	<br><small><?php _e('eg: http://facebook.com/aheadzen/','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('gp'); ?>"><?php _e('Google Plus URL','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('gp'); ?>" name="<?php echo $this->get_field_name('gp'); ?>" type="text" value="<?php echo esc_attr($gp); ?>" />	
	</label>
	<br><small><?php _e('eg: http://plus.google.com/u/aheadzen/','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('tw'); ?>"><?php _e('Twitter URL','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('tw'); ?>" name="<?php echo $this->get_field_name('tw'); ?>" type="text" value="<?php echo esc_attr($tw); ?>" />	
	</label>
	<br><small><?php _e('eg: http://twitter.com/aheadzen/','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('ln'); ?>"><?php _e('Linkedin URL','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('ln'); ?>" name="<?php echo $this->get_field_name('ln'); ?>" type="text" value="<?php echo esc_attr($ln); ?>" />	
	</label>
	<br><small><?php _e('eg: http://linkedin.com/user/aheadzen/','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('maplink'); ?>"><?php _e('Google/Bind Map URL','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('maplink'); ?>" name="<?php echo $this->get_field_name('maplink'); ?>" type="text" value="<?php echo esc_attr($maplink); ?>" />	
	</label>
	<br><small><?php _e('eg: https://www.google.com/maps/place/Jaipur,Rajasthan,India/','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('video'); ?>"><?php _e('Youtube/Vimeo Link','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('video'); ?>" name="<?php echo $this->get_field_name('video'); ?>" type="text" value="<?php echo esc_attr($video); ?>" />	
	</label>
	<br><small><?php _e('eg: http://youtube.com/aheadzen/','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('eml'); ?>"><?php _e('Contact Email Address','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('eml'); ?>" name="<?php echo $this->get_field_name('eml'); ?>" type="text" value="<?php echo esc_attr($eml); ?>" />	
	</label>
	<br><small><?php _e('eg: info@aheadzen.com','aheadzen');?></small>
	</p>
	<?php
	}}
	register_widget('aheadzen_contactus_widget');
}


/********************************************************
SOCIAL WIDGET
********************************************************/
if(!class_exists('aheadzen_social_widget')){
	class aheadzen_social_widget extends WP_Widget {
		function aheadzen_social_widget() {
		//Constructor
			$widget_ops = array('classname' => 'aheadzen_social_now', 'description' =>__('Social Network widget','aheadzen'));		
			$this->WP_Widget('aheadzen_social',__('my: Social Network','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			echo $before_widget;
			$title = empty($instance['title']) ? '' : $instance['title'];
			$fb = empty($instance['fb']) ? '' : $instance['fb'];
			$gp = empty($instance['gp']) ? '' : $instance['gp'];
			$tw = empty($instance['tw']) ? '' : $instance['tw'];
			$ln = empty($instance['ln']) ? '' : $instance['ln'];
			$maplink = empty($instance['maplink']) ? '' : $instance['maplink'];
			$video = empty($instance['video']) ? '' : $instance['video'];
			$eml = empty($instance['eml']) ? '' : $instance['eml'];
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($fb==''){$fb='#';}
				if($gp==''){$gp='#';}
				if($tw==''){$tw='#';}
				if($ln==''){$ln='#';}
				if($maplink==''){$maplink='#';}
				if($video==''){$video='#';}
				if($eml==''){$eml='#';}
			}
			?>
			        <?php echo $before_title.$title.$after_title;?></h4>                    
                  	
					<div class="margin30 social-media-space1"> </div>	
					<ul class="social-media">
					<?php $nw='target="_blank"';?>
					<?php if($fb){?> <li><a <?php echo $nw;?> href="<?php echo trim($fb);?>" class="icon-facebook"></a></li><?php }?>
					<?php if($gp){?><li><a <?php echo $nw;?> href="<?php echo trim($gp);?>" class="icon-gplus"></a></li><?php }?>
					<?php if($tw){?><li><a <?php echo $nw;?> href="<?php echo trim($tw);?>" class="icon-twitter"></a></li><?php }?>
					<?php if($ln){?><li><a <?php echo $nw;?> href="<?php echo trim($ln);?>" class="icon-linkedin"></a></li><?php }?>
					<?php if($maplink){?><li><a <?php echo $nw;?> href="<?php echo trim($maplink);?>" class="icon-pin"></a></li><?php }?>
					<?php if($video){?><li><a <?php echo $nw;?> href="<?php echo trim($video);?>" class="icon-video"></a></li><?php }?>
					<?php if($eml){?><li><a <?php echo $nw;?> href="mailto:<?php echo trim($eml);?>" class="icon-mail"></a></li><?php }?>
					</ul>
					<div class="margin30 social-media-space2"> </div>
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
			$title = $instance['title'];
			$fb = ($instance['fb']);
			$tw = ($instance['tw']);
			$gp = ($instance['gp']);
			$ln = ($instance['ln']);
			$maplink = ($instance['maplink']);
			$video = ($instance['video']);
			$eml = ($instance['eml']);
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />	
	</label></p>
	
	<p><label for="<?php  echo $this->get_field_id('fb'); ?>"><?php _e('Facebook URL','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('fb'); ?>" name="<?php echo $this->get_field_name('fb'); ?>" type="text" value="<?php echo esc_attr($fb); ?>" />	
	</label>
	<br><small><?php _e('eg: http://facebook.com/aheadzen/','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('gp'); ?>"><?php _e('Google Plus URL','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('gp'); ?>" name="<?php echo $this->get_field_name('gp'); ?>" type="text" value="<?php echo esc_attr($gp); ?>" />	
	</label>
	<br><small><?php _e('eg: http://plus.google.com/u/aheadzen/','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('tw'); ?>"><?php _e('Twitter URL','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('tw'); ?>" name="<?php echo $this->get_field_name('tw'); ?>" type="text" value="<?php echo esc_attr($tw); ?>" />	
	</label>
	<br><small><?php _e('eg: http://twitter.com/aheadzen/','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('ln'); ?>"><?php _e('Linkedin URL','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('ln'); ?>" name="<?php echo $this->get_field_name('ln'); ?>" type="text" value="<?php echo esc_attr($ln); ?>" />	
	</label>
	<br><small><?php _e('eg: http://linkedin.com/user/aheadzen/','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('maplink'); ?>"><?php _e('Google/Bind Map URL','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('maplink'); ?>" name="<?php echo $this->get_field_name('maplink'); ?>" type="text" value="<?php echo esc_attr($maplink); ?>" />	
	</label>
	<br><small><?php _e('eg: https://www.google.com/maps/place/Jaipur,Rajasthan,India/','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('video'); ?>"><?php _e('Youtube/Vimeo Link','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('video'); ?>" name="<?php echo $this->get_field_name('video'); ?>" type="text" value="<?php echo esc_attr($video); ?>" />	
	</label>
	<br><small><?php _e('eg: http://youtube.com/aheadzen/','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('eml'); ?>"><?php _e('Contact Email Address','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('eml'); ?>" name="<?php echo $this->get_field_name('eml'); ?>" type="text" value="<?php echo esc_attr($eml); ?>" />	
	</label>
	<br><small><?php _e('eg: info@aheadzen.com','aheadzen');?></small>
	</p>
	<?php
	}}
	register_widget('aheadzen_social_widget');
}


/********************************************************
TEXT WIDGET
********************************************************/
if(!class_exists('aheadzen_text_widget')){
	class aheadzen_text_widget extends WP_Widget {
		function aheadzen_text_widget() {
		//Constructor
			$widget_ops = array('classname' => 'aheadzen_text', 'description' =>__('Text widget','aheadzen'));		
			$this->WP_Widget('aheadzen_text',__('my: Text','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$desc = empty($instance['desc']) ? '' : $instance['desc'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];
			$withoutborder = empty($instance['withoutborder']) ? '' : $instance['withoutborder'];
			$addparagraphs = empty($instance['addparagraphs']) ? '' : $instance['addparagraphs'];
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($desc==''){$desc='Hello this is sample content for you. Your description for the content are can be editable from here.';}
		
			}
			
			if($withoutborder)
			{				
				$before_widget = str_replace('content-main','content-main-none',$before_widget);
			}
			echo $before_widget;			
			?>
			<div class="container">
			<div class="margin10"></div>
			<?php if($title){ echo '<h3 '.aheadzen_inline_edit_code($this->get_field_id('title')).' class="'.$titlesize.'">'.$title.'</h3>'; ?>
			<?php aheadzen_inline_head_tinymce($this->get_field_id('title'));?>
			<?php }?>
			<?php if($desc){?>
			<?php 
			if($addparagraphs){
			$desc = nl2br($desc);
			}
			echo '<p '.aheadzen_inline_edit_code($this->get_field_id('desc')).'>'.$desc.'</p>';
			?>
			<?php aheadzen_inline_tinymce($this->get_field_id('desc'));?>
			<?php }?>
			<div class="margin10"></div>
			</div>
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
			$title = ($instance['title']);
			$titlesize = ($instance['titlesize']);
			$desc = ($instance['desc']);
			$withoutborder = ($instance['withoutborder']);
			$addparagraphs = ($instance['addparagraphs']);
			
		 
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />	
	</label></p>	
	
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize'),$this->get_field_name('titlesize'),$titlesize);
	?>
    
	<p><label for="<?php  echo $this->get_field_id('withoutborder'); ?>">
	<input class="widefat" id="<?php  echo $this->get_field_id('withoutborder'); ?>" name="<?php echo $this->get_field_name('withoutborder'); ?>" type="checkbox" value="1" <?php if($withoutborder){echo 'checked';}?>  />
	<?php _e('Show Data without borders (simple inner html only)?','aheadzen');?>	
	</label></p>
	
    <p><label for="<?php  echo $this->get_field_id('desc'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo esc_attr($desc); ?></textarea> 
	</label></p>
	
	<p><label for="<?php  echo $this->get_field_id('addparagraphs'); ?>">
	<input class="widefat" id="<?php  echo $this->get_field_id('addparagraphs'); ?>" name="<?php echo $this->get_field_name('addparagraphs'); ?>" type="checkbox" value="1" <?php if($addparagraphs){echo 'checked';}?>  />
	<?php _e('Automatically add paragraphs','aheadzen');?>	
	</label></p>
    
	<?php
	}}
	register_widget('aheadzen_text_widget');
}


/********************************************************
LOGO WIDGET
********************************************************/
if(!class_exists('aheadzen_logo_widget')){
	class aheadzen_logo_widget extends WP_Widget {
		function aheadzen_logo_widget() {
		//Constructor
			$widget_ops = array('classname' => 'aheadzen_logo', 'description' =>__('Site Logo widget','aheadzen'));		
			$this->WP_Widget('aheadzen_logo',__('my: Site Logo','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$mimg = empty($instance['mimg']) ? '' : $instance['mimg'];
			$wmimg = empty($instance['wmimg']) ? '150' : $instance['wmimg'];
			$hmimg = empty($instance['hmimg']) ? '71' : $instance['hmimg'];
			$sitename = empty($instance['sitename']) ? get_bloginfo('name') : $instance['sitename'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];
			$description = empty($instance['description']) ? get_bloginfo( 'description' ) : $instance['description'];
			$hide_description = empty($instance['hide_description']) ? '' : $instance['hide_description'];
			
			$mimg_arr1 = aheadzen_get_image_name_attchment_id($mimg);
			$mimg=$mimg_arr1[0];
			$attachment_id1=$mimg_arr1[1];
			
			echo $before_widget;		
			?>
			<div id="logo">
			<a href="<?php if(aheadzen_is_editing()){echo '#';}else{echo esc_url( home_url( '/' ) );} ?>" class="alogo">
			<?php if($mimg){?>
			<img <?php echo aheadzen_inline_edit_code($this->get_field_id('mimg'));?> class="site_logo_img" style="<?php if($hmimg){echo 'max-height:'.$hmimg.'px;';}?> <?php if($wmimg){echo 'max-width:'.$wmimg.'px;';}?>" src="<?php echo $mimg;?>" alt="" />
			<?php
			aheadzen_inline_image($this->get_field_id('mimg'));
			}
			if(is_home() || is_front_page()){?>
			<h1 <?php echo aheadzen_inline_edit_code($this->get_field_id('sitename'));?>  class="site-title <?php echo $titlesize;?>" ><?php echo $sitename;?></h1>
			<?php }else{?>
			<h2 <?php echo aheadzen_inline_edit_code($this->get_field_id('sitename'));?> class="site-title <?php echo $titlesize;?>"><?php echo $sitename;?></h2>
			<?php }?>
			<?php aheadzen_inline_head_tinymce($this->get_field_id('sitename'));?>
			</a>
			<h5 class="site-description" <?php if($hide_description){echo 'style="display:none;"';}else{ echo aheadzen_inline_edit_code($this->get_field_id('description')); }?>><?php echo $description; ?></h5>
			<?php aheadzen_inline_head_tinymce($this->get_field_id('description'));?>
		</div>			
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
			$mimg = ($instance['mimg']);
			$wmimg = ($instance['wmimg']);
			$hmimg = ($instance['hmimg']);
			$sitename = ($instance['sitename']);
			$description = ($instance['description']);
			$hide_description = ($instance['hide_description']);
			if(!$sitename){$sitename=get_bloginfo('name');}
			if(!$description){$description=get_bloginfo('description');}
			$titlesize = ($instance['titlesize']);
			if(!$wmimg){$wmimg=150;}
			if(!$hmimg){$hmimg=71;}
	?>
	<?php
	aheadzen_title_image_select_dl_fun($this->get_field_id('mimg'),$this->get_field_name('mimg'),$mimg,__('Main Image','aheadzen'));
	?>
	<p><label>
	<?php _e('Logo dimensions 150 x 70 (in pixels)','aheadzen');?>: 
	</label></p>
	<p>
	<input class="widefat wming" style="width:50px;" id="<?php  echo $this->get_field_id('wmimg'); ?>" name="<?php echo $this->get_field_name('wmimg'); ?>" type="text" value="<?php echo esc_attr($wmimg); ?>" />	
	<span class="hwmingx">&nbsp;&nbsp;X&nbsp;&nbsp;</span>
	<input class="widefat hming" style="width:50px;" id="<?php  echo $this->get_field_id('hmimg'); ?>" name="<?php echo $this->get_field_name('hmimg'); ?>" type="text" value="<?php echo esc_attr($hmimg); ?>" />	
	<div style="width:100%;clear:both;"></div>
	<small><?php _e('eg: WIDTH  X HEIGH','aheadzen');?></small>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('sitename'); ?>">
	<?php _e('Logo Text','aheadzen');?>: 
	<input class="widefat" id="<?php  echo $this->get_field_id('sitename'); ?>" name="<?php echo $this->get_field_name('sitename'); ?>" type="text" value="<?php echo esc_attr($sitename); ?>" />	
	</label>
	</p>
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize'),$this->get_field_name('titlesize'),$titlesize);
	?>
	<p><label for="<?php  echo $this->get_field_id('description'); ?>">
	<?php _e('Site Tagline','aheadzen');?>: 
	<input class="widefat" id="<?php  echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text" value="<?php echo esc_attr($description); ?>" />	
	</label>
	</p>
	
	<p><label for="<?php  echo $this->get_field_id('hide_description'); ?>">
	<input class="widefat" id="<?php  echo $this->get_field_id('hide_description'); ?>" name="<?php echo $this->get_field_name('hide_description'); ?>" type="checkbox" value="1" <?php if($hide_description){echo 'checked';}?>  />
	<?php _e('Hide Tagline?','aheadzen');?>	
	</label></p>
    
	<?php
	}}
	register_widget('aheadzen_logo_widget');
}



/********************************************************
MIAGE GALLERY WIDGET
********************************************************/
if(!class_exists('aheadzen_gallery_widget')){
	class aheadzen_gallery_widget extends WP_Widget {
		function aheadzen_gallery_widget() {
		//Constructor
			$widget_ops = array('classname' => 'aheadzen_gallery', 'description' =>__('Photo Gallery widget','aheadzen'));		
			$this->WP_Widget('aheadzen_gallery',__('my: Photo Gallery','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$description = empty($instance['description']) ? $instance['description'] : $instance['description'];
			$images = empty($instance['images']) ? '' : $instance['images'];
			$align = empty($instance['align']) ? '' : $instance['align'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($description==''){$description='Hello this is sample content for you. Your description for the content are can be editable from here.';}
			
			}
			
			echo $before_widget;
			?>
			<?php if($title){?>
            <h2 class="border-title <?php echo $align.' '.$titlesize;?>"><font <?php echo aheadzen_inline_edit_code($this->get_field_id('title'));?>><?php echo $title;?></font><span></span></h2>
			<div class="margin30"></div>
            <?php aheadzen_inline_head_tinymce($this->get_field_id('title'));?>
			<?php }?>
			<?php if($description){?>
			<div class="desc" <?php echo aheadzen_inline_edit_code($this->get_field_id('description'));?>>
			<?php echo $description;?>
			</div>
			<div class="margin20"></div>
			<?php aheadzen_inline_tinymce($this->get_field_id('description'));?>
			<?php }?>
			<div id="<?php  echo $this->get_field_id('thumb-wrapper'); ?>" data-animation="pulse" class="portfolio-container animate isotope pulse">
				<?php if($images){
					$images_arr = explode(',',$images);
					for($i=0;$i<count($images_arr);$i++)
					{
						$big_image = wp_get_attachment_url($images_arr[$i]);
						$small_image = wp_get_attachment_link($images_arr[$i], 'medium');
				?>
				<div class="portfolio one-third column imagegallery">
					<div class="portfolio-thumb">
					<?php /*?><img width="463" height="400" src="<?php echo $small_image;?>"><?php */?>
					<?php echo $small_image;?>
					<div class="image-overlay">
						<a data-gal="prettyPhoto[<?php echo $this->get_field_id('images');?>]" class="zoom" href="<?php echo $big_image;?>"><span class="icon-search"></span></a>
					</div>
					</div>
				</div>  
				<?php 
					}
				}?>
				
			</div>
			<script>
				//ISOTOPE...	
				var $pphoto = jQuery('a[data-gal^="prettyPhoto[<?php echo $this->get_field_id('images');?>]"]');
				if($pphoto.length){
					//PRETTYPHOTO...
					jQuery("a[data-gal^='prettyPhoto[<?php echo $this->get_field_id('images');?>]']").prettyPhoto({ 
						show_title: false,
						social_tools: false,
						deeplinking: false
					});
				}
				</script>
				<?php
				if(aheadzen_is_editing())
				{
				?>
				<input style="display:none;" class="widefat" id="<?php  echo $this->get_field_id('images'); ?>" name="<?php echo $this->get_field_name('images'); ?>" type="text" value="<?php echo esc_attr($images); ?>" />	
				<div style="clear:both;width:100%;display:inline-block;">
				<a class="gallery_upload_button"  href="javascript:void(0);" onclick="widget_image_button_gallery('<?php  echo $this->get_field_id('btn_upload'); ?>','<?php  echo $this->get_field_id('images'); ?>','<?php  echo $this->get_field_id('thumb-wrapper'); ?>');" id="<?php  echo $this->get_field_id('btn_upload'); ?>">Photo Gallery Settings</a>
				</div>
				<?php
				}
				?>
				<div class="margin20"></div>
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
			
			$title = ($instance['title']);
			$description = ($instance['description']);
			$images = ($instance['images']);
			$align = ($instance['align']);
			$titlesize = ($instance['titlesize']);
			
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />	
	</label></p>
	<?php 
	aheadzen_title_text_align_dl_fun($this->get_field_id('align'),$this->get_field_name('align'),$align);
	?>   
	<?php
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize'),$this->get_field_name('titlesize'),$titlesize);
	?>
	<p><label for="<?php  echo $this->get_field_id('description'); ?>">
	<textarea class="widefat" id="<?php  echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo $description;?></textarea>
	</label></p>
	
    <p><label for="<?php  echo $this->get_field_id('images'); ?>">
	<input style="display:none;" class="widefat" id="<?php  echo $this->get_field_id('images'); ?>" name="<?php echo $this->get_field_name('images'); ?>" type="text" value="<?php echo esc_attr($images); ?>" />	
	</label>
	<a class="gallery_upload_button"  href="javascript:void(0);" onclick="widget_image_button('<?php  echo $this->get_field_id('btn_upload'); ?>','<?php  echo $this->get_field_id('images'); ?>','<?php  echo $this->get_field_id('thumb-wrapper'); ?>');" id="<?php  echo $this->get_field_id('btn_upload'); ?>">Upload Media Gallery</a>
	<div id="<?php  echo $this->get_field_id('thumb-wrapper'); ?>">
	<?php if($images){
		global $wpdb;
		$upload_dir = wp_upload_dir();
		$images_arr = explode(',',$images);
		if($images_arr)
		{
			for($i=0;$i<count($images_arr);$i++)
			{
				$imgsrc = get_post_meta($images_arr[$i],'_wp_attached_file',true);
				if($imgsrc){
					$src = $upload_dir['baseurl'].'/'.$imgsrc;
					echo '<img src="'.$src.'" alt="" />';
				}
				
			}
		}
	}?>
	</div>
	</p>
	<style>
	.gallery_upload_button{background-color: #ddd;display: inline-block;font-weight: bold;margin: 5px;padding: 10px;text-decoration: none;}
	#<?php  echo $this->get_field_id('thumb-wrapper'); ?>{clear: both;display: inline-block;width: 100%;}
	#<?php  echo $this->get_field_id('thumb-wrapper'); ?> img{border: 2px solid #ccc;float: left;margin: 5px;width: 50px;}
	</style>
	<?php
	}}
	register_widget('aheadzen_gallery_widget');
}



/********************************************************
IMAGE SLIDER WIDGET
********************************************************/
if(!class_exists('aheadzen_image_slider_widget')){
	class aheadzen_image_slider_widget extends WP_Widget {
		function aheadzen_image_slider_widget() {
		//Constructor
			$widget_ops = array('classname' => 'aheadzen_image_slider', 'description' =>__('Image Slider widget','aheadzen'));		
			$this->WP_Widget('image_slider',__('my: Image Slider','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];	
			$align = empty($instance['align']) ? '' : $instance['align'];
			
			$mimg1 = empty($instance['mimg1']) ? '' : $instance['mimg1'];
			$mimg2 = empty($instance['mimg2']) ? '' : $instance['mimg2'];
			$mimg3 = empty($instance['mimg3']) ? '' : $instance['mimg3'];
			$mimg4 = empty($instance['mimg4']) ? '' : $instance['mimg4'];
			$mimg5 = empty($instance['mimg5']) ? '' : $instance['mimg5'];
			$wmimg = empty($instance['wmimg']) ? '100%' : $instance['wmimg'];
			$hmimg = empty($instance['hmimg']) ? 'auto' : $instance['hmimg'];
			
			$mimg_arr1 = aheadzen_get_image_name_attchment_id($mimg1);
			$mimg1=$mimg_arr1[0];
			$attachment_id1=$mimg_arr1[1];
			
			$mimg_arr2 = aheadzen_get_image_name_attchment_id($mimg2);
			$mimg2=$mimg_arr2[0];
			$attachment_id2=$mimg_arr2[1];
			
			$mimg_arr3 = aheadzen_get_image_name_attchment_id($mimg3);
			$mimg3=$mimg_arr3[0];
			$attachment_id3=$mimg_arr3[1];
			
			$mimg_arr4 = aheadzen_get_image_name_attchment_id($mimg4);
			$mimg4=$mimg_arr4[0];
			$attachment_id4=$mimg_arr4[1];
			
			$mimg_arr5 = aheadzen_get_image_name_attchment_id($mimg5);
			$mimg5=$mimg_arr5[0];
			$attachment_id5=$mimg_arr5[1];
			
			if($_GET['editing']){
				if($mimg1==''){$mimg1=get_template_directory_uri().'/images/select_image.png';}
				if($mimg2==''){$mimg2=get_template_directory_uri().'/images/select_image.png';}
				if($mimg3==''){$mimg3=get_template_directory_uri().'/images/select_image.png';}
				if($mimg4==''){$mimg4=get_template_directory_uri().'/images/select_image.png';}
				if($mimg5==''){$mimg5=get_template_directory_uri().'/images/select_image.png';}
			}
			
			$withoutborder = empty($instance['withoutborder']) ? '' : $instance['withoutborder'];
			if($withoutborder)
			{				
				$before_widget = str_replace('content-main','content-main-none',$before_widget);
			}
			echo $before_widget;
			?>
            <?php if($title){?>
            <h2 class="border-title <?php echo $titlesize.' '.$align;?>"><font <?php echo aheadzen_inline_edit_code($this->get_field_id('title'));?>><?php echo $title;?></font><span></span></h2>
			<div class="margin30"></div>
            <?php aheadzen_inline_head_tinymce($this->get_field_id('title'));?>
			<?php }?>
		
			<div id="<?php echo $this->get_field_id('id');?>" class="slideshow">
				<ul class="bjqs">
				  <li><?php if($mimg1){?>
					<img <?php echo aheadzen_inline_edit_code($this->get_field_id('mimg1'));?> style="<?php if($hmimg){echo 'max-height:'.$hmimg.';';}?> <?php if($wmimg){echo 'max-width:'.$wmimg.';';}?>" src="<?php echo $mimg1;?>" alt="" />
					<?php
					}
					aheadzen_inline_image($this->get_field_id('mimg1'),$attachment_id1);
					?>
					</li>
					<?php if($mimg2){?>
					<li>
					<img <?php echo aheadzen_inline_edit_code($this->get_field_id('mimg2'));?> style="<?php if($hmimg){echo 'max-height:'.$hmimg.';';}?> <?php if($wmimg){echo 'max-width:'.$wmimg.';';}?>" src="<?php echo $mimg2;?>" alt="" />
					<?php aheadzen_inline_image($this->get_field_id('mimg2'),$attachment_id2);?>
					</li>
					<?php
					}?>
					<?php if($mimg3){?>
					<li>
					<img <?php echo aheadzen_inline_edit_code($this->get_field_id('mimg3'));?> style="<?php if($hmimg){echo 'max-height:'.$hmimg.';';}?> <?php if($wmimg){echo 'max-width:'.$wmimg.';';}?>" src="<?php echo $mimg3;?>" alt="" />
					<?php aheadzen_inline_image($this->get_field_id('mimg3'),$attachment_id3);?>
					</li>
					<?php }?>					
					<?php if($mimg4){?>
					<li><img <?php echo aheadzen_inline_edit_code($this->get_field_id('mimg4'));?> style="<?php if($hmimg){echo 'max-height:'.$hmimg.';';}?> <?php if($wmimg){echo 'max-width:'.$wmimg.';';}?>" src="<?php echo $mimg4;?>" alt="" />
					<?php aheadzen_inline_image($this->get_field_id('mimg4'),$attachment_id4);?>
					</li>
					<?php
					}?>					
					<?php if($mimg5){?>
					<li>
					<img <?php echo aheadzen_inline_edit_code($this->get_field_id('mimg5'));?> style="<?php if($hmimg){echo 'max-height:'.$hmimg.';';}?> <?php if($wmimg){echo 'max-width:'.$wmimg.';';}?>" src="<?php echo $mimg5;?>" alt="" />
					<?php aheadzen_inline_image($this->get_field_id('mimg5'),$attachment_id5);?>
					</li>
					<?php
					}?>					
				</ul>			
		</div>
<script class="secret-source">
jQuery(document).ready(function($) {
  jQuery('#<?php echo $this->get_field_id('id');?>').bjqs({
	height      : 320,
	width       : '100%',
	responsive  : true
  });

});
</script>		
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
			$mimg1 = ($instance['mimg1']);
			$mimg2 = ($instance['mimg2']);
			$mimg3 = ($instance['mimg3']);
			$mimg4 = ($instance['mimg4']);
			$mimg5 = ($instance['mimg5']);
			$wmimg = ($instance['wmim']);
			$hmimg = ($instance['hmimg']);
			
			$title = ($instance['title']);
			$titlesize = strip_tags($instance['titlesize']);
			$align = strip_tags($instance['align']);
			
			if(!$wmimg){$wmimg='100%';}
			if(!$hmimg){$hmimg='auto';}
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />	
	</label></p>	
	<?php 
	aheadzen_title_text_align_dl_fun($this->get_field_id('align'),$this->get_field_name('align'),$align);
	aheadzen_title_font_size_dl_fun($this->get_field_id('titlesize'),$this->get_field_name('titlesize'),$titlesize);
	aheadzen_title_image_select_dl_fun($this->get_field_id('mimg1'),$this->get_field_name('mimg1'),$mimg1,__('Select Image','aheadzen'));
	aheadzen_title_image_select_dl_fun($this->get_field_id('mimg2'),$this->get_field_name('mimg2'),$mimg2,__('Select Image','aheadzen'));
	aheadzen_title_image_select_dl_fun($this->get_field_id('mimg3'),$this->get_field_name('mimg3'),$mimg3,__('Select Image','aheadzen'));
	aheadzen_title_image_select_dl_fun($this->get_field_id('mimg4'),$this->get_field_name('mimg4'),$mimg4,__('Select Image','aheadzen'));
	aheadzen_title_image_select_dl_fun($this->get_field_id('mimg5'),$this->get_field_name('mimg5'),$mimg5,__('Select Image','aheadzen'));

	}}
	register_widget('aheadzen_image_slider_widget');
}




/********************************************************
WHAT WE PROVIDE WIDGET
********************************************************/
if(!class_exists('aheadzen_what_provide_widget')){
	class aheadzen_what_provide_widget extends WP_Widget {
		function aheadzen_what_provide_widget() {
		//Constructor
			$widget_ops = array('classname' => 'what_provide', 'description' =>__('What We Provide - Tabs Display','aheadzen'));		
			$this->WP_Widget('what_provide',__('my: Tabs for We Provide','aheadzen'), $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : $instance['title'];
			$titlesize = empty($instance['titlesize']) ? '' : $instance['titlesize'];
			$align = empty($instance['align']) ? '' : $instance['align'];
			
			$title1 = empty($instance['title1']) ? '' : $instance['title1'];
			$desc1 = empty($instance['desc1']) ? '' : $instance['desc1'];
			
			$title2 = empty($instance['title2']) ? '' : $instance['title2'];
			$desc2 = empty($instance['desc2']) ? '' : $instance['desc2'];
			
			$title3 = empty($instance['title3']) ? '' : $instance['title3'];
			$desc3 = empty($instance['desc3']) ? '' : $instance['desc3'];
			
			$title4 = empty($instance['title4']) ? '' : $instance['title4'];
			$desc4 = empty($instance['desc4']) ? '' : $instance['desc4'];
			
			if(aheadzen_is_editing())
			{
				if($title==''){$title='Edit The Title Here';}
				if($title1==''){$title1='Edit Sub Title Here';}
				if($title2==''){$title2='Edit Sub Title Here';}
				if($title3==''){$title3='Edit Sub Title Here';}
				if($title4==''){$title4='Edit Sub Title Here';}
				
				if($desc1==''){$desc1='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc2==''){$desc2='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc3==''){$desc3='Hello this is sample content for you. Your description for the content are can be editable from here.';}
				if($desc4==''){$desc4='Hello this is sample content for you. Your description for the content are can be editable from here.';}
			}
			
			$withoutborder = empty($instance['withoutborder']) ? '' : $instance['withoutborder'];
			if($withoutborder)
			{				
				$before_widget = str_replace('content-main','content-main-none',$before_widget);
			}
			echo $before_widget;
			?>
            <?php if($title){?>
            <h2 class="border-title <?php echo $titlesize.' '.$align;?>"><font <?php echo aheadzen_inline_edit_code($this->get_field_id('title'));?>><?php echo $title;?></font><span></span></h2>
            <div class="margin15"></div>
            <?php aheadzen_inline_head_tinymce($this->get_field_id('title'));?>
			<?php }?>
			<div class="tabs-vertical-container">
                <ul class="tabs-vertical-frame<?php echo $_GET['editing'];?> one-third column">
                    <?php if($title1){?>
					<li><a href="#" > <span> 1</span> <div <?php echo aheadzen_inline_edit_code($this->get_field_id('title1'));?>><?php echo $title1;?></div> </a></li>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title1'));?>
					<?php }?>
					<?php if($title2){?>
                    <li><a href="#"> <span> 2</span> <div <?php echo aheadzen_inline_edit_code($this->get_field_id('title2'));?>><?php echo $title2;?></div> </a></li>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title2'));?>
					<?php }?>
					<?php if($title3){?>
                    <li><a href="#"> <span> 3</span> <div <?php echo aheadzen_inline_edit_code($this->get_field_id('title3'));?>><?php echo $title3;?></div> </a></li>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title3'));?>
					<?php }?>
					<?php if($title4){?>
                    <li><a href="#"> <span> 4</span> <div <?php echo aheadzen_inline_edit_code($this->get_field_id('title4'));?>><?php echo $title4;?></div> </a></li>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title4'));?>
					<?php }?>
                </ul>
                <div class="tabs-vertical-frame-content two-third column last">
					<h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title1'));?>> <?php echo $title1;?></h3>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title1'));?>
					<div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc1'));?>><?php echo nl2br($desc1);?></div>
					<?php aheadzen_inline_tinymce($this->get_field_id('desc1'));?>
                </div>
                <div class="tabs-vertical-frame-content two-third column last">
                    <h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title2'));?>> <?php echo $title2;?> </h3>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title2'));?>
					<div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc2'));?>><?php echo nl2br($desc2);?></div>
					<?php aheadzen_inline_tinymce($this->get_field_id('desc2'));?>
                </div>
                <div class="tabs-vertical-frame-content two-third column last">
                    <h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title3'));?>> <?php echo $title3;?> </h3>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title3'));?>
					 <div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc3'));?>><?php echo nl2br($desc2);?></div>
					 <?php aheadzen_inline_tinymce($this->get_field_id('desc3'));?>
                </div>
                <div class="tabs-vertical-frame-content two-third column last">
					<h3 <?php echo aheadzen_inline_edit_code($this->get_field_id('title4'));?>> <?php echo $title4;?> </h3>
					<?php aheadzen_inline_head_tinymce($this->get_field_id('title4'));?>
					<div <?php echo aheadzen_inline_edit_code($this->get_field_id('desc4'));?>><?php echo nl2br($desc3);?></div>
					<?php aheadzen_inline_tinymce($this->get_field_id('desc4'));?>
                </div>
                
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
			$title = ($instance['title']);
			$titlesize = strip_tags($instance['titlesize']);
			$align = strip_tags($instance['align']);
			
			$title1 = ($instance['title1']);
			$desc1 = ($instance['desc1']);
			
			$title2 = ($instance['title2']);
			$desc2 = ($instance['desc2']);
			
			$title3 = ($instance['title3']);
			$desc3 = ($instance['desc3']);
			
			$title4 = ($instance['title4']);
			$desc4 = ($instance['desc4']);
			
			$withoutborder = ($instance['withoutborder']);
			
		
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
	
    <h2><?php _e('Tab 1 Content','aheadzen');?></h2>
    <p><label for="<?php  echo $this->get_field_id('title1'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title1'); ?>" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo esc_attr($title1); ?>" />	
	</label>
	<br><small><?php _e('keep blank to hide the complete section.','aheadzen');?></small>
	</p>
    
    <p><label for="<?php  echo $this->get_field_id('desc1'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc1'); ?>" name="<?php echo $this->get_field_name('desc1'); ?>"><?php echo esc_attr($desc1); ?></textarea> 
	</label></p>
    
    
     <h2><?php _e('Tab 2 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('title2'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo esc_attr($title2); ?>" />	
	</label>
	<br><small><?php _e('keep blank to hide the complete section.','aheadzen');?></small>
	</p>
    
    <p><label for="<?php  echo $this->get_field_id('desc2'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc2'); ?>" name="<?php echo $this->get_field_name('desc2'); ?>"><?php echo esc_attr($desc2); ?></textarea> 
	</label></p>
    
    
    <h2><?php _e('Tab 3 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('title3'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title3'); ?>" name="<?php echo $this->get_field_name('title3'); ?>" type="text" value="<?php echo esc_attr($title3); ?>" />	
	</label>
	<br><small><?php _e('keep blank to hide the complete section.','aheadzen');?></small>
	</p>
    
    <p><label for="<?php  echo $this->get_field_id('desc3'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc3'); ?>" name="<?php echo $this->get_field_name('desc3'); ?>"><?php echo esc_attr($desc3); ?></textarea> 
	</label></p>
    
    
    <h2><?php _e('Tab 4 Content','aheadzen');?></h2>
     <p><label for="<?php  echo $this->get_field_id('title4'); ?>"><?php _e('Title','aheadzen');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title4'); ?>" name="<?php echo $this->get_field_name('title4'); ?>" type="text" value="<?php echo esc_attr($title4); ?>" />	
	</label>
	<br><small><?php _e('keep blank to hide the complete section.','aheadzen');?></small>
	</p>
    
    <p><label for="<?php  echo $this->get_field_id('desc4'); ?>"><?php _e('Description','aheadzen');?>:
    <textarea class="widefat" id="<?php  echo $this->get_field_id('desc4'); ?>" name="<?php echo $this->get_field_name('desc4'); ?>"><?php echo esc_attr($desc4); ?></textarea> 
	</label></p>
    
   	<?php
	}}
	register_widget('aheadzen_what_provide_widget');
}
?>