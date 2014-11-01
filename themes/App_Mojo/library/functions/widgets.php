<?php
/********************************************************
	SIDEBARS
********************************************************/
if ( function_exists('register_sidebar') )
{
	register_sidebar(array(
	'id' => 'logoarea',
	'name' => __('Logo Section','aheadzen'),
    'before_widget' => '<div id="%1$s" class="aheadzensite logoarea %2$s">',
    'after_widget' => '</div>',
	'before_title' => '<h2>',
    'after_title' => '</h2>',	
    ));
	
	register_sidebar(array(
	'id' => 'sliders',
	'name' => __('Slider Section','aheadzen'),
    'before_widget' => '<div wgroup="sliders" id="%1$s" class="aheadzensite topheader %2$s">',
    'after_widget' => '</div>',
	'before_title' => '<h2>',
    'after_title' => '</h2>',	
    ));
	
	register_sidebar(array(
	'id' => 'content1',
	'name' => __('Content Area','aheadzen'),
    'before_widget' => '<div wgroup="content1" id="%1$s" class="aheadzensite content-main"><div class="container">',
    'after_widget' => '</div></div>',
	'before_title' => '<h2>',
    'after_title' => '</h2>',	
    ));
	
	$sidebars_widgets=get_option('sidebars_widgets');
	$footercount = count($sidebars_widgets['footer']);
	if(isset($footercount))
	{
		if($footercount==1)
		{
			$before_widget = '<div wgroup="footer" id="%1$s" class="aheadzensite full footer_widget_col1">';
			$after_widget = '</div>';
		}elseif($footercount==2)
		{
			$before_widget = '<div wgroup="footer" id="%1$s" class="aheadzensite one-half column footer_widget_col2">';
			$after_widget = '</div>';
		}elseif($footercount==3)
		{
			$before_widget = '<div wgroup="footer" id="%1$s" class="aheadzensite one-third column footer_widget_col3">';
			$after_widget = '</div>';
		}elseif($footercount==4)
		{
			$before_widget = '<div wgroup="footer" id="%1$s" class="aheadzensite one-fourth column footer_widget_col4">';
			$after_widget = '</div>';
		}else
		{
			$before_widget = '<div wgroup="footer" id="%1$s" class="aheadzensite one-fourth column footer_widget_col4">';
			$after_widget = '</div>';
		}
	}
	
	register_sidebar(array(
	'id' => 'footer',
	'name' => __('Footer','aheadzen'),
    'before_widget' => $before_widget,
    'after_widget' => $after_widget,
	'before_title' => '<h2>',
    'after_title' => '</h2>',	
    ));

}

add_filter('sidebar_right_widget','sidebar_right_widget_fn');
function sidebar_right_widget_fn($sidebar)
{
	$sidebar='sidebar';
	return $sidebar;
}



/**************************************
**************************************/
function aheadzen_title_font_size_dl_fun($varid,$varname,$titlesize='')
{
	 global  $title_font_size_arr;
	?>
	<p><label for="<?php  echo $varid; ?>"><?php _e('Select Title Size','aheadzen');?>: 
    </label>
	<div style="width:100%;"></div>
	<style>
	.myselected{border:solid 2px red;}
	.hugefonts {width: auto;display: inline-block;min-height: 65px;min-width: 65px;text-align: center;background-position: center bottom;background-repeat: no-repeat;}
	.largefonts {width: auto;display: inline-block;min-height: 52px;min-width: 52px;text-align: center;background-position: center bottom;background-repeat: no-repeat;}
	.mediumfonts {width: auto;display: inline-block;min-height: 35px;min-width: 35px;text-align: center;background-position: center bottom;background-repeat: no-repeat;}
	.normalfonts {width: auto;display: inline-block;min-height: 26px;min-width: 26px;text-align: center;background-position: center bottom;background-repeat: no-repeat;}
	.smallfonts {width: auto;display: inline-block;min-height: 18px;min-width: 18px;text-align: center;background-position: center bottom;background-repeat: no-repeat;}
	</style>
	<script>
	function set_selection(val,hidden_id)
	{
		jQuery('#'+hidden_id).val(val);
		jQuery('.'+hidden_id).removeClass( "myselected" );
		jQuery('.'+hidden_id+'.'+val).addClass( "myselected" );		
	}
	</script>
	<input class="widefat" id="<?php  echo $varid; ?>" name="<?php echo $varname; ?>" type="hidden" value="<?php echo esc_attr($titlesize); ?>" />
	
	<?php foreach($title_font_size_arr as $key=>$val){?>
    <label onclick="set_selection('<?php echo $key;?>','<?php echo $varid; ?>')" class="<?php echo $varid; ?> <?php echo $key;?> <?php if($titlesize==$key){echo 'myselected';}?>" style="background-image: url('<?php echo $val;?>');">
	</label>
	<?php }?>
   </p>
   <?php
}

/**************************************
**************************************/
function aheadzen_title_text_align_dl_fun($varid,$varname,$align='')
{
	 global  $title_text_align_arr;
	 ?>
	 <p><label for="<?php  echo $varid; ?>"><?php _e('Select Title Alignment','aheadzen');?>: 
    </label>
	<div style="width:100%;"></div>
	<style>
	.myselected{border:solid 2px red;}
	.option_leftalign {display: inline-block;height: 35px;width: 35px;text-align: center;background-position: center bottom;background-repeat: no-repeat;}
	.option_centeralign {display: inline-block;height: 35px;width: 35px;text-align: center;background-position: center bottom;background-repeat: no-repeat;}
	.option_rightalign {display: inline-block;height: 35px;width: 35px;text-align: center;background-position: center bottom;background-repeat: no-repeat;}
	</style>
	<script>
	function set_selection_align(val,hidden_id)
	{
		jQuery('#'+hidden_id).val(val);
		jQuery('.'+hidden_id).removeClass( "myselected" );
		jQuery('.'+hidden_id+'.option_'+val).addClass( "myselected" );	
	}
	</script>
	<input class="widefat" id="<?php  echo $varid; ?>" name="<?php echo $varname; ?>" type="hidden" value="<?php echo esc_attr($align); ?>" />
	
	<?php foreach($title_text_align_arr as $key=>$val){?>
    <label onclick="set_selection_align('<?php echo $key;?>','<?php echo $varid; ?>')" class="<?php echo $varid; ?> <?php echo 'option_'.$key;?> <?php if($align==$key){echo 'myselected';}?>" style="background-image: url('<?php echo $val;?>');">
	</label>
	<?php }?>	
   </p>
	 <?php
}

/**************************************
**************************************/
function aheadzen_title_image_select_dl_fun($varid,$varname,$mimg='',$title='')
{
?>
	<style>
	.widget_image_button {margin-left: 10px;float:left!important;padding: 5px !important; font-size: 14px !important;color: #000!important;}
	input[type="text"].myimgcss{float:left!important;width:200px;}
	.clearboth{width:100%; clear:both;}
	<?php if(!aheadzen_is_editing()){?>
	.widget_image_button {margin-left:5px;padding:0 !important;}
	<?php }?>
	<?php
	if(filter_var($mimg, FILTER_VALIDATE_URL)){ 
	  // you're good
	}else{
		$attachment_id = $mimg;
		$mimg_arr = wp_get_attachment_image_src( $mimg,'large');
		if($mimg_arr){$mimg = $mimg_arr[0];}
	}
	?>
	</style>
	<p><label for="<?php  echo $varid; ?>"><?php echo $title;?>: </p>
	<div class="clearboth"></div>
	<input class="widefat myimgcss" id="<?php  echo $varid; ?>" name="<?php echo $varname; ?>" type="text" value="<?php echo esc_attr($mimg); ?>" />	
	<button onclick="widget_image_button('<?php echo $varid;?>','<?php  echo $varid; ?>');" class="widget_image_button myimgcss <?php echo $varid;?>"><?php _e('Select Image','aheadzen');?></button>
	<img id="<?php  echo $varid.'_img'; ?>" style="height: 40px;width: 40px; margin-left:10px;" src="<?php echo esc_attr($mimg); ?>" alt="" />
	</label>
	<div class="clearboth"></div>
<?php
}


// unregister all widgets
 function aheadzen_unregister_default_widgets() {
     //unregister_widget('WP_Widget_Pages');
     //unregister_widget('WP_Widget_Calendar');
     //unregister_widget('WP_Widget_Archives');
     //unregister_widget('WP_Widget_Links');
     //unregister_widget('WP_Widget_Meta');
     //unregister_widget('WP_Widget_Search');
     unregister_widget('WP_Widget_Text');
     //unregister_widget('WP_Widget_Categories');
     //unregister_widget('WP_Widget_Recent_Posts');
     //unregister_widget('WP_Widget_Recent_Comments');
     //unregister_widget('WP_Widget_RSS');
     //unregister_widget('WP_Widget_Tag_Cloud');
     //unregister_widget('WP_Nav_Menu_Widget');
     //unregister_widget('Twenty_Eleven_Ephemera_Widget');
 }
add_action('widgets_init', 'aheadzen_unregister_default_widgets', 11);
add_action('admin_head','aheadzen_admin_head_function');
 function aheadzen_admin_head_function()
 {
	?>
	<style>
	.widget-inside .edit_portfolio_front{ display:none;}
	</style>
	<?php
	if(strstr($_SERVER['REQUEST_URI'],'/widgets.php'))
	{
		wp_enqueue_media();
		wp_register_script('my-admin-js', get_template_directory_uri().'/js/my-admin.js', array('jquery'));
		wp_enqueue_script('my-admin-js');
		aheadzen_wp_head_tinymce_function();
	}
 }
 
add_action('wp_head','aheadzen_wp_head_tinymce_function');
function aheadzen_wp_head_tinymce_function()
{
	?>
	<!-- Font -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/fontIconPicker/icons/fontello-7275ca86/css/fontello.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/fontIconPicker/icons/icomoon/style.css" />
	<?php if(aheadzen_is_editing()){?>
	<style>
	font{display: inline-block;width: 100%;}
	img{cursor: -moz-grab;}
	.footer .aheadzensite{width: 100%;}
	.footer .aheadzensite:hover {border: 1px dashed #ccc;clear: both;padding-bottom: 10px;}
	</style>
	<?php }?>
	<?php
	if(aheadzen_is_editing() || is_admin()){
	//wp_enqueue_style (  'wp-jquery-ui-dialog');
	?>
	<!-- Place inside the <head> of your HTML -->
	<!-- Demo Scripts -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/fontIconPicker/icons/lib/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/fontIconPicker/icons/lib/js/shCore.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/fontIconPicker/icons/lib/js/brush/shBrushCss.js"></script>
	
	<!-- icon picker -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/fontIconPicker/jquery.fonticonpicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/fontIconPicker/css/jquery.fonticonpicker.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/fontIconPicker/themes/bootstrap-theme/jquery.fonticonpicker.bootstrap.min.css" />
	
	<?php /*?>
	<!-- Font -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/fontIconPicker/icons/fontello-7275ca86/css/fontello.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/fontIconPicker/icons/icomoon/style.css" />
	<?php */?>
	
	<!-- Init script for this DEMO -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/fontIconPicker/icons/demo.js"></script>
	
	
	
	<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" /> 
	
	<script type="text/javascript">
	
	jQuery(function(){
	
		//acknowledgement message
		var filed_val='';
		//inline delete code
		jQuery('div[wgroup]').each(function() {
			var sidebar_id = jQuery(this).attr("wgroup");
			var widget_id = jQuery(this).attr("id");
			jQuery(this).prepend( '<div class="widget_inline_del"><a class="icon-cancel-circled" href="javascript:void(0);" onclick="widget_delete_widget_inline(\''+sidebar_id+'\',\''+widget_id+'\')" title="remove this section"></a></div>' );
			jQuery(this).append( '<div class="widget_inline_add" widget="'+widget_id+'" sidebar="'+sidebar_id+'"><a class="icon-plus" href="javascript:void(0);" title="add new"> </a></div>' );
		});
		
		//inline edit code
		jQuery("[contenteditable=true]").focus(function(){
			filed_val = jQuery(this).html();
		});
		
		jQuery("[contenteditable=true]").blur(function(){
			var field_userid = jQuery(this).attr("id") ;
			var mywidget_id = jQuery("#"+field_userid).closest('.aheadzensite').attr('id');
			var val = jQuery(this).html();	
			if(filed_val!=val)
			{
				var ajax_url = '<?php echo site_url(); ?>';
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
		
						//alert(response);
					}else{
						jQuery( ".inline_edit_success_msg" ).html( '<span class="errormsg">Something wrong, try again...</span>' );
						setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
					}
				});
			}			
		});
	});

	
	function widget_delete_widget_inline(sidebar_id,widget_id)
	{
		//AJAX Remove (clear option value)
		
		var r = confirm("<?php _e('are you sure want to remove?','aheadzen')?>");
		if (r == true) {
			
		} else {
			return true;
		}
		
		var ajax_url = '<?php echo site_url(); ?>';
		
		var data = {
			'action': 'save-widget-front',
			'delete_widget': 1,
			'sidebar': sidebar_id,
			'widget-id': widget_id,
			'id_base': widget_id
		};
		
		jQuery.post(ajax_url, data, function(response) {
			if(response)
			{
				jQuery( ".inline_edit_success_msg" ).html( '<span>Deleted Successfully</span>' );
				jQuery('#'+widget_id).hide();
				setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
			}else{
				jQuery( ".inline_edit_success_msg" ).html( '<span class="errormsg">Something wrong, try again...</span>' );
				setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
			}
		});
		
	}
	
	function widget_image_button_inline(id)
	{
		jQuery("#"+id).live("click", function(e){
		var mywidget_id = jQuery("#"+id).closest('.aheadzensite').attr('id');
		var myuploader;
		  e.preventDefault();
		  if (myuploader) {
				myuploader.open();
				return;
			}
			
			//Extend the wp.media object
			myuploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Choose Image'
				},
				multiple: false
			});
			
			//When a file is selected, grab the URL and set it as the text field's value
			myuploader.on('select', function() {
				attachment = myuploader.state().get('selection').first().toJSON();
				jQuery('#'+id ).attr('src',attachment.url);
				jQuery( ".inline_edit_success_msg" ).html( '<span>Loading....</span>' );
				
				var ajax_url = '<?php echo site_url(); ?>';
				var field_userid = id;
				var data = {
					'action': 'inline-save-widget',
					//'val': attachment.url,
					//'attid': attachment.id,
					'val': attachment.id,
					'widget-id': mywidget_id,
					'field': field_userid
				};
					
				jQuery.post(ajax_url, data, function(response) {
					if(response=='saved_success')
					{						
						var iseditpost = field_userid.substring(0, 8);
						if(iseditpost=='editpost')
						{
							jQuery('#'+field_userid+' img').attr('src',attachment.url);
						}
						
						jQuery( ".inline_edit_success_msg" ).html( '<span>Updated Successfully</span>' );
						setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
					}else{
						jQuery( ".inline_edit_success_msg" ).html( '<span class="errormsg">Something wrong, try again...</span>' );
						setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
					}
				});
			});

			//Open the uploader dialog
			myuploader.open();
		});
	}
	
	function widget_image_delete_inline(id)
	{
		var mywidget_id = jQuery("#"+id).closest('.aheadzensite').attr('id');
		
		var ajax_url = '<?php echo site_url(); ?>';
		var field_userid = id;
		var data = {
			'action': 'inline-save-widget',
			'val': '',
			'widget-id': mywidget_id,
			'field': field_userid
		};
			
		jQuery.post(ajax_url, data, function(response) {
			if(response=='saved_success')
			{						
				jQuery('#'+field_userid).attr('src','');
				
				jQuery( ".inline_edit_success_msg" ).html( '<span>Updated Successfully</span>' );
				setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
			}else{
				jQuery( ".inline_edit_success_msg" ).html( '<span class="errormsg">Something wrong, try again...</span>' );
				setTimeout(function(){jQuery( ".inline_edit_success_msg" ).empty()}, 2000);
			}
		});
	
	}
	
	function toggle_edit_link_imgslider(id)
	{
		jQuery( ".editlink" ).click(function() {
			jQuery( "#"+id ).toggle( "slow", function() {
			// Animation complete.
			});
		});
	}
	
	jQuery(document).bind('edit_started', function(ev) { 
		
		var el = jQuery(ev.target);
		var current_widget_id = jQuery(el).attr("data-widget_id");
		var current_sidebar_id = jQuery(el).attr("data-sidebar_id");
		var current_data_type = jQuery(el).attr("data-type");
		
		jQuery(".fee-form.fee-type-widget .clearbothdiv").each(function(){
			jQuery( ".fee-field.fee-initialized .clearbothdiv" ).empty();
			//alert(jQuery( ".fee-field.fee-initialized .clearbothdiv" ).html());
		});
		
		jQuery(".fee-field.fee-initialized").each(function(){
			var widget_id = jQuery(this).attr("data-widget_id");
			var sidebar_id = jQuery(this).attr("data-sidebar_id");
			var data_type = jQuery(this).attr("data-type");	
			if(widget_id==current_widget_id){
				//jQuery( ".fee-field.fee-initialized" ).next().append( '<div class="clearbothdiv"><a class="front_widget_delete_link button small animate bounceIn rightalign" href="<?php echo site_url();?>/?widget='+widget_id+'&sidebar='+sidebar_id+'">Delete this Section</a></div>' );
				
				//AJAX Remove (clear option value)
			jQuery('.front_widget_delete_link').click(function(){
			
					var ajax_url = '<?php echo site_url(); ?>';
					
					var data = {
						'action': 'save-widget-front',
						'delete_widget': 1,
						'sidebar': sidebar_id,
						'widget-id': widget_id,
						'id_base': widget_id
					};
					
					jQuery.post(ajax_url, data, function(response) {
						window.location.href='<?php echo site_url('?editing=1');?>';
					});
					
					return false; 
			}); 
			
			}
		});
		
		
	});
	
	jQuery(document).bind('edit_save', function(ev) {

		var el = jQuery(ev.target);
		var child = jQuery(el).attr("data-widget_id");
		 jQuery(".fee-form.fee-type-widget textarea").each(function(){
			var tinymce_child_html = tinyMCE.get(this.id).getContent();
			if(tinymce_child_html){
				jQuery('#'+this.id).html(tinymce_child_html);
				//alert(jQuery('#'+this.id).val());
			}
		});

	});
	 
	</script>
<?php
	}
}


if($_POST['action']=='inline-save-widget' && isset($_POST['widget-id']) && $_POST['widget-id'])
{
	$widget_id = $_POST['widget-id'];
	$field = $_POST['field'];
	$val = @stripslashes($_POST['val']);
	
	if(strstr($field,'editpost-'))
	{
		$field_arr = explode('-',$field);
		if($field_arr[0]=='editpost')
		{
			$ptype = $field_arr[1];
			$field_name = $field_arr[2];
			$pid = $field_arr[3];
			
			$the_post = array(
			  'ID'           => $pid
		  );
			if($field_name=='title')
			{
				$the_post['post_title'] = $val;
				// Update the post into the database
				wp_update_post( $the_post );
			}elseif($field_name=='description')
			{
				$the_post['post_content'] = $val;
				// Update the post into the database
				wp_update_post( $the_post );
			}elseif($field_name=='image')
			{
				$attid = $val;
				update_post_meta($pid,'_thumbnail_id',$attid);
			}
			elseif(strstr($field_name,'custom'))
			{
				$custom_field_name = str_replace('custom','',$field_name);
				update_post_meta($pid,$custom_field_name,$val);
			}
			
		}
	}else{	
		$widget_id_arr=explode('-',$widget_id);
		$widget_id_count = count($widget_id_arr)-1;
		$widget_id_num = $widget_id_arr[$widget_id_count];
		unset($widget_id_arr[$widget_id_count]);
		$widget_id_name = 'widget_'.implode('_',$widget_id_arr);
		$widget_detail = get_option($widget_id_name);
		$widget_id_new = 'widget-'.$widget_id.'-';
		$field_name = str_replace($widget_id_new,'',$field);
		
		$widget_detail[$widget_id_num][$field_name]=$val;
		update_option($widget_id_name,$widget_detail);
	}
	echo 'saved_success';exit;
	
}else
if($_POST['action']=='save-widget-front' && isset($_POST['delete_widget']) && $_POST['delete_widget'] && $_POST['widget-id'])
{
	// delete	
	$id_base = $_POST['id_base'];
	$widget_id = $_POST['widget-id'];
	$sidebar = $_POST['sidebar'];
	
	$id_base_arr = explode('-',$id_base);
	unset($id_base_arr[count($id_base_arr)-1]);
	$id_base = implode('-',$id_base_arr);
	$sidebars_widgets = wp_get_sidebars_widgets();
	$sidebars = $sidebars_widgets[$sidebar];
	//$sidebars = get_option('sidebars_widgets');
	
	$key = array_keys($sidebars,$widget_id);
	$widget_key=$key[0];
	if ($widget_key>=0)
	{
		$sidebars = array_diff( $sidebars, array($widget_id) );
		$sidebars_widgets[$sidebar] = $sidebars;
		wp_set_sidebars_widgets($sidebars_widgets);
		echo "deleted:$widget_id";			
	}
	exit;
}else
if($_POST['action']=='save-widget-front' && isset($_POST['add_widget']) && $_POST['add_widget'] && $_POST['selected_widget'])
{
	// delete	
	$selected_widget = $_POST['selected_widget'];
	$widget_id = $_POST['widget-id'];
	$sidebar = $_POST['sidebar'];
	$sidebars_widgets = wp_get_sidebars_widgets();
	$sidebars = $sidebars_widgets[$sidebar];
	$sidebars_new = array();
	$all_widget_opt = get_option('widget_'.$selected_widget);
	$all_widget_max_id = max(array_keys($all_widget_opt));
	
	if(isset($all_widget_max_id) && $all_widget_max_id>0){$all_widget_max_id=$all_widget_max_id+1;}else{$all_widget_max_id=1;}
	$inset_new_widget_id = $selected_widget.'-'.$all_widget_max_id;
	
	if($sidebars)
	{
		for($i=0;$i<count($sidebars);$i++)
		{
			if($widget_id==$sidebars[$i])
			{
				$sidebars_new[]=$sidebars[$i];
				$sidebars_new[]=$inset_new_widget_id;
			}else{
				$sidebars_new[]=$sidebars[$i];
			}
		}
	}else{
		$sidebars_new[]=$inset_new_widget_id;
	}
	
	//set widget default data
	$default_widget_settings = array();
	if($all_widget_opt){
		foreach($all_widget_opt as $key=>$val)
		{
			$default_widget_settings = $all_widget_opt[$key];
			break;
		}
		
		if(is_array($default_widget_settings))
		{
			if(trim($default_widget_settings['title'])==''){
				$selected_widget_text = str_replace('_',' ',$selected_widget);
				$default_widget_settings['title']='NEW ADDED WIDGET '.$selected_widget_text;
			}
		}else{
			$default_widget_settings = array();
			$selected_widget_text = str_replace('_',' ',$selected_widget);
			$default_widget_settings['title']='NEW ADDED WIDGET '. strtoupper($selected_widget_text);
		}
		
		$all_widget_opt[$all_widget_max_id] = $default_widget_settings;
		update_option('widget_'.$selected_widget,$all_widget_opt);
	}
	//set widget sidebar
	$sidebars_widgets[$sidebar] = $sidebars_new;
	wp_set_sidebars_widgets($sidebars_widgets);
	echo "added:$inset_new_widget_id";
	exit;
	
}
function aheadzen_inline_edit_code($id)
{
	if(aheadzen_is_editing()){
		return ' id="'.$id.'" contenteditable="true" ';
		//return ' id="'.$id.'" ';
	}else{
		return '';
	}
}

function aheadzen_inline_head_tinymce($id)
{
	if(aheadzen_is_editing()){
?>
	<script>
	tinymce.init({
		selector: "#<?php echo $id?>",
		inline: true,
		toolbar: "undo redo",
		menubar: false
	});
	</script>
<?php
	}
}

function aheadzen_inline_tinymce($id)
{
	if(aheadzen_is_editing()){
?>
	<script>
	tinymce.init({
		selector: "#<?php echo $id;?>",
		inline: true,
		menubar: false,
		plugins: [
			"lists link image preview anchor",
			"searchreplace visualblocks code fullscreen",
			"insertdatetime media table contextmenu paste"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	});
	
	</script>
<?php
	}
}

function aheadzen_inline_image($id,$attid='')
{
	if(aheadzen_is_editing()){
?>
<script>
var img_edit_del2='';
<?php 
if($attid){
$edit_val =  '<div class="edit_image"><a target="_blank" href="'.admin_url().'/post.php?post='.$attid.'&action=edit&image-editor">edit</a></div>';
}?>
var img_edit_del='<div class="delete_image"><a href="javascript:void(0);" onclick="widget_image_delete_inline(\'<?php echo $id;?>\')">delete</a></div><?php echo $edit_val;?>';
jQuery( img_edit_del ).insertAfter( '#<?php echo $id;?>' );
widget_image_button_inline('<?php echo $id;?>');
</script>
<?php
	}
}

function aheadzen_widget_iconset($id,$name,$val='')
{
?>
<input class="icons_set" type="text" id="<?php echo $id;?>" name="<?php echo $name;?>" value="<?php echo $val;?>" />
<script>aheadzen_icons('<?php echo $id;?>');</script>
<?php
}

function aheadzen_inline_iconset($id)
{
	if(aheadzen_is_editing()){
?>
<div id="<?php echo $id;?>"></div>
<script>
var AJAX_SITE_URL = '<?php echo site_url(); ?>';
var retval = aheadzen_icons('<?php echo $id;?>');</script>
<?php
	}
}


add_action('wp_footer','aheadzen_inline_widget_select_dialog');
function aheadzen_inline_widget_select_dialog()
{
	if(aheadzen_is_editing()){

global $wp_registered_widgets, $sidebars_widgets, $wp_registered_widget_controls;
if($wp_registered_widgets){
$widgets_arr = array();
foreach($wp_registered_widgets as $key=>$val)
{
	$widgets_details = array();
	$widgets_details['name'] = $val['callback'][0]->name;
	$widgets_details['id_base'] = $val['callback'][0]->id_base;
	$widgets_details['details'] = $val['callback'][0];
	if($widgets_arr[$widgets_details['id_base']]){
	
	}else{
		$widgets_arr[$widgets_details['id_base']]=$widgets_details;
	}
}
?>
<div id="inline_widget_dialog" title="<?php _e('Select Widget','aheadzen');?>">
<ul>
	<?php 
	if($widgets_arr){
		foreach($widgets_arr as $key=>$val){
	?>
	<li><label for="<?php echo $key;?>">
	<input type="radio" id="<?php echo $key;?>" name="widget_name" value="<?php echo $key;?>"> <?php echo $val['name'];?>
	</label></li>
	<?php 
		}
	}
}?>
</ul>
<p><?php _e('Please select the section and add.','aheadzen');?></p>
</div>
<?php
	}
}


function aheadzen_wp_get_image_editor( $path, $args = array() ) {
  $args['path'] = $path;

  if ( ! isset( $args['mime_type'] ) ) {
    $file_info = wp_check_filetype( $args['path'] );

    // If $file_info['type'] is false, then we let the editor attempt to
    // figure out the file type, rather than forcing a failure based on extension.
    if ( isset( $file_info ) && $file_info['type'] )
      $args['mime_type'] = $file_info['type'];
  }

  $implementation = _wp_image_editor_choose( $args );

  if ( $implementation ) {
    $editor = new $implementation( $path );
    $loaded = $editor->load();

    if ( is_wp_error( $loaded ) )
      return $loaded;

    return $editor;
  }

  return new WP_Error( 'image_no_editor', __('No editor could be selected.') );
}

function aheadzen_get_attachment_id($src)
{
	global $wpdb;
	return $wpdb->get_var("select ID from $wpdb->posts where guid=\"$src\" and post_type='attachment'");
}

function aheadzen_get_image_name_attchment_id($mimg,$size='')
{
	if(filter_var($mimg, FILTER_VALIDATE_URL)){ 
	  // you're good
	}else{
		$attachment_id = $mimg;
		if($size==''){$size=array(300,250);}
		$mimg_arr = wp_get_attachment_image_src( $mimg,$size);
		//$mimg_arr2 = wp_get_attachment_link($image2, 'medium');
		if($mimg_arr){$mimg = $mimg_arr[0];}
	}
	return array($mimg,$attachment_id);
}

function aheadzen_edit_link_inline($id,$val)
{
	if($_GET['editing']==1){
	if($val==''){$val='Enter your URL HERE';}
?>
<div class="editlink">
<?php /*?>
<p onclick="toggle_edit_link_imgslider('<?php echo $id;?>');">edit link</p>
<div style="display:none;" id="<?php echo $id;?>" <?php echo aheadzen_inline_edit_code($id);?>><?php echo $val;?></div>
<?php */?>
<div id="<?php echo $id;?>" <?php echo aheadzen_inline_edit_code($id);?>><?php echo $val;?></div>
</div>
<?php
	}
}