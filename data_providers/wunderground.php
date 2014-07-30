<?php

// Implement Something for wind (High Wind Warrning)
// Check high Humnity for Days

	error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $weatherDataHour  = "http://api.wunderground.com/api/21f13a51c3b0a8b1/hourly/q/MA/Amherst.json";
    $weatherdataWeekly = "http://api.wunderground.com/api/21f13a51c3b0a8b1/forecast10day/q/MA/Amherst.json";
	$downloadedweatherdata = downloadWeatherData($weatherDataHour);
	$weatherArray = array();
	$loopHour = 0; 
	$units = "english"; // english or metric
	while ($loopHour < 36){
		$weatherArray['hourly_forecast'][$loopHour]['hour'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['FCTTIME']['hour'];
		$weatherArray['hourly_forecast'][$loopHour]['temp'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['temp'][$units];
		$weatherArray['hourly_forecast'][$loopHour]['condition'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['wx'];
		$weatherArray['hourly_forecast'][$loopHour]['feelslike'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['feelslike'][$units];
		$weatherArray['hourly_forecast'][$loopHour]['chanceRain'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['pop'];
		$weatherArray['hourly_forecast'][$loopHour]['rainfall'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['qpf'][$units];
		++$loopHour;
	}
	
	$downloadedweatherdata = downloadWeatherData($weatherdataWeekly);
	$loopWeekly = 0;
	//while ($loopWeekly < 7){
		$weatherArray['weekly_forecast']['date'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday']['0']['date'];
	//}


//	print_r($weatherArray);
	print_r($weatherArray);

/*	function provideDataWunderground() {

		// Downloads the JSON file if it is older than an hour, or doesn't exist.
		if (file_exist(weatheramherst.json)){
			if (date("d",filemtime("weatheramherst.json") != date(d) )){
				downloadWeatherData;
			}
			elseif (date("H",filemtime("weatheramherst.json") =< $hour - 1 ) {
				downloadWeatherData;
			}else{
			file_get_contents("weatheramherst.json", $weatherJson);
			$weatherData = json_decode($weatherJson, TRUE);
			}
		}else{
			downloadWeatherData;
		}

		print_r($weatherJson)
*/
	function downloadWeatherData($apiFile){
                $weather = file_get_contents($apiFile);
                if ( $apiFile == "http://api.wunderground.com/api/21f13a51c3b0a8b1/hourly/q/MA/Amherst.json"){
                	file_put_contents("/Tenjin/weatherdataHour.json", $weather);
                }else{
                	file_put_contents("/Tenjin/weatherdataWeekly.json", $weather);                	
                }

                return json_decode($weather, TRUE);
        }
?>
