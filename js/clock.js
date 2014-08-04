$(document).ready(function () {
	clock();
});

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