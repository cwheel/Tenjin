<?php
	function provideDataCalendar() {
		include('config.php');

		if (file_exists($config['localCalendarFeed']) && date("d",filemtime($config['localCalendarFeed'] )) == date("d")){
			return json_decode(file_get_contents($config['localCalendarFeed']), true);
		}

		return cacheCalendarFeed();
	}

	function cacheCalendarFeed() {
		include('config.php');

		$calander = array();
		$webCal = json_decode(file_get_contents($config['googleCalendarFeed'] . "/full?alt=json"), true);

		foreach ($webCal['feed']['entry'] as $calEntry) {
			if (strpos($calEntry['gd$when'][0]['startTime'], date("Y-m-d")) !== false) {
			    $calander[] = $calEntry;
			}
		}

		$json =  str_replace("\/", "", json_encode($calander));
		file_put_contents($config['localCalendarFeed'], $json);

		return $calander;
	}
?>