<?php
add_action('admin_menu', 'aheadzen_add_admin_itune_menu'); //Add new menu block to admin side

function aheadzen_add_admin_itune_menu(){
	if(function_exists('add_object_page'))
    {
       add_object_page("iTune Settings",  'iTune Settings', 'activate_plugins', 'itune_options', 'aheadzen_itune_options_page'); // title of new sidebar
    }
    else
    {
       add_theme_page("iTune Settings",  'iTune Settings', 8, 'itune_options', 'aheadzen_itune_options_page'); // title of new sidebar
    }
}

function aheadzen_itune_options_page()
{
	if($_GET['import_image']=='itune')
	{
		$itune_lookup_data = get_option('itune_lookup_data');
		$results = $itune_lookup_data->results[0];
		if($itune_lookup_data && $itune_lookup_data->results[0])
		{
			$images_arr = array();
			foreach($itune_lookup_data->results[0] as $key=>$val)
			{
				if(is_array($val))
				{
					for($i=0;$i<count($val);$i++)
					{
						$content = strtolower($val[$i]);
						if(strstr($content,'.png') || strstr($content,'.jpg') || strstr($content,'.jpeg') || strstr($content,'.gif'))
						{
							$images_arr[] = $val[$i];
						}
					}
				}else{
					$content = strtolower($val);
					if(strstr($content,'.png') || strstr($content,'.jpg') || strstr($content,'.jpeg') || strstr($content,'.gif'))
					{
						$images_arr[] = $val;
					}
				}
			}
			if($images_arr && count($images_arr)>0)
			{
				aheadzen_bml_it_savefile ($images_arr);
			}
		}
		?>
		<script>window.location.href="<?php echo admin_url();?>admin.php?page=itune_options&msg=itune_img_upload_success"</script>
		<?php
		exit;
	}elseif($_GET['import_image']=='gstore')
	{
		$google_play_id = get_option('google_play_id');
		$google_play_data = get_option('google_play_data');
		if($google_play_data && $google_play_data['General'][0])
		{
			$images_arr = array();
			$cover_image = $google_play_data['General'][0]->cover_image;
			$banner_image = $google_play_data['General'][0]->banner_image;
			$ScreenShots = $google_play_data['General'][0]->ScreenShots;
			
			if($cover_image)
			{
				if(is_array($cover_image))
				{
					$images_arr = $cover_image;
				}else{
					$images_arr[] = $cover_image;
				}
			}
			if($banner_image)
			{
				if(is_array($banner_image))
				{
					$images_arr = array_merge($images_arr,$cover_image);
				}else{
					$images_arr[] = $banner_image;
				}
			}
			if($ScreenShots)
			{
				$images_arr = array_merge($images_arr,$ScreenShots);
			}
			
			/*
			foreach($google_play_data['General'][0] as $key=>$val)
			{
				if(is_array($val))
				{
					for($i=0;$i<count($val);$i++)
					{
						$content = strtolower($val[$i]);
						if(strstr($content,'.png') || strstr($content,'.jpg') || strstr($content,'.jpeg') || strstr($content,'.gif'))
						{
							$images_arr[] = $content;
						}
					}
				}else{
					$content = $val;
					if(strstr($content,'.png') || strstr($content,'.jpg') || strstr($content,'.jpeg') || strstr($content,'.gif'))
					{
						$images_arr[] = $content;
					}
				}
				
			}
			*/
		}
		if($images_arr && count($images_arr)>0)
		{
			aheadzen_bml_it_savefile ($images_arr);
		}
		
		?>
		<script>window.location.href="<?php echo admin_url();?>admin.php?page=itune_options&msg=gstore_img_upload_success"</script>
		<?php
		exit;
	}
?>
	<style>
	.errormessage{border:solid 1px red; color:red; font-weight:bold; padding:10px 15px; text-align:center; margin:20px;}
	.successmessage{border:solid 1px green; color:green; font-weight:bold; padding:10px 15px; text-align:center; margin:20px;}
	.itune_data,.gstore_data{border: 1px solid brown;font-weight: bold;padding: 10px;text-align: center;width: 220px;cursor: pointer; float:left; margin:5px;}
	</style>
	<div class="wrap" id="of_container">  
    <div id="header">
      <div class="logo">
        <h2> iTune & Google Play Store Options</h2>
      </div>    
      <div class="clear"></div>
    </div>
    
    <div id="main">
	<?php
	$itune_lookup_data = get_option('itune_lookup_data');
	$itune_lookup_id = get_option('itune_lookup_id');
	?>

	<?php
	if($_GET['emsg']=='wrongitunelookupid')
	{
	echo '<div class="errormessage">The iTune Lookup ID may be wrong, Please check & try again.</div>';
	}elseif($_GET['msg']=='itunedatasuccess')
	{
	echo '<div class="successmessage">The iTune Lookup ID related data added  successfully.</div>';
	}elseif($_GET['msg']=='itune_img_upload_success')
	{
	echo '<div class="successmessage">All iTune Lookup ID related images added to media successfully.</div>';
	}
	?>
  <form action="" method='POST'>
  <input type="hidden" name="save_itune" value="1" />
  <h5>Enter iTune Lookup ID:
  
  <input type="text" name="itune_lookup_id" value="<?php echo $itune_lookup_id;?>" />
  <input type="submit" value="Save All Changes" class="button-primary" />
  </h5>
  <p><small>eg: iTune Lookup ID for iPhone5c is :: 284910350</small></p>
  </form>	
<?php 
if($itune_lookup_data && $itune_lookup_data->results[0])
{
	echo '
	<div id="show_itune_data" class="itune_data">See All iTune Data</div>
	<div class="itune_data"><a href="'.admin_url().'admin.php?page=itune_options&import_image=itune">Import Images</a></div>
	<div style="width:100%;clear:both;"></div>
	<div class="itune_data_collection" style="display:none;">';
	foreach($itune_lookup_data->results[0] as $key=>$val)
	{
		if(is_array($val))
		{
			$value = implode('<br />',$val);
		}else{
			$value = $val;
		}
		if($value){
			echo '<h3>'.$key.'</h3>'.$value;
		}
	}
	echo '</div>';
}
?>  
<script>
jQuery( "#show_itune_data" ).click(function() {
jQuery( ".itune_data_collection" ).toggle( "slow", function() {
// Animation complete.
});
});
</script>
  
      <div class="clear" style="padding:30px;"></div>
<?php
$google_play_id = get_option('google_play_id');
$google_play_data = get_option('google_play_data');
?>
<?php
if($_GET['emsg']=='wronggstore')
{
echo '<div class="errormessage">Google Play Store ID  may be wrong, Please check & try again.</div>';
}elseif($_GET['msg']=='gstoredatasuccess')
{
echo '<div class="successmessage">Google Play Store ID related data added  successfully.</div>';
}elseif($_GET['msg']=='gstore_img_upload_success')
	{
	echo '<div class="successmessage">All Google Play Store ID related images added to media successfully.</div>';
	}
?>
<form action="" method='POST'>
  <input type="hidden" name="save_itune" value="1" />
  <h5>Enter Google Play Store ID:
  
  <input type="text" name="google_play_id" value="<?php echo $google_play_id;?>" />
  <input type="submit" value="Save All Changes" class="button-primary" />
  </h5>
  <p><small>eg: Google Play Store ID for instagram is :: com.instagram.android</small></p>
  </form>

<?php 
if($google_play_data && $google_play_data['General'][0])
{
	echo '
	<div id="show_gstore_data" class="gstore_data">See All Google Store Data</div>
	<div class="itune_data"><a href="'.admin_url().'admin.php?page=itune_options&import_image=gstore">Import Images</a></div>
	<div style="width:100%;clear:both;"></div>
	<div class="gstore_data_collection" style="display:none;">';
	
	foreach($google_play_data['General'][0] as $key=>$val)
	{
		if(is_array($val))
		{
			$value = implode('<br />',$val);
		}else{
			$value = $val;
		}
		if($value){
			echo '<h3>'.str_replace('_',' ',$key).'</h3>'.$value;
		}
	}	
	echo '</div>';
}
?>  
<script>
jQuery( "#show_gstore_data" ).click(function() {
jQuery( ".gstore_data_collection" ).toggle( "slow", function() {
// Animation complete.
});
});
</script>  

    </div>
</div>
<div class="clear" style="padding:50px;"></div>
<?php
}



function aheadzen_bml_it_savefile ($images_arr) {
	$time = null;
	
	$uploads = wp_upload_dir($time);
	for($i=0;$i<count($images_arr);$i++)
	{
		$theimg = $images_arr[$i];
		$theimgname = basename($theimg);
		$filename = wp_unique_filename( $uploads['path'], $theimgname, $unique_filename_callback );
		
		$myfilename = strtolower($filename);
		if(strstr($myfilename,'.png') || strstr($myfilename,'.jpg') || strstr($myfilename,'.jpeg') || strstr($myfilename,'.gif'))
		{		
		}else{
			$filename = $myfilename.'.png';
		}
		$savepath = $uploads['path'] . "/$filename";
		
		$image_arr = wp_remote_get($theimg);
		$length = $image_arr['content-length'];
		$type = $image_arr['content-type'];
		$body = $image_arr['body'];	
		
		if($image_arr['response']['code']==200)
		{		
			if($fp = fopen($savepath, 'w')) {
				fwrite($fp, $body);
				fclose($fp);
			}
			
			$title = $filename;
			$content = '';
			$wp_filetype = wp_check_filetype( $savepath, $mimes );
			$type = $wp_filetype['type'];
			
			// Construct the attachment array
			$attachment = array(
								'post_mime_type' => $type,
								'guid' => $uploads['url'] . "/$filename",
								'post_parent' => 0,
								'post_title' => $title,
								'post_content' => $content
								);
			
			// Save the data
			$id = wp_insert_attachment($attachment, $savepath, $post_id);
			if ( !is_wp_error($id) ) {
				wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $file ) );
			}
		}	
	}
}
?>