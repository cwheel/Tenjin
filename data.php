<?php
	include('config.php');
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
	
	$dps = scandir("data_providers");
	$finalData = array();

	foreach ($dps as $dp) {
		if ($dp != "." && $dp != "..") {
			include_once("data_providers/" . $dp);

			$providedData = call_user_func("provideData" . str_replace(".php", "", $dp));
			$finalData[] = $providedData;
		}
	}

	echo str_replace("\\", "", json_encode($finalData));
?>