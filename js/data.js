//var modules = ["calendar.js", "alarms.js", "background.js", "homework.js", "sleep.js", "clock.js", "wundergroundWeekly.js", "wundergroundHourly.js", "npr.js", "reddit.js", "oit.js"];
var modules = ["calendar.js", "background.js", "nakedsecurity.js", "clock.js", "npr.js", "reddit.js", "oit.js"];
var initsRun = 0;
var updateData = null;

$(document).ready(function () {
	updatePage();
});

function updatePage() {
	$.ajax({
		type: "GET",
		url: "../data.php",
		success: function(jsonData) {
			updateData = $.parseJSON(jsonData);
			
			for (var i = 0; i < modules.length; i++) {
				$.getScript("js/ui_modules/" + modules[i], function(data, status) {
						var funcName = data.match(/Module.*?\(/)[0].replace("(","");
						
						if (typeof window["jsonUpdate" + funcName] === "function") {
							window["jsonUpdate" + funcName](updateData);
						}

						if (initsRun != modules.length) {			
							if (typeof window["init" + funcName] === "function") { 
								window["init" + funcName](updateData);
							}
							initsRun++;
						}
				});
			}
		}
	});

	setTimeout(updatePage, 1000 * 60 * 2);
}