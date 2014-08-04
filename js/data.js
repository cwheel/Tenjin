var dataProviders = ["calendar.js", "background.js", "alarms.js", "homework.js", "wunderground.js", "clock.js"];
var currentProviderFunction = null;
var initsRun = false;

$(document).ready(function () {
	updatePage();
});

function updatePage() {
	$.ajax({
		type: "GET",
		url: "../data.php",
		success: function(jsonData){
			var updateData = $.parseJSON(jsonData);
			
			for (var i = 0; i < dataProviders.length; i++) {
				currentProviderFunction = "interpretData" + dataProviders[i].split('.')[0][0].toUpperCase() + dataProviders[i].split('.')[0].substring(1);

				$.getScript("js/ui_modules/" + dataProviders[i], function(data, status) {
						var funcName = data.match(/interpretData.*?\(/)[0].replace("(","");
						if (typeof window[funcName] === "function") {
							window[funcName](updateData);
						}

						if (!initsRun) {
							if (typeof window[funcName + "Init"] === "function") { 
								window[funcName + "Init"](updateData);
							}	
						}
				});
			}
		}
	});

	initsRun = true;
	setTimeout(updatePage, 1000 * 60 * 2);
}