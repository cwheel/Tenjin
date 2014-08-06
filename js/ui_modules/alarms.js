var alarms = null;
function pageLoadModuleAlarms(updateData) {
	
}

function jsonUpdateModuleAlarms(updateData) {
	alarms = updateData.alarms;
}

function initModuleAlarms(updateData) {
	addPage("Alarms", '<div id="alTitle">Alarms</div><div id="bar"></div>');
	alarms = updateData.alarms;
	checkAlarms();
}

function checkAlarms() {
	var now = new Date();

	if (alarms != null) {
		for (day in alarms) {
			if (day.toString().indexOf(alarmDay(now.getDay())) >= 0) {
				var nowTime = null;

				if (now.getMinutes().toString().length == 1) {
						nowTime = now.getHours() + ":0" + now.getMinutes();
				} else {
						nowTime = now.getHours() + ":" + now.getMinutes();
				}

				for (var i = 0; i < alarms[day].length; i++) {
					if (alarms[day][i] == nowTime) {
						console.log("Alarm");
					}
				}
			}
		}
	}

	setTimeout(checkAlarms, 1000 * 10);
}

function alarmDay(num) {
	switch (num) {
		case 0:
			return "Sunday";
		case 1:
			return "Monday";
		case 2:
			return "Tuesday";
		case 3:
			return "Wednesday";
		case 4:
			return "Thursday";
		case 5:
			return "Friday";
		case 6:
			return "Saturday";
	}
}