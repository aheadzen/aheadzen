var zodic_result='';
jQuery(document).ready(function(){
  jQuery( "#ask-oracle-page0" ).show();
	jQuery.getJSON(api_ajax_url,function(result){
		zodic_result = result;
		jQuery( "#ask-oracle-page0" ).hide();
		show_horoscope_main();
		set_horoscope_details('pisces');
	});
});


jQuery(function() {
	jQuery( ".tabs" ).tabs({
		event: "mouseover"
	});
});

function set_horoscope_details(zodiac)
{
	var result = zodic_result;
	if(zodiac=='')
	{
		var zodiac_sign = 'pisces';
	}else{
		var zodiac_sign = zodiac;
	}
	
	var zodiac_dates = {aries:"March 21 - April 20", taurus:"April 21 - May 21", gemini:'May 22 - June 21', cancer:'June 22 - July 22', leo:'July 23 - August 22', virgo:'August 23 - Sept 22', libra:'Sept 23 - Oct 22', scorpio:'Oct 23 - Nov 21', sagittarius:'Nov 22 - Dec 21', capricorn:'Dec 22 - Jan 20', aquarius:'Jan 21 - Feb 19', pisces:'Feb 20 - March 20'}; 
	
	jQuery("#horoscope_title").html('Horoscope For '+zodiac_sign+'<div class="zodiac_photo '+zodiac_sign+'_image"></div><span class="zodiac_dates">'+zodiac_dates[zodiac_sign]+'</span>');
	jQuery(".horoscope.tabs #daily_tabs_title").html('Daily Horoscope for '+result['daily'][0].date);
	jQuery(".horoscope.tabs #tabs-daily-overview").html(result['daily'][0].content[zodiac_sign]);
	jQuery(".horoscope.tabs #tabs-daily-love").html(result['daily-love'][0].content[zodiac_sign]);
	jQuery(".horoscope.tabs #tabs-daily-career").html(result['daily-career'][0].content[zodiac_sign]);
	
	var date_str = result['weekly'][0].date;
	var date_res = date_str.split("-"); 
	var curr = new Date(parseInt(date_res[0]), parseInt(date_res[1]), parseInt(date_res[2])); // get current date
	var first = curr.getDate() - curr.getDay() + 2; // First day is the day of the month - the day of the week
	var last = first + 6; // last day is the first day + 6
	var week_firstDay = new Date(curr.setDate(first)).toUTCString();
	var week_lastDay = new Date(curr.setDate(last)).toUTCString();

	var date_str = result['monthly'][0].date;
	var date_res = date_str.split("-"); 
	//var firstDay = new Date(parseInt(date_res[0]), parseInt(date_res[1]), 1);
	//var lastDay = new Date(parseInt(date_res[0]), parseInt(date_res[1]) + 1, 0);
	//firstDay = firstDay.getDate()+'/'+firstDay.getMonth()+'/'+firstDay.getFullYear();
	//lastDay = lastDay.getDate()+'/'+lastDay.getMonth()+'/'+lastDay.getFullYear();
	var themonth = '';
	
	
	jQuery(".horoscope.tabs #weekly_tabs_title").html('Weekly Horoscope for '+result['weekly'][0].date+'<br /> --> From '+week_firstDay+' TO '+week_lastDay);
	jQuery(".horoscope.tabs #tabs-weekly-overview").html(result['weekly'][0].content[zodiac_sign]);
	jQuery(".horoscope.tabs #tabs-weekly-love").html(result['weekly-love'][0].content[zodiac_sign]);
	jQuery(".horoscope.tabs #tabs-weekly-career").html(result['weekly-career'][0].content[zodiac_sign]);
	
	//jQuery(".horoscope.tabs #monthly_tabs_title").html('Monthly Horoscope for '+result['monthly'][0].date);
	jQuery(".horoscope.tabs #monthly_tabs_title").html('Monthly Horoscope for '+themonth);
	jQuery(".horoscope.tabs #tabs-monthly-overview").html(result['monthly'][0].content[zodiac_sign]);
	jQuery(".horoscope.tabs #tabs-monthly-love").html(result['monthly-love'][0].content[zodiac_sign]);
	jQuery(".horoscope.tabs #tabs-monthly-career").html(result['monthly-career'][0].content[zodiac_sign]);
}

function show_horoscope_main()
{
	jQuery( "#ask-oracle-page2" ).hide( "slow", function() {
		jQuery( "#ask-oracle-page1" ).show();
	});
}

function show_horoscope(zodiac)
{	
	 jQuery( "#ask-oracle-page1" ).hide( "slow", function() {
		set_horoscope_details(zodiac)
		jQuery( "#ask-oracle-page2" ).show();
	});
}