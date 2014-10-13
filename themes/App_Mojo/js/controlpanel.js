$patterns = "";
for(var i=1; i<= 15; i++){
	$img = 	theme_folder_url+"images/style-picker/pattern"+i+".jpg";	
	$patterns += '<li>';
	$patterns += '<a id="pattern'+i+'"  href="" title="">';
	$patterns += '<img src="'+ $img +'" alt="pattern'+i+'" title="pattern'+i+'"/>'
	$patterns += '</a>';
	$patterns += '</li>'; 
}

$color = ["skyblue","green","orange","red","ocean","purple","pink","slateblue","blue","coral","khaki","cyan","grey","gold","chocolate","raspberry","electricblue","eggplant","ferngreen","palebrown"];
$colors = "";
for(var i=0; i<$color.length; i++){
	$img = 	theme_folder_url+"images/style-picker/"+$color[i]+".jpg";	
	$colors += '<li>';
	$colors += '<a id="'+$color[i]+'" href="" title="">';
	$colors += '<img src="'+ $img +'" alt="color-'+$color[i]+'" title="color-'+$color[i]+'"/>'
	$colors += '</a>';
	$colors += '</li>'; 
}


$str = '<!-- **DT Style Picker Wrapper** -->';
$str += '<div class="dt-style-picker-wrapper">';
$str += '	<a href="'+theme_custom_change_url+'" title="" class="style-picker-ico"> <img src="'+theme_folder_url+'images/style-picker/picker-icon.png" alt="" title="" /> </a>';
jQuery(document).ready(function($){
	$("body > div.wrapper").before($str);
	$picker_container = $("div.dt-style-picker-wrapper");
	
	//Applying Cookies
	if ( $.cookie('control-open') == 1 ) { 
		$picker_container.animate( { left: -230 } );
		$('a.style-picker-ico').addClass('control-open');
	}

});