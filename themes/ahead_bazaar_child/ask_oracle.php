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
jQuery(function() {
	jQuery( ".tabs" ).tabs({
		event: "mouseover"
	});
});

function show_horoscope_main()
{
	jQuery( "#ask-oracle-page2" ).hide( "slow", function() {
		jQuery( "#ask-oracle-page1" ).show();
	});
}

function show_horoscope(zodiac)
{
	<?php $jsondata_url =  get_stylesheet_directory_uri().'/api.php';
	echo 'var api_ajax_url="'.$jsondata_url.'";';
	?>	
	 jQuery( "#ask-oracle-page1" ).hide( "slow", function() {
		jQuery.getJSON(api_ajax_url,function(result){		
			if(zodiac=='')
			{
				zodiac = 'pisces';
			}
			var zodiac_sign = zodiac; 
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
			jQuery( "#ask-oracle-page2" ).show();
		});
	});
}
</script>
<style>
#ask-oracle-page2{display:none;}
.dailyhoro {background: url("http://www.ask-oracle.com/wp-content/themes/WP_Premium/images/daily.png") no-repeat scroll center 25px #f4f3e8;padding: 5px 5px 15px;height: 310px;width: 340px;}
h3#title{font-size: 18px;margin: 0;text-align: center;}
#zodiactable{width:100%;}
#zodiactable ul{margin: 0;padding: 0;}
#zodiactable ul li{ float: left;list-style: none outside none;margin: 12px 0 10px;padding: 0;text-align: center;width: 84px;}
#zodiactable ul#firstrow li{margin-top:0; margin-bottom: 10px;}
#zodiactable ul li a{font-size: 13px;text-decoration: none;padding-top: 62px;color: #000;display: block !important;font-weight: bold;}
.back_to_zodiac{border: 1px dashed;font-size: 15px;margin-right: 50px;margin-top: 20px;padding: 5px;position: absolute;right: 0;text-decoration: none;text-transform: uppercase;top: 0;}
</style>
</head>
<body>
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
