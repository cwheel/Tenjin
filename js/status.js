var statusVisible = false;
var maxLines = 46;
var statusLines  = new Array();

$(document).ready(function() {
	$('body').append('<div id="statusOverlay"><div id="statusContent"></div></div>');
	$('#statusOverlay').hide();
	$('#statusContent').hide();

	$(document).keyup(function(e) {
		if (e.keyCode == 27) {
			if (statusVisible) {
				statusVisible = false;
				$('#statusOverlay').hide();
				$('#statusContent').hide();
			} else {
				statusVisible = true;

				$('#statusOverlay').show();
				$('#statusContent').show();
			}
		}
	});
	
	logStatus(null, "Tenjin", true);
	logStatus(null, "Build e9b1761b87", false);

	logStatus(null, "<br>", false);

	var mods = "";
	for (var i = 0; i < modules.length; i++) {
		if (i == modules.length - 1) {
			mods = mods + modules[i];
		} else {
			mods = mods + modules[i] + ", ";
		}
	}

	logStatus(null, "Loaded Modules: " + mods, true);
	logStatus(null, "<br>", false);
});

function logStatus(module, status, bold) {
	var statMssg = status;

	if (module !== null) {
		statMssg = "[" + module + "]" + " " + statMssg;
	}

	if (bold) {
		statMssg = "<b>" + statMssg + "</b>";
	}

	statusLines.push(statMssg + "<br>");
	if (statusLines.length > maxLines) {
		statusLines.shift();
	}

	$("#statusContent").empty();

	for (var j = 0; j < statusLines.length; j++) {
		$("#statusContent").append(statusLines[j]);
	}
}

function appendLine(line) {
	statusLines.push(line);

	var br = false;
	var i = 0;

	while (statusLines.length > maxLines) {
		console.log(statusLines[i]);
		if (!br && statusLines[i] == "<br>") {
			console.log("not shifitng");
			br = true;
		} else if (br && statusLines[i] == "<br>") {
			console.log("shifiting");
			statusLines.shift();
		} else if (statusLines[i] != "<br>") {
			console.log("shifiting");
			br = false;
			statusLines.shift();
		}
		i++;
	}

	$("#statusContent").empty();

	for (var j = 0; j < statusLines.length; j++) {
		$("#statusContent").append(statusLines[j]);
	}
}