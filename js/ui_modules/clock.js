function initModuleClock(updateData) {
	clock();
}

function clock() {
	var now = new Date();
	var hours = "";
	var minutes = "";

	if (now.getHours().toString().length == 1) {
			hours = "0" + now.getHours();
	} else {
			hours = now.getHours();
	}

	if (now.getMinutes().toString().length == 1) {
			minutes = "0" + now.getMinutes();
	} else {
			minutes = now.getMinutes();
	}

	$('#time').html(hours + ":" + minutes);
	$('#day').html(clockDay(now.getDay()));
	$('#month').html(clockMonth(now.getMonth()) + " " + now.getDate());

	now = null;
	setTimeout(clock, 1000 * 10);
}

function clockMonth(num) {
	switch (num) {
		case 0:
			return "Janurary";
		case 1:
			return "February";
		case 2:
			return "March";
		case 3:
			return "April";
		case 4:
			return "May";
		case 5:
			return "June";
		case 6:
			return "July";
		case 7:
			return "August";
		case 8:
			return "September";
		case 9:
			return "October";
		case 10:
			return "November";
		case 11:
			return "December";
	}
}

function clockDay(num) {
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