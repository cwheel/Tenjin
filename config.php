<?php

$config = array();

$config['roomate1HWFeed'] = "https://ginseng.netap.pw/onenote/cameron.xml";
$config['roomate2HWFeed'] = "https://ginseng.netap.pw/onenote/james.xml";
$weatherDataHour  = "http://api.wunderground.com/api/21f13a51c3b0a8b1/hourly/q/MA/Amherst.json";
$localweatherDataHour = "/Tenjin/wunderground/weatherdataHour.json";
$weatherDataWeekly = "http://api.wunderground.com/api/21f13a51c3b0a8b1/forecast10day/q/MA/Amherst.json";
$localweatherDataWeekly = "/Tenjin/wunderground/weatherdataWeekly.json";
$units = "english"; // english or metric
		if ($units == "english"){
			$tempunits = "fahrenheit";
			$volunits = "in";
			$speedunits = "mph";
		} else {
			$tempunits = "celsius";
			$volunits = "mm";
			$speedunits = "kph";
		}
?>