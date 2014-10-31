var zodic_result='';
var zodiac_sign='';
var zodiac_dates = {aries:"March 21 - April 20", taurus:"April 21 - May 21", gemini:'May 22 - June 21', cancer:'June 22 - July 22', leo:'July 23 - August 22', virgo:'August 23 - Sept 22', libra:'Sept 23 - Oct 22', scorpio:'Oct 23 - Nov 21', sagittarius:'Nov 22 - Dec 21', capricorn:'Dec 22 - Jan 20', aquarius:'Jan 21 - Feb 19', pisces:'Feb 20 - March 20'}; 
var months_full = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"); 
var months_short = {Jan:"01", Feb:"02", Mar:'03', Apr:'04', May:'05', Jun:'06', Jul:'07', Aug:'08', Sep:'09', Oct:'10', Nov:'11', Dec:'12'}; 
	
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
		zodiac_sign = 'pisces';
	}else{
		zodiac_sign = zodiac;
	}
	
	//jQuery("#horoscope_title").html(zodiac_sign+' Horoscope<div class="zodiac_photo '+zodiac_sign+'_image"></div><span class="zodiac_dates">'+zodiac_dates[zodiac_sign]+'</span>');
	jQuery("#horoscope_title").html(zodiac_sign+' Horoscope');
	jQuery("#horoscope_zodiac_details").html('<div class="zodiac_photo '+zodiac_sign+'_image"></div>');
	set_daily_data_tabs(result);
	set_weekly_data_tabs(result);
	set_monthly_data_tabs(result);
	
}

function set_daily_data_tabs(result)
{
	var date_str = result['daily'][0].date;
	var ddate_res = date_str.split("-"); 
	var daily_date = ddate_res[2]+' '+months_full[parseInt(ddate_res[1])-1]+' '+ddate_res[0];
	
	var mypre_daily_date = new Date(parseInt(ddate_res[0]), parseInt(ddate_res[1])-1, parseInt(ddate_res[2]));
	
	var pre_daily_date = new Date(parseInt(ddate_res[0]), parseInt(ddate_res[1])-1, parseInt(ddate_res[2])).toUTCString();;
	var next_daily_date = new Date(parseInt(ddate_res[0]), parseInt(ddate_res[1])-1, parseInt(ddate_res[2])+2).toUTCString();;
	var pre_daily_date_res = pre_daily_date.split(" "); 
	pre_daily_date = pre_daily_date_res[3]+'-'+months_short[pre_daily_date_res[2]]+'-'+pre_daily_date_res[1];
	var next_daily_date_res = next_daily_date.split(" "); 
	next_daily_date = next_daily_date_res[3]+'-'+months_short[next_daily_date_res[2]]+'-'+next_daily_date_res[1];
	
	jQuery(".horoscope.tabs #daily_tabs_title").html('<a class="left" href="javascript:void(0);" onclick="daily_get_next_data(\''+pre_daily_date+'\');"><< previous</a> '+'Daily Horoscope for :: '+daily_date+' <a class="right" href="javascript:void(0);" onclick="daily_get_next_data(\''+next_daily_date+'\');">next >></a>');
	jQuery(".horoscope.tabs #tabs-daily-overview").html(result['daily'][0].content[zodiac_sign]);
	jQuery(".horoscope.tabs #tabs-daily-love").html(result['daily-love'][0].content[zodiac_sign]);
	jQuery(".horoscope.tabs #tabs-daily-career").html(result['daily-career'][0].content[zodiac_sign]);
}

function set_weekly_data_tabs(result)
{
	var date_str = result['weekly'][0].date;
	var date_res = date_str.split("-");
	var curr = new Date(parseInt(date_res[0]), parseInt(date_res[1])-1, parseInt(date_res[2])); // get current date
	var first = curr.getDate() - curr.getDay() + 2; // First day is the day of the month - the day of the week
	var last = first + 6; // last day is the first day + 6
	var week_firstDay = new Date(curr.setDate(first)).toUTCString();
	var week_lastDay = new Date(curr.setDate(last)).toUTCString();
	var week_firstDay_res = week_firstDay.split(" "); 
	var week_lastDay_res = week_lastDay.split(" "); 
	week_firstDay = week_firstDay_res[0]+' '+week_firstDay_res[1]+' '+week_firstDay_res[2]+' '+week_firstDay_res[3];
	week_lastDay = week_lastDay_res[0]+' '+week_lastDay_res[1]+' '+week_lastDay_res[2]+' '+week_lastDay_res[3];
	
	var pre_weekly_date = new Date(parseInt(week_firstDay_res[3]), parseInt(months_short[week_firstDay_res[2]])-1, parseInt(week_firstDay_res[1])-6).toUTCString();
	var pre_weekly_date_res = pre_weekly_date.split(" "); 
	pre_weekly_date = pre_weekly_date_res[3]+'-'+months_short[pre_weekly_date_res[2]]+'-'+pre_weekly_date_res[1];
	var next_weekly_date = new Date(parseInt(week_lastDay_res[3]), parseInt(months_short[week_lastDay_res[2]])-1, parseInt(week_lastDay_res[1])+6).toUTCString();
	var next_weekly_date_res = next_weekly_date.split(" "); 
	next_weekly_date = next_weekly_date_res[3]+'-'+months_short[next_weekly_date_res[2]]+'-'+next_weekly_date_res[1];
	
	jQuery(".horoscope.tabs #weekly_tabs_title").html('<a class="left" href="javascript:void(0);" onclick="weekly_get_next_data(\''+pre_weekly_date+'\');"><< previous</a> '+'Weekly Horoscope for :: '+week_firstDay+' to '+week_lastDay +' <a class="right" href="javascript:void(0);" onclick="weekly_get_next_data(\''+next_weekly_date+'\');">next >></a>');
	jQuery(".horoscope.tabs #tabs-weekly-overview").html(result['weekly'][0].content[zodiac_sign]);
	jQuery(".horoscope.tabs #tabs-weekly-love").html(result['weekly-love'][0].content[zodiac_sign]);
	jQuery(".horoscope.tabs #tabs-weekly-career").html(result['weekly-career'][0].content[zodiac_sign]);
}

function set_monthly_data_tabs(result)
{
	var date_str = result['monthly'][0].date;
	var date_res = date_str.split("-"); 
	var themonth = months_full[parseInt(date_res[1])-1] +' '+ date_res[0];
	var pre_monthly_date = new Date(parseInt(date_res[0]), parseInt(date_res[1])-1, 1).toUTCString();
	var next_monthly_date = new Date(parseInt(date_res[0]), parseInt(date_res[1])+1, 1).toUTCString();
	var pre_monthly_date_res = pre_monthly_date.split(" "); 
	pre_monthly_date = pre_monthly_date_res[3]+'-'+months_short[pre_monthly_date_res[2]]+'-'+pre_monthly_date_res[1];
	var next_monthly_date_res = next_monthly_date.split(" "); 
	next_monthly_date = next_monthly_date_res[3]+'-'+months_short[next_monthly_date_res[2]]+'-'+next_monthly_date_res[1];
	
	jQuery(".horoscope.tabs #monthly_tabs_title").html('<a class="left" href="javascript:void(0);" onclick="monthly_get_next_data(\''+pre_monthly_date+'\');"><< previous</a> '+'Monthly Horoscope for :: '+themonth+'<a class="right" href="javascript:void(0);" onclick="monthly_get_next_data(\''+next_monthly_date+'\');">next >></a> ');
	jQuery(".horoscope.tabs #tabs-monthly-overview").html(result['monthly'][0].content[zodiac_sign]);
	jQuery(".horoscope.tabs #tabs-monthly-love").html(result['monthly-love'][0].content[zodiac_sign]);
	jQuery(".horoscope.tabs #tabs-monthly-career").html(result['monthly-career'][0].content[zodiac_sign]);
}

function daily_get_next_data(dt)
{
	get_set_daily_weekly_monthly_data(dt,'daily');
	
}

function weekly_get_next_data(dt)
{
	get_set_daily_weekly_monthly_data(dt,'weekly');
}

function monthly_get_next_data(dt)
{
	get_set_daily_weekly_monthly_data(dt,'monthly');
}

function get_set_daily_weekly_monthly_data(dt,type)
{
	var date_res = dt.split("-"); 
	var the_date = new Date(parseInt(date_res[0]), parseInt(date_res[1])-1, parseInt(date_res[2])+1);
	var n = the_date.toJSON();
	var new_api_ajax_url = api_ajax_url+'?dt='+ encodeURI(n);
	if(type=='daily')
	{
		jQuery(".horoscope.tabs #daily_tabs_title").html('processing...');
	
	}else if(type=='weekly')
	{
		jQuery(".horoscope.tabs #weekly_tabs_title").html('processing...');
	
	}else if(type=='monthly')
	{
		jQuery(".horoscope.tabs #monthly_tabs_title").html('processing...');
	}
	
	jQuery.get(new_api_ajax_url,function(data,status){
		//alert("Data: " + data + "\nStatus: " + status);
		if(type=='daily')
		{
			set_daily_data_tabs(data);
		
		}else if(type=='weekly')
		{
			set_weekly_data_tabs(data);
		
		}else if(type=='monthly')
		{
			set_monthly_data_tabs(data);
		}
	});	
	
	
	
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