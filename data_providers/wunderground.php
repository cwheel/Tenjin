<?php
	function provideDataWunderground() {
		$weather = array();
		$weather['someval'] = "wunderground";

		return json_encode($weather);
	}
?>