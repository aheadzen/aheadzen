<?php 
/*
Template Name: Ask Oracle App Copy
*/
?>
<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type='text/javascript' src='http://www.ask-oracle.com/charts/api.php?dt=2014-03-01T15%3A00%3A00%2B02%3A00'></script>
<script>
jQuery("button").click(function(){
  jQuery("#div1").load("http://www.ask-oracle.com/charts/api.php?dt=2014-03-01T15%3A00%3A00%2B02%3A00");
}); 

/*
var d = new Date();
var jsondt = d.toJSON();
var url = 'http://www.ask-oracle.com/charts/api.php?dt='+jsondt;
var script = '<script type="text/javascript" src="';
script += url+'"><' + '/script>';
document.write(script);
*/

/*
jQuery(document).ready(function(){
  jQuery("button").click(function(){
    jQuery.get("http://www.ask-oracle.com/charts/api.php?dt=2014-03-01T15%3A00%3A00%2B02%3A00",function(data,status){
      alert("Data: " + data + "\nStatus: " + status);
    });
  });
});


var d = new Date();
var n = d.toJSON();
*/

/*jQuery.each(result, function(day_week_moth, day_week_moth_details){
			
	
	jQuery(".result").append('<br /><b style="color:red;">'+day_week_moth+'</b>===============<br /><br />');
	jQuery.each(day_week_moth_details, function(zodiac, zodiac_details){
		jQuery(".result").append(zodiac_details.date+'-----------------<br />');
		jQuery(".result").append('pisces :::::::::::<br />'+zodiac_details.content.pisces+'<br />');
		jQuery(".result").append('aquarius :::::::::::<br />'+zodiac_details.content.aquarius+'<br />');
		jQuery(".result").append('capricorn :::::::::::<br />'+zodiac_details.content.capricorn+'<br />');
		jQuery(".result").append('sagittarius :::::::::::<br />'+zodiac_details.content.sagittarius+'<br />');
		jQuery(".result").append('scorpio :::::::::::<br />'+zodiac_details.content.scorpio+'<br />');
		jQuery(".result").append('libra :::::::::::<br />'+zodiac_details.content.libra+'<br />');
		jQuery(".result").append('virgo :::::::::::<br />'+zodiac_details.content.virgo+'<br />');
		jQuery(".result").append('leo :::::::::::<br />'+zodiac_details.content.leo+'<br />');
		jQuery(".result").append('cancer :::::::::::<br />'+zodiac_details.content.cancer+'<br />');
		jQuery(".result").append('gemini :::::::::::<br />'+zodiac_details.content.gemini+'<br />');
		jQuery(".result").append('taurus :::::::::::<br />'+zodiac_details.content.taurus+'<br />');
		jQuery(".result").append('aries :::::::::::<br />'+zodiac_details.content.aries+'<br /><br />');
		jQuery(".result").append(JSON.stringify(result.daily));
		
	});
	
	
  //jQuery(".result").append(i+'===============<br /><br />'+JSON.stringify(field) + " <br /><br />---------------------------------------------------------------------<br /><br />");
});*/
</script>
</head>
<body>

<button>Send an HTTP GET request to a page and get the result back</button>

</body>
</html>