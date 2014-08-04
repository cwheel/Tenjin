<?php
	include('config.php');

	$dps = scandir("data_providers");
	$finalData = array();

	foreach ($dps as $dp) {
		if ($dp != "." && $dp != ".." && $dp != "redditheadliner.php") {
			include_once("data_providers/" . $dp);
			$modFunc = "provideData" . ucfirst(str_replace(".php", "", $dp));

			if (function_exists($modFunc)) {
				$providedData = call_user_func($modFunc);
				$finalData[str_replace(".php", "", $dp)] = $providedData;
			}
		}
	}

	echo str_replace("\\", "", json_encode($finalData));
?>