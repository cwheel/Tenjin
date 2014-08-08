var statusVisible = false;

function initModuleStatus(updateData) {
	$('body').append('<div id="statusOverlay"><div id="statusContent"></div></div>');
	$('#statusOverlay').hide();

	$(document).keyup(function(e) {
  		if (e.keyCode == 27) {
  			if (statusVisible) {
  				statusVisible = false;
  				$('#statusOverlay').hide();
  			} else {
  				statusVisible = true;

  				propagateStatusPage(updateData);
  				$('#statusOverlay').show();
  			}
  		}
	});
}

function jsonUpdateModuleStatus(updateData) {
	propagateStatusPage(updateData);
}

function propagateStatusPage(updateData) {
	$("#statusContent").empty();

	$('#statusContent').append("<b>Tenjin</b><br>");
	$('#statusContent').append("Build e9b1761b87<br><br>");

	$('#statusContent').append("<b>Loaded Modules: </b>");

	for (var i = 0; i < modules.length; i++) {
		if (i == modules.length - 1) {
			$('#statusContent').append(modules[i]);
		} else {
			$('#statusContent').append(modules[i] + ", ");
		}
	}
}