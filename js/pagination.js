var offscren = "1124px";
var pages = {};
var pageTitles = new Array();

$(document).ready(function () {
	$("#pg2").hide();
	logStatus("Pagination", "Finished loading", false);

	setTimeout(showNext, 1000 * 30);
});

function showNext() {
	var page = getPage();
	logStatus("Pagination", "Switched to page '" + page + "'", false);

	if ($("#pg1").css('left') == "50px") {
		$('#pg2').html(pages[page]);
		window["pageLoadModule" + page](updateData);

		$('#pg2').css('left', offscren);
		$("#pg2").show();

		$("#pg1").animate({left: "-1000px"}, 4000, function() {
			$("#pg1").empty();
		});
		$("#pg2").animate({left: "50px"}, 4000);
	} else if ($("#pg2").css('left') == "50px") {
		$('#pg1').html(pages[page]);
		window["pageLoadModule" + page](updateData);

		$('#pg1').css('left', offscren);
		$("#pg1").show();

		$("#pg2").animate({left: "-1000px"}, 4000, function() {
			$("#pg2").empty();
		});
		$("#pg1").animate({left: "50px"}, 4000);
	}

	setTimeout(showNext, 1000 * 30);
}

function addPage(title, html) {
	pages[title] = html;
	pageTitles.push(title);

	logStatus("Pagination", "Added page '" + title + "'", false);
	
	if ($('#pg1').html() === "") {
		var page = getPage();

		$('#pg1').html(pages[page]);
		window["pageLoadModule" + page](updateData);
	}
}

function getPage() {
	if (pageTitles.length > 0) {
		var page = pageTitles.pop();
		pageTitles.unshift(page);

		return page;
	}
	return "";
}

function updatePage(title, html) {
	pages[title] = html;
}