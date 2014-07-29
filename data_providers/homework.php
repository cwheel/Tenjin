<?php
	//Debug
	error_reporting(E_ALL);
    ini_set('display_errors', 1);

	echo provideDataHomework();
	//End Debug

	function provideDataHomework() {
		include('../config.php');
		$homework = array();
		$rm1hw = array();
		$rm2hw = array();
		
		$r1hws = preg_replace('/\s\s+/', ' ', file_get_contents($config['roomate1HWFeed']));
		$r2hws = preg_replace('/\s\s+/', ' ', file_get_contents($config['roomate2HWFeed']));

		if (preg_match_all("@completed=.*?</one:T>@", $r1hws, $r1matches)) {
 	 		foreach ($r1matches[0] as $assignment) {
 	 			preg_match_all("@completed=\".*?\"@", $assignment, $status);
 	 			$assignmentStatus = str_replace("\"", "", str_replace("completed=\"", "", $status[0][0]));

 	 			preg_match_all("@<one:T>.*?</one:T>@", $assignment, $task);
 	 			$task = str_replace("]]>", "", str_replace("<![CDATA[", "", str_replace("</one:T>", "", str_replace("<one:T>", "", $task[0][0]))));

 	 			$rm1hw[$task] = $assignmentStatus;
 	 		}
		}

		if (preg_match_all("@completed=.*?</one:T>@", $r2hws, $r2matches)) {
 	 		foreach ($r2matches[0] as $assignment) {
 	 			preg_match_all("@completed=\".*?\"@", $assignment, $status);
 	 			$assignmentStatus = str_replace("\"", "", str_replace("completed=\"", "", $status[0][0]));

 	 			preg_match_all("@<one:T>.*?</one:T>@", $assignment, $task);
 	 			$task = str_replace("]]>", "", str_replace("<![CDATA[", "", str_replace("</one:T>", "", str_replace("<one:T>", "", $task[0][0]))));

 	 			$rm2hw[$task] = $assignmentStatus;
 	 		}
		}

		$homework['rm1'] = $rm1hw;
		$homework['rm2'] = $rm2hw;

		return json_encode($homework);
	}
?>