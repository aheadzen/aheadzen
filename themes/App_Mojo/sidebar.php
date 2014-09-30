<?php
global $page_layout;

if($page_layout['left']=='' && $page_layout['right']=='')
{
}else{
	if(is_active_sidebar('shopingcart'))
	{
		dynamic_sidebar('shopingcart');
	}else{
		dynamic_sidebar( 'sidebar' );
	}
}
?>