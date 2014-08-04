$(document).ready(function () {
	$("#pg2").css("left", "800px");
});

function showNext() {
	if ($("#pg1").css('left') == "50px") {
		$("#pg1").css("left", "800px");
		$("#pg2").css("left", "50px");
	} else if ($("#pg2").css('left') == "50px") {
		$("#pg2").css("left", "800px");
		$("#pg1").css("left", "50px");
	}
}