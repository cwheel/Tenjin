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
			if (array_key_exists('gd$when', $calEntry)) {
				if (strpos($calEntry['gd$when'][0]['startTime'], date("Y-m-d")) !== false) {
					 $calander[] = $calEntry;
				}
			} else if (array_key_exists('gd$recurrence', $calEntry)) {
				$rec = explode(";", $calEntry['gd$recurrence']['$t']);
				$startTime = str_replace(" ", "", preg_replace('/\s\s+/', ' ', str_replace("DTEND", "", str_replace("VALUE=DATE:", "", $rec[1]))));
				$endTime = str_replace(" ", "", preg_replace('/\s\s+/', ' ', $rec[3]));
				preg_match_all("@UNTIL=.*?B@", $endTime, $endMatch);
				$endTime = str_replace("B", "", str_replace("UNTIL=", "", $endMatch[0][0]));

				$start = date("Y-m-d", strtotime($startTime));
				$end = date("Y-m-d", strtotime($endTime));
				$today = date("Y-m-d");

				if (($today > $start) && ($today < $end)) {
					$calander[] = $calEntry;
				}
			} else {
				$start = date("Y-m-d", strtotime($calEntry['gd$when'][0]['startTime']));
				$end = date("Y-m-d", strtotime($calEntry['gd$when'][0]['endTime']));
				$today = date("Y-m-d");

				if (($today > $start) && ($today < $end)) {
					$calander[] = $calEntry;
				}
			}
		}

		$json =  str_replace("\/", "", json_encode($calander));
		file_put_contents($config['localCalendarFeed'], $json);

		return $calander;
	}
?>