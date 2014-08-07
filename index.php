<html>
	<head>
		<title>Tenjin</title>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/pagination.js"></script>
		<script type="text/javascript" src="js/data.js"></script>

		<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/day.css">
		<link rel="stylesheet" type="text/css" href="css/homework.css">
		<link rel="stylesheet" type="text/css" href="css/alarms.css">
	</head>

	<body>
		<div id="bkg1"></div>
		<div id="bkg2"></div>

		<div id="time"></div>
		<div id="clock">
			<div id="dateContainer">
				<div id="day"></div>
				<div id="month"></div>
			</div>
		</div>

		<div id="calEvent">
			<b><div id="eventTitle"></div></b>
			<div id="eventDesc"></div>
		</div>

		<div id="logo"></div>
		<div id="build">Build e9b1761b87</div>

		<div class="page" id="pg1"></div>
		<div class="page" id="pg2"></div>

		<audio name="media" id="alarm"><source src="<?php include('config.php'); echo $config['alarmSound']; ?>" type="audio/mpeg" id="player"></audio>
	</body>
</html>

<?php
	include('config.php');
?>