<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	print_r(provideDataWunderground());
	function provideDataWunderground() {

		include('../config.php');
	    $weatherArray = array();
	    $loop = 0;

		if (file_exists($localWeatherData)){
			if (date("d",filemtime($localWeatherData)) != date("d")){
				$downloadedweatherdata = downloadWeatherData($weatherDataHour);
			}else if (date("H",filemtime($localWeatherData)) <= date("H") - 1){
				$downloadedweatherdata = downloadWeatherData($weatherDataHour);
			}else{
				return file_get_contents($localWeatherData);
			}
		}else{
			$downloadedweatherdata = downloadWeatherData($weatherDataHour);
		}

		while ($loop < 36){
			$weatherArray['hourly_forecast'][$loop]['hour'] = $downloadedweatherdata['hourly_forecast'][$loop]['FCTTIME']['hour'];
			$weatherArray['hourly_forecast'][$loop]['temp'] = $downloadedweatherdata['hourly_forecast'][$loop]['temp'][$units];
			$weatherArray['hourly_forecast'][$loop]['condition'] = $downloadedweatherdata['hourly_forecast'][$loop]['wx'];
			$weatherArray['hourly_forecast'][$loop]['icon'] = $downloadedweatherdata['hourly_forecast'][$loop]['icon'];
			$weatherArray['hourly_forecast'][$loop]['feelsLike'] = $downloadedweatherdata['hourly_forecast'][$loop]['feelslike'][$units];
			$weatherArray['hourly_forecast'][$loop]['chancePrecipitation'] = $downloadedweatherdata['hourly_forecast'][$loop]['pop'];
			$weatherArray['hourly_forecast'][$loop]['rainfall'] = $downloadedweatherdata['hourly_forecast'][$loop]['qpf'][$units];
			$weatherArray['hourly_forecast'][$loop]['snowfall'] = $downloadedweatherdata['hourly_forecast'][$loop]['snow'][$units];
			$weatherArray['hourly_forecast'][$loop]['windspeed'] = $downloadedweatherdata['hourly_forecast'][$loop]['wspd'][$units];
			++$loop;
		}

		$downloadedweatherdata = downloadWeatherData($weatherDataWeekly);
		$loop = 0;
		while ($loop < 7){
			$weatherArray['weekly_forecast'][$loop]['date']['day'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['date']['day'];
			$weatherArray['weekly_forecast'][$loop]['date']['month'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['date']['month'];
			$weatherArray['weekly_forecast'][$loop]['date']['year'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['date']['year'];
			$weatherArray['weekly_forecast'][$loop]['date']['weekday'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['date']['weekday'];
			$weatherArray['weekly_forecast'][$loop]['temperature']['high'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['high'][$tempunits];
			$weatherArray['weekly_forecast'][$loop]['temperature']['low'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['low'][$tempunits];
			$weatherArray['weekly_forecast'][$loop]['chancePrecipitation'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['pop'];
			$weatherArray['weekly_forecast'][$loop]['rainfall'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['qpf_day'][$volunits];
			$weatherArray['weekly_forecast'][$loop]['snowfall'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['snow_day'][$volunits];
			$weatherArray['weekly_forecast'][$loop]['condition'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['conditions'];
			$weatherArray['weekly_forecast'][$loop]['icon'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['icon'];
			$weatherArray['weekly_forecast'][$loop]['windspeed'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['avewind'][$speedunits];
			$weatherArray['weekly_forecast'][$loop]['humidity'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$loop]['avehumidity'];
			++$loop;
		}
		$weatherJson = json_encode($weatherArray);
		file_put_contents($localWeatherData, $weatherJson);
		return $weatherJson;
	}

	function downloadWeatherData($apiFile){
                $weather = file_get_contents($apiFile);
                return json_decode($weather, TRUE);
        }
?>