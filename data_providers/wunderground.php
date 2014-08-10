<?php
	function provideDataWunderground() {
		include('config.php');
	    $weatherArray = array();
	    $downloadedweatherdata = null;

	    // Checks if the local File is older than 1 hour
		if (file_exists($config['localWeatherData'])){
			if (date("d",filemtime($config['localWeatherData'])) != date("d")){
				$downloadedweatherdata = downloadWeatherData($config['weatherDataHour']);
			}else if (date("H",filemtime($config['localWeatherData'])) != date("H")){
				$downloadedweatherdata = downloadWeatherData($config['weatherDataHour']);
			}else{
				return json_decode(file_get_contents($config['localWeatherData']), true);
			}
		}else{
			$downloadedweatherdata = downloadWeatherData($config['weatherDataHour']);
		}

		for ($i = 0; $i < 6; $i++){
			$weatherArray['hourly_forecast'][$i]['hour'] = $downloadedweatherdata['hourly_forecast'][$i]['FCTTIME']['hour'];
			$weatherArray['hourly_forecast'][$i]['temp'] = $downloadedweatherdata['hourly_forecast'][$i]['temp'][$config['units']];
			$weatherArray['hourly_forecast'][$i]['condition'] = $downloadedweatherdata['hourly_forecast'][$i]['wx'];
			$weatherArray['hourly_forecast'][$i]['icon'] = $downloadedweatherdata['hourly_forecast'][$i]['icon'];
			$weatherArray['hourly_forecast'][$i]['feelsLike'] = $downloadedweatherdata['hourly_forecast'][$i]['feelslike'][$config['units']];
			$weatherArray['hourly_forecast'][$i]['chancePrecipitation'] = $downloadedweatherdata['hourly_forecast'][$i]['pop'];
			$weatherArray['hourly_forecast'][$i]['rainfall'] = $downloadedweatherdata['hourly_forecast'][$i]['qpf'][$config['units']];
			$weatherArray['hourly_forecast'][$i]['snowfall'] = $downloadedweatherdata['hourly_forecast'][$i]['snow'][$config['units']];
			$weatherArray['hourly_forecast'][$i]['windspeed'] = $downloadedweatherdata['hourly_forecast'][$i]['wspd'][$config['units']];
		}

		$downloadedweatherdata = downloadWeatherData($config['weatherDataWeekly']);

		for ($i = 0; $i < 7; $i++){
			$weatherArray['weekly_forecast'][$i]['date']['day'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['date']['day'];
			$weatherArray['weekly_forecast'][$i]['date']['month'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['date']['month'];
			$weatherArray['weekly_forecast'][$i]['date']['year'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['date']['year'];
			$weatherArray['weekly_forecast'][$i]['date']['weekday'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['date']['weekday'];
			$weatherArray['weekly_forecast'][$i]['temperature']['high'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['high'][$config['tempunits']];
			$weatherArray['weekly_forecast'][$i]['temperature']['low'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['low'][$config['tempunits']];
			$weatherArray['weekly_forecast'][$i]['chancePrecipitation'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['pop'];
			$weatherArray['weekly_forecast'][$i]['rainfall'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['qpf_day'][$config['volunits']];
			$weatherArray['weekly_forecast'][$i]['snowfall'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['snow_day'][$config['volunits']];
			$weatherArray['weekly_forecast'][$i]['condition'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['conditions'];		
			$weatherArray['weekly_forecast'][$i]['icon'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['icon'];
			$weatherArray['weekly_forecast'][$i]['windspeed'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['avewind'][$config['speedunits']];
			$weatherArray['weekly_forecast'][$i]['humidity'] = $downloadedweatherdata['forecast']['simpleforecast']['forecastday'][$i]['avehumidity'];
		}

		$weatherJson = json_encode($weatherArray);
		file_put_contents($config['localWeatherData'], $weatherJson);
		return $weatherArray;
	}

	function downloadWeatherData($apiFile){
                $weather = file_get_contents($apiFile);
                return json_decode($weather, TRUE);
        }
?>