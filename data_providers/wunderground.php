<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	print_r(provideDataWunderground());
	function provideDataWunderground() {
		include('../config.php');
	    $weatherArray = array();

		if (file_exists($localweatherDataHour)){
			$downloadedweatherdata = checkFileDownload($localweatherDataHour, $weatherDataHour);
		}else{
			$downloadedweatherdata = downloadWeatherData($weatherDataHour);
		}

		$loopHour = 0; 
		while ($loopHour < 36){
			$weatherArray['hourly_forecast'][$loopHour]['hour'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['FCTTIME']['hour'];
			$weatherArray['hourly_forecast'][$loopHour]['temp'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['temp'][$units];
			$weatherArray['hourly_forecast'][$loopHour]['condition'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['wx'];
			$weatherArray['hourly_forecast'][$loopHour]['icon'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['icon'];
			$weatherArray['hourly_forecast'][$loopHour]['feelsLike'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['feelslike'][$units];
			$weatherArray['hourly_forecast'][$loopHour]['chancePrecipitation'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['pop'];
			$weatherArray['hourly_forecast'][$loopHour]['rainfall'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['qpf'][$units];
			$weatherArray['hourly_forecast'][$loopHour]['snowfall'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['snow'][$units];
			$weatherArray['hourly_forecast'][$loopHour]['windspeed'] = $downloadedweatherdata['hourly_forecast'][$loopHour]['wspd'][$units];

			++$loopHour;
		}
		
		if (file_exists($localweatherDataWeekly)){
			$downloadedweatherdata = checkFileDownload($localweatherDataWeekly, $weatherDataWeekly);
		}else{
			$downloadedweatherdata = downloadWeatherData($weatherDataWeekly);
		}

		$loopWeekly = 0;
		while ($loopWeekly < 7){
			$weatherArray['weekly_forecast'][$loopWeekly]['date']['day'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['date']['day'];
			$weatherArray['weekly_forecast'][$loopWeekly]['date']['month'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['date']['month'];
			$weatherArray['weekly_forecast'][$loopWeekly]['date']['year'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['date']['year'];
			$weatherArray['weekly_forecast'][$loopWeekly]['date']['weekday'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['date']['weekday'];
			$weatherArray['weekly_forecast'][$loopWeekly]['temperature']['high'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['high'][$tempunits];
			$weatherArray['weekly_forecast'][$loopWeekly]['temperature']['low'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['low'][$tempunits];
			$weatherArray['weekly_forecast'][$loopWeekly]['chancePrecipitation'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['pop'];
			$weatherArray['weekly_forecast'][$loopWeekly]['rainfall'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['qpf_day'][$volunits];
			$weatherArray['weekly_forecast'][$loopWeekly]['snowfall'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['snow_day'][$volunits];
			$weatherArray['weekly_forecast'][$loopWeekly]['condition'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['conditions'];
			$weatherArray['weekly_forecast'][$loopWeekly]['icon'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['icon'];
			$weatherArray['weekly_forecast'][$loopWeekly]['windspeed'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['avewind'][$speedunits];
			$weatherArray['weekly_forecast'][$loopWeekly]['humidity'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loopWeekly]['avehumidity'];
			++$loopWeekly;
		}
		return $weatherArray;
	}

	function downloadWeatherData($apiFile){

				include('../config.php');
                $weather = file_get_contents($apiFile);
                if ( $apiFile == $weatherDataHour){
                	file_put_contents($localweatherDataHour, $weather);
                }else{
                	file_put_contents($localweatherDataWeekly, $weather);                	
                }

                return json_decode($weather, TRUE);
        }

    function checkFileDownload($filepath, $apiFile){
    		// Downloads the JSON file if it is older than an hour, or doesn't exist.

			if (date("d",filemtime($filepath) != date("d"))){
				return downloadWeatherData($apiFile);
			}else if (date("H",filemtime($filepath) <= date("H") - 1)){
				return downloadWeatherData($apiFile);
			}else{
				file_get_contents($filepath, $weatherJson);
				return json_decode($weatherJson, TRUE);
			}
		}
?>
