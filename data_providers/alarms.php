<?php
	function provideDataAlarms() {
		include('../config.php');

		return json_encode($config['alarms']);
	}
?>