var modules = ["calendar.js", "background.js", "alarms.js", "homework.js", "wunderground.js", "clock.js"];
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
						var funcName = data.match(/interpretData.*?\(/)[0].replace("(","");

						if (initsRun != modules.length) {
							if (typeof window[funcName + "Init"] === "function") { 
								window[funcName + "Init"](updateData);
							}
							initsRun++;
						}
						
						if (typeof window[funcName] === "function") {
							window[funcName](updateData);
						}
				});
			}
		}
	});

	setTimeout(updatePage, 1000 * 60 * 2);
}