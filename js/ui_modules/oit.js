function pageLoadModuleOit(updateData) {
	for (var service in updateData.oit) {
		var color = "#80C500";

		if (updateData.oit[service].status == "Degraded") {
			color = "#80C500";
		} else if (updateData.oit[service].status == "Down") {
			color = "#F00";
		} else if (updateData.oit[service].status == "Unknown") {
			color = "#555";
		}

		$("#oitStatus").append('<div class="oitLine"> <div class="oitServiceStatus" style="background-color:' + color + '">' + updateData.oit[service].status + '</div>&nbsp;&nbsp;' + updateData.oit[service].display_name + "</div>"); 
	}
}

function initModuleOit(updateData) {
	addPage("Oit", '<div class=pageIcon style="background-image: url(/src/oit.png);"></div><div id="title">OIT Service Status</div><div id="bar"></div><div id="oitStatus"></div>');
}