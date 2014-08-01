<?php
	function provideDataCalendar() {
		include('../config.php');

		if (file_exists($config['localCalendarFeed']) && date("d",filemtime($config['localCalendarFeed'] )) == date("d")){
			return file_get_contents($config['localCalendarFeed']);
		}

		return cacheCalanderFeed();
	}

	function cacheCalendarFeed() {
		include('../config.php');

		$calander = array();
		$webCal = json_decode(file_get_contents($config['calendarFeed'] . "/full?alt=json"), true);

		foreach ($webCal['feed']['entry'] as $calEntry) {
			if (strpos($calEntry['gd$when'][0]['startTime'], date("Y-m-d")) !== false) {
			    $calander[] = $calEntry;
			}
		}

		$json =  str_replace("\/", "", json_encode($calander));
		file_put_contents($config['localCalendarFeed'], $json);
		return $json;
	}
?>