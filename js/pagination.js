var offscren = "1124px";
var pages = new Array();

$(document).ready(function () {
	$("#pg2").hide();
	setTimeout(showNext, 1000 * 30);
});

function showNext() {
	console.log("tick");
	if ($("#pg1").css('left') == "50px") {
		$('#pg2').html(getPage());
		$('#pg2').css('left', offscren);
		$("#pg2").show();

		$("#pg1").animate({left: "-1000px"}, 4000);
		$("#pg2").animate({left: "50px"}, 4000);
		
	} else if ($("#pg2").css('left') == "50px") {
		$('#pg1').html(getPage());
		$('#pg1').css('left', offscren);
		$("#pg1").show();

		$("#pg2").animate({left: "-1000px"}, 4000);
		$("#pg1").animate({left: "50px"}, 4000);
	}

	setTimeout(showNext, 1000 * 30);
}

function addPage(html) {
	pages.push(html);
}

function getPage() {
	if (pages.length > 0) {
		var page = pages.pop();
		pages.unshift(page);

		return page;
	}
	return "";
}