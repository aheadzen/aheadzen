<?php 
/*
Template Name: Ask Oracle App New
*/
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/ask_embed.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script type="text/javascript">
<?php 
if($_SERVER['HTTP_HOST']=='localhost')
{
$jsondata_url =  get_stylesheet_directory_uri().'/api.php';
echo 'var api_ajax_url="'. $jsondata_url.'";';
}else{
echo 'var api_ajax_url="http://www.ask-oracle.com/charts/api.php";';
}
?>
</script>
<script src="<?php echo get_stylesheet_directory_uri();?>/ask_embed.js"></script>

</head>
<body>
<div id="ask-oracle-page0">Horoscope data loading, wait for a moment please...</div>
<div id="ask-oracle-page1">
<div class="dailyhoro" id="zodiacnav">
<h3 id="title">Choose A Zodiac Sign</h3>
<table cellspacing="0" id="zodiactable">
  <tbody><tr>
    <td>
<ul id="firstrow">
<li><a href="javascript:void(0);" onclick="show_horoscope('aries');" title="Aries Horoscope">Aries</a></li>
<li><a href="javascript:void(0);" onclick="show_horoscope('taurus');" title="Taurus Horoscope">Taurus</a></li>
<li><a href="javascript:void(0);" onclick="show_horoscope('gemini');" title="Gemini Horoscope">Gemini</a></li>
<li><a href="javascript:void(0);" onclick="show_horoscope('cancer');" title="Cancer Horoscope">Cancer</a></li>
</ul>
</td></tr>
<tr><td class="zodiacrow"><ul>
<li><a href="javascript:void(0);" onclick="show_horoscope('leo');" title="Leo Horoscope">Leo</a></li>
<li><a href="javascript:void(0);" onclick="show_horoscope('virgo');" title="Virgo Horoscope">Virgo</a></li>
<li><a href="javascript:void(0);" onclick="show_horoscope('libra');" title="Libra Horoscope">Libra</a></li>
<li><a href="javascript:void(0);" onclick="show_horoscope('scorpio');" title="Scorpio Horoscope">Scorpio</a></li>
</ul></td></tr>
<tr><td class="zodiacrow"><ul>
<li><a href="javascript:void(0);" onclick="show_horoscope('sagittarius');" title="Sagittarius Horoscope">Sagittarius</a></li>
<li><a href="javascript:void(0);" onclick="show_horoscope('capricorn');" title="Capricorn Horoscope">Capricorn</a></li>
<li><a href="javascript:void(0);" onclick="show_horoscope('aquarius');" title="Aquarius Horoscope">Aquarius</a></li>
<li><a href="javascript:void(0);" onclick="show_horoscope('pisces');" title="Pisces Horoscope">Pisces</a></li>		
</ul></td>
  </tr>
</tbody></table>
</div>
</div>


<div id="ask-oracle-page2">
<h2 class="main_title" style="text-transform: uppercase;" id="horoscope_title">Horoscope</h2>
<a class="back_to_zodiac" href="javascript:void(0);" onclick="show_horoscope_main();">Back to Zodiac</a>
<div class="horoscope tabs">
	<ul>
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

</body>
</html>
