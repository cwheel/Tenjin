var dataProviders = ["calendar.js", "background.js", "alarms.js", "homework.js", "wunderground.js"];
var currentProviderFunction = null;

$(document).ready(function () {
	updatePage();
	clock();
});

function updatePage() {
	$.ajax({
		type: "GET",
		url: "../data.php",
		success: function(jsonData){
			var updateData = $.parseJSON(jsonData);
			
			for (var i = 0; i < dataProviders.length; i++) {
				currentProviderFunction = "interpretData" + dataProviders[i].split('.')[0][0].toUpperCase() + dataProviders[i].split('.')[0].substring(1);

				$.getScript("js/data_providers/" + dataProviders[i], function(data, status) {
						var funcName = data.match(/interpretData.*?\(/)[0].replace("(","");
						window[funcName](updateData);
				});
			}
		}
	});

	setTimeout(updatePage, 1000 * 60 * 2);
}

function clock() {
	var now = new Date();

	if (now.getMinutes().toString().length == 1) {
			$('#time').html(now.getHours() + ":0" + now.getMinutes());
	} else {
			$('#time').html(now.getHours() + ":" + now.getMinutes());
	}

	$('#day').html(day(now.getDay()));
	$('#month').html(month(now.getMonth()) + " " + now.getDate());

	now = null;
	setTimeout(clock, 1000 * 10);
}

function month(num) {
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

function day(num) {
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