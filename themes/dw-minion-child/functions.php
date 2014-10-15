<?php
session_start();
ob_start();
$selected_theme = 'dw-minion-child';

if(!function_exists('wpw_template_include_theme'))
{
	
	add_filter('template_include','wpw_template_include_theme');
	function wpw_template_include_theme($template)
	{
		global $selected_theme;
		if(isset($_GET['themeactived'] ) && $_SESSION['selected_theme']==$selected_theme && $_GET['import_sample']=='data1')
		{
			$source_blog_id=169;
			mobile_app_importer_blog($source_blog_id);
			exit;
		}
		return $template;
	}
	
}


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

function aheadzen_wp_head()
{
	if($_GET['editing']==1){
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script>
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


jQuery(function() {
	//acknowledgement message
	var filed_val='';
	
	//inline delete code
	jQuery('#main-sidebar.widget-area aside').each(function() {
		var sidebar_id ='sidebar-1';
		var widget_id = jQuery(this).attr("id");
		jQuery(this).prepend( '<div class="widget_inline_del"><a class="icon-cancel-circled" href="javascript:void(0);" onclick="widget_delete_widget_inline(\''+sidebar_id+'\',\''+widget_id+'\')" title="remove this section">X</a></div>' );
		jQuery(this).append( '<div class="widget_inline_add" widget="'+widget_id+'" sidebar="'+sidebar_id+'"><a class="icon-plus" href="javascript:void(0);" title="add new"></a></div>' );
	});
	
	//DELETE WIDGTS
	jQuery('#secondary.widget-area aside').each(function() {
		var sidebar_id = 'sidebar-2';
		var widget_id = jQuery(this).attr("id");
		jQuery(this).prepend( '<div class="widget_inline_del"><a class="icon-cancel-circled" href="javascript:void(0);" onclick="widget_delete_widget_inline(\''+sidebar_id+'\',\''+widget_id+'\')" title="remove this section">X</a></div>' );
		jQuery(this).append( '<div class="widget_inline_add" widget="'+widget_id+'" sidebar="'+sidebar_id+'"><a class="icon-plus" href="javascript:void(0);" title="add new">+</a></div>' );
	});
	
	jQuery('.top-sidebar aside').each(function() {
		var sidebar_id = 'top-sidebar';
		var widget_id = jQuery(this).attr("id");
		jQuery(this).prepend( '<div class="widget_inline_del"><a class="icon-cancel-circled" href="javascript:void(0);" onclick="widget_delete_widget_inline(\''+sidebar_id+'\',\''+widget_id+'\')" title="remove this section">X</a></div>' );
		jQuery(this).append( '<div class="widget_inline_add" widget="'+widget_id+'" sidebar="'+sidebar_id+'"><a class="icon-plus" href="javascript:void(0);" title="add new">+</a></div>' );
	});
});

</script>
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

<?php
	}
}
add_action('wp_head','aheadzen_wp_head');



add_action('wp_footer','aheadzen_inline_widget_select_dialog');
function aheadzen_inline_widget_select_dialog()
{
	if($_GET['editing']==1){

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

