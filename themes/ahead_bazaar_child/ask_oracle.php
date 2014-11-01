<?php 
/*
Template Name: Ask Oracle App New
*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/ask_embed.css">
</head>
<body>
<div class="ask_wrap">
<div id="ask-oracle-page0">Horoscope data loading, wait for a moment please...</div>
<div id="ask-oracle-page1">
<div class="dailyhoro" id="zodiacnav">
<h3 id="title">Choose A Zodiac Sign</h3>
<table cellspacing="0" id="zodiactable">
  <tbody><tr>
    <td>
<ul id="firstrow">
<li><a href="#" title="Aries Horoscope">Aries</a></li>
<li><a href="#" title="Taurus Horoscope">Taurus</a></li>
<li><a href="#" title="Gemini Horoscope">Gemini</a></li>
<li><a href="#" title="Cancer Horoscope">Cancer</a></li>
</ul>
</td></tr>
<tr><td class="zodiacrow"><ul>
<li><a href="#" title="Leo Horoscope">Leo</a></li>
<li><a href="#" title="Virgo Horoscope">Virgo</a></li>
<li><a href="#" title="Libra Horoscope">Libra</a></li>
<li><a href="#" title="Scorpio Horoscope">Scorpio</a></li>
</ul></td></tr>
<tr><td class="zodiacrow"><ul>
<li><a href="#" title="Sagittarius Horoscope">Sagittarius</a></li>
<li><a href="#" title="Capricorn Horoscope">Capricorn</a></li>
<li><a href="#" title="Aquarius Horoscope">Aquarius</a></li>
<li><a href="#" title="Pisces Horoscope">Pisces</a></li>		
</ul></td>
  </tr>
</tbody></table>
</div>
</div>


<div id="ask-oracle-page2">
<?php /*?><h2 class="main_title" style="text-transform: uppercase;" id="horoscope_title">Horoscope</h2><?php */?>

<div class="clearboth"></div>
<div id="horoscope_zodiac_details"></div>
<div class="horoscope tabs">
	<ul class="daily_weekly_monthly_tabs">
		<li><a href="#tabs-daily">Daily Horoscope</a></li>
		<li><a href="#tabs-weekly">Weekly Horoscope</a></li>
		<li><a href="#tabs-monthly">Monthly Horoscope</a></li>
	</ul>
	<div id="tabs-daily">		
		<div class="horoscope_daily tabs">
			<h5 id="daily_tabs_title">Daily Horoscope for Today</h5>
			<ul>
				<li><a href="#tabs-daily-overview">Overview</a></li>
				<li><a href="#tabs-daily-love">Love</a></li>
				<li><a href="#tabs-daily-career">Career</a></li>
			</ul>
			<div id="tabs-daily-overview">loading data, please wait for a moment please...
			</div>
			<div id="tabs-daily-love">loading data, please wait for a moment please...
			</div>
			<div id="tabs-daily-career">loading data, please wait for a moment please...
			</div>
		</div>
	</div>
	<div id="tabs-weekly">
		<div class="horoscope_weekly tabs">
			<h5 id="weekly_tabs_title">Weekly Horoscope for Current Week</h5>
			<ul>
				<li><a href="#tabs-weekly-overview">Overview</a></li>
				<li><a href="#tabs-weekly-love">Love</a></li>
				<li><a href="#tabs-weekly-career">Career</a></li>
			</ul>
			<div id="tabs-weekly-overview">loading data, please wait for a moment please...
			</div>
			<div id="tabs-weekly-love">loading data, please wait for a moment please...
			</div>
			<div id="tabs-weekly-career">loading data, please wait for a moment please...
			</div>
		</div>
	</div>
	<div id="tabs-monthly">
		<div class="horoscope_monthly tabs">
			<h5 id="monthly_tabs_title">Weekly Horoscope for Current Month</h5>
			<ul>
				<li><a href="#tabs-monthly-overview">Overview</a></li>
				<li><a href="#tabs-monthly-love">Love</a></li>
				<li><a href="#tabs-monthly-career">Career</a></li>
			</ul>
			<div id="tabs-monthly-overview">loading data, please wait for a moment please...
			</div>
			<div id="tabs-monthly-love">loading data, please wait for a moment please...
			</div>
			<div id="tabs-monthly-career">loading data, please wait for a moment please...
			</div>
		</div>
	</div>
</div>
</div>
<div class="clearboth"></div>
<div id="footer">
<div id="footer-wrap">
Copyright &copy; 2015 Ask Oracle. All rights reserved.
<?php  wp_footer(); ?>
</div>
</div>
</div>



<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.3/moment.min.js"></script>
<script type="text/javascript">
<?php
if($_SERVER['HTTP_HOST']=='localhost')
{
$jsondata_url =  get_stylesheet_directory_uri().'/api.php';
echo 'var api_ajax_url="'. $jsondata_url.'/";';
}else{
echo 'var api_ajax_url="http://www.ask-oracle.com/charts/api.php";';
}
?>
</script>
<script src="<?php echo get_stylesheet_directory_uri();?>/ask_embed.js"></script>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-1945662-2");
pageTracker._initData();
pageTracker._trackPageview();
</script>

</body>
</html>