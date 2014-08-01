<?php
	include('config.php');

	$dps = scandir("data_providers");
	$finalData = array();

	foreach ($dps as $dp) {
		if ($dp != "." && $dp != "..") {
			include_once("data_providers/" . $dp);

			$providedData = call_user_func("provideData" . ucfirst(str_replace(".php", "", $dp)));
			$finalData[str_replace(".php", "", $dp)] = $providedData;
		}
	}

	echo str_replace("\\", "", json_encode($finalData));
?>