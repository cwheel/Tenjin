var dataProviders = ["calendar.js","alarms.js","homework.js","wunderground.js"];
var currentProviderFunction = null;

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
				
				$.getScript("js/data_providers/" + dataProviders[i], function() {
					if (typeof currentProviderFunction == 'function') {
						window[currentProviderFunction](updateData);
					}
				});
			}
		}
	});

	setTimeout(updatePage, 1000 * 60 * 2);
}