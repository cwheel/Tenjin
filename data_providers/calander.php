<?php
	echo provideDataCalander();

	function provideDataCalander() {
		include('../config.php');

		$calander = array();
		$cal = simplexml_load_file($config['calanderFeed']);
		print_r($cal);
		
		return json_encode($calander);
	}
?>