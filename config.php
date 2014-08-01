<?php
	$config = array();

	$config['roomate1HWFeed'] = "https://ginseng.netap.pw/onenote/cameron.xml";
	$config['roomate2HWFeed'] = "https://ginseng.netap.pw/onenote/james.xml";

	$config['weatherDataHour']  = "http://api.wunderground.com/api/21f13a51c3b0a8b1/hourly/q/MA/Amherst.json";
	$config['localWeatherData'] = "/Tenjin/weatherdata.json";
	$config['weatherDataWeekly'] = "http://api.wunderground.com/api/21f13a51c3b0a8b1/forecast10day/q/MA/Amherst.json";
	$config['units'] = "english"; // english or metric
			if ($config['units'] == "english"){
				$config['tempunits'] = "fahrenheit";
				$config['volunits'] = "in";
				$config['speedunits'] = "mph";
			} else {
				$config['tempunits'] = "celsius";
				$config['volunits'] = "mm";
				$config['speedunits'] = "kph";
			}
			
	$config['googleCalendarFeed'] = "https://www.google.com/calendar/feeds/g9vpil45q09qmcovun1mub0eic%40group.calendar.google.com/private-4843a7ef569533e85f7896c57ebd8f17";
	$config['localCalendarFeed'] = "/Tenjin/calander/calanderdata.json";

	$config['alarms'] = array('7:30','8:45');
?>