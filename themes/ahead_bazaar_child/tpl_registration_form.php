<?php
/*
Template Name: JS iFrame Wizard for Signup MU
*/
?>
<html>
<head>
<title>Aheadzen Site Registration</title>
</head>
<body>
<div>
<?php
global $wpdb;
$sql = "select ID from $wpdb->posts where post_content like \"%[aheadzen_registerform]%\" and post_status='publish' order by id desc limit 1";
$pid = $wpdb->get_var($sql);
$permalink = get_permalink($pid);
if($_GET['my_template'])
{
	$permalink .= "/?my_template=".$_GET['my_template'];
}
?>
    <iframe id='iframe2' src="<?php echo $permalink;?>" frameborder="0" style="overflow: hidden; height: 99%;
        width: 99%; position: absolute;" height="99%" width="99%"></iframe>
</div>
</body>
</html>