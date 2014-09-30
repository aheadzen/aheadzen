<?php
//just get the file and do not remove linebreaks
//$url = 'https://itunes.apple.com/lookup?id=284910350';
function aheadzen_curl_get($url, $referrer='', $cookie_file='', $proxy='', $timeout=10, $header=0, $ext=true) {
		    $ch = curl_init($url);
		    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_FILETIME, 1);

		    //itunes lookup uses https**/
		    if(defined('ILW_SSL_CERTIFICATE') && is_file(ILW_SSL_CERTIFICATE)){
		    	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
				curl_setopt ($ch, CURLOPT_CAINFO, ILW_SSL_CERTIFICATE);
		    }

		    if($timeout) curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		    if($referrer) curl_setopt($ch, CURLOPT_REFERER, $referrer);
		    if($header) curl_setopt($ch, CURLOPT_HEADER, 1);
		    if($proxy) curl_setopt($ch, CURLOPT_PROXY, $proxy);
		    if($cookie_file) {
		        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
		        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
		    }
		    $content=curl_exec($ch);
		    if($ext) {
		        $content = array(
		        'errno'=>curl_errno($ch),
		        'error'=>curl_error($ch),
		        'info'=>curl_getinfo($ch),
		        'content'=>$content );
		    }
		    curl_close($ch);

	return $content;
}

//set itune lookup data
if($_POST['itune_lookup_id'])
{
	$itune_lookup_id=$_POST['itune_lookup_id']; /*$itune_lookup_id='284910350';*/
	$url = 'https://itunes.apple.com/lookup?id='.$itune_lookup_id;
	$itune_data = aheadzen_curl_get($url);
	$iTunesResponse=$itune_data['content'];
	$itune_lookup_data = (object)json_decode($iTunesResponse);
	if($itune_lookup_data->resultCount<=0)
	{
		$url = admin_url().'?page=itune_options&emsg=wrongitunelookupid';
	}else{
		update_option('itune_lookup_data',$itune_lookup_data);
		update_option('itune_lookup_id',$itune_lookup_id);
		$url = admin_url().'?page=itune_options&msg=itunedatasuccess';
	}
	?>
	<script>
	window.location.href="<?php echo $url;?>";
	</script>
	<?php	
}
?>