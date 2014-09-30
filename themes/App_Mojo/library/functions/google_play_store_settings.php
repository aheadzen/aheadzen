<?php
if($_POST['google_play_id'])
{
	$google_play_id=$_POST['google_play_id']; /*$google_play_id='com.instagram.android';*/
	//https://play.google.com/store/apps/details?id=com.instagram.android
	require_once(TEMPLATEPATH.'/library/functions/core/playStoreApi.php');	
	$class_init = new PlayStoreApi;	// initiating class
	/* WITHOUT PAGINATION PARAMERTER */
	$item_id = $google_play_id;
	$itemInfo = $class_init->itemInfo($item_id); // calling itemInfo
	
	if($itemInfo['ScreenShots']){
		$itemInfo['General'][0]->ScreenShots = $itemInfo['ScreenShots'];
	}
	
	if($itemInfo !== 0)
	{
		update_option('google_play_data',$itemInfo);
		update_option('google_play_id',$google_play_id);
		$url = admin_url().'?page=itune_options&msg=gstoredatasuccess';
	}else{
		$url = admin_url().'?page=itune_options&emsg=wronggstore';
	}
	?>
	<script>
	window.location.href="<?php echo $url;?>";
	</script>
	<?php
}
?>