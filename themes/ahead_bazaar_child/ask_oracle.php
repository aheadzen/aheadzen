<?php 
/*
Template Name: Ask Oracle App New
*/
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
<?php $jsondata_url =  get_stylesheet_directory_uri().'/api.php';
echo 'var api_ajax_url="'.$jsondata_url.'";';
?>
jQuery(document).ready(function(){
//daily,daily-love,daily-career,weekly,weekly-career,weekly-love,monthly,monthly-love,monthly-career
//pisces,aquarius,capricorn,sagittarius,scorpio,libra,virgo,leo,cancer,gemini,taurus,aries
	jQuery.getJSON(api_ajax_url,function(result){
		//jQuery(".result ul").append('<li>'+JSON.stringify(result['daily'][0].content.pisces)+'</li>');
		
		/*jQuery(".result ul").append('<h3>Daily Horoscope</h3>');
		var daily_overview_id = 'daily_overview_pisces';
		var daily_love_id = 'daily_love_pisces';
		var daily_career_id = 'daily_career_pisces';
		jQuery(".result").append('<div class="tabs">');
		//Tabs
		jQuery(".result").append('<ul class="daily">');
		jQuery(".result ul.daily").append('<li><a href="#'+daily_overview_id+'">Overview</a></li>');
		jQuery(".result ul.daily").append('<li><a href="#'+daily_love_id+'">Love</a></li>');
		jQuery(".result ul.daily").append('<li><a href="#'+daily_career_id+'">Career</a></li>');
		jQuery(".result").append('</ul>');
		//Tabs Details
		jQuery(".result").append('<div id="'+daily_overview_id+'">'+(result['daily'][0].content.pisces)+'</div>');
		jQuery(".result").append('<div id="'+daily_love_id+'">'+(result['daily-love'][0].content.pisces)+'</div>');
		jQuery(".result").append('<div id="'+daily_career_id+'">'+(result['daily-career'][0].content.pisces)+'</div>');
		jQuery(".result").append('</div>');
		
		
		jQuery(".result").append('<ul class="weekly">');
		jQuery(".result").append('<li><h3>Weekly Horoscope</h3></li>');
		jQuery(".result").append('<li>'+(result['weekly'][0].content.pisces)+'</li>');
		jQuery(".result").append('<li>'+(result['weekly-career'][0].content.pisces)+'</li>');
		jQuery(".result").append('<li>'+(result['weekly-love'][0].content.pisces)+'</li>');
		jQuery(".result").append('</ul>');
		
		jQuery(".result").append('<ul class="monthly">');
		jQuery(".result").append('<li><h3>Monthly Horoscope</h3></li>');
		jQuery(".result").append('<li>'+(result['monthly'][0].content.pisces)+'</li>');
		jQuery(".result").append('<li>'+(result['monthly-career'][0].content.pisces)+'</li>');
		jQuery(".result").append('<li>'+(result['monthly-love'][0].content.pisces)+'</li>');
		jQuery(".result").append('</ul>');
		*/
		
		var zodiac_sign = 'pisces';
		jQuery("#horoscope_title").html('Horoscope For '+zodiac_sign);
		
		jQuery(".horoscope.tabs #tabs-daily-overview").html(result['daily'][0].content[zodiac_sign]);
		jQuery(".horoscope.tabs #tabs-daily-love").html(result['daily-love'][0].content[zodiac_sign]);
		jQuery(".horoscope.tabs #tabs-daily-career").html(result['daily-career'][0].content[zodiac_sign]);
		
		jQuery(".horoscope.tabs #tabs-weekly-overview").html(result['weekly'][0].content[zodiac_sign]);
		jQuery(".horoscope.tabs #tabs-weekly-love").html(result['weekly-love'][0].content[zodiac_sign]);
		jQuery(".horoscope.tabs #tabs-weekly-career").html(result['weekly-career'][0].content[zodiac_sign]);
		
		jQuery(".horoscope.tabs #tabs-monthly-overview").html(result['monthly'][0].content[zodiac_sign]);
		jQuery(".horoscope.tabs #tabs-monthly-love").html(result['monthly-love'][0].content[zodiac_sign]);
		jQuery(".horoscope.tabs #tabs-monthly-career").html(result['monthly-career'][0].content[zodiac_sign]);
	});
});


jQuery(function() {
	jQuery( ".tabs" ).tabs({
		event: "mouseover"
	});
});
</script>
</head>
<body>
<h2 style="text-transform: uppercase;" id="horoscope_title">Horoscope</h2>
<div class="horoscope tabs">
	<ul>
		<li><a href="#tabs-daily">Daily Horoscope</a></li>
		<li><a href="#tabs-weekly">Weekly Horoscope</a></li>
		<li><a href="#tabs-monthly">Monthly Horoscope</a></li>
	</ul>
	<div id="tabs-daily">		
		<div class="horoscope_daily tabs">
			<ul>
				<li><a href="#tabs-daily-overview">Overview</a></li>
				<li><a href="#tabs-daily-love">Love</a></li>
				<li><a href="#tabs-daily-career">Career</a></li>
			</ul>
			<div id="tabs-daily-overview">
			</div>
			<div id="tabs-daily-love">
			</div>
			<div id="tabs-daily-career">
			</div>
		</div>
	</div>
	<div id="tabs-weekly">
		<div class="horoscope_weekly tabs">
			<ul>
				<li><a href="#tabs-weekly-overview">Overview</a></li>
				<li><a href="#tabs-weekly-love">Love</a></li>
				<li><a href="#tabs-weekly-career">Career</a></li>
			</ul>
			<div id="tabs-weekly-overview">
			</div>
			<div id="tabs-weekly-love">
			</div>
			<div id="tabs-weekly-career">
			</div>
		</div>
	</div>
	<div id="tabs-monthly">
		<div class="horoscope_monthly tabs">
			<ul>
				<li><a href="#tabs-monthly-overview">Overview</a></li>
				<li><a href="#tabs-monthly-love">Love</a></li>
				<li><a href="#tabs-monthly-career">Career</a></li>
			</ul>
			<div id="tabs-monthly-overview">
			</div>
			<div id="tabs-monthly-love">
			</div>
			<div id="tabs-monthly-career">
			</div>
		</div>
	</div>
</div>


</body>
</html>
