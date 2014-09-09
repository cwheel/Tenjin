var offscreen = "1000px";
var timeOffset = 0.12;
var stories = "";

function initModuleReddit(updateData) {
	stories = processReddit(updateData.redditheadliner);
	$('body').append('<div id="redditScroller"></div>');
	$('#redditScroller').html(stories);

	scroll();
}

function jsonUpdateModuleReddit(updateData) {
	stories = processReddit(updateData.redditheadliner);
	$('#redditScroller').html(stories);
}

function scroll() {
	$('#redditScroller').css('left', offscreen);
	$('#redditScroller').css('width', stories.length*10 + "px");
	$("#redditScroller").animate({left: "-" + stories.length*6 + "px"}, stories.length*1000*timeOffset, 'linear', function() {
		scroll();
	});
}

function processReddit(reddit) {
	var rs = "";
	var firstSub = true;

	for (var sub in reddit) {
		if (firstSub) {
			rs = rs + "&nbsp;&nbsp;<b>/r/" + sub + "</b>";
			firstSub = !firstSub;
		} else {
			rs = rs + "&nbsp;&nbsp;•&nbsp;&nbsp;<b>/r/" + sub + "</b>";
		}
		
		for (var post in reddit[sub]) {
			rs = rs + "&nbsp;&nbsp;•&nbsp;&nbsp;" + post + "&nbsp;[" + reddit[sub][post] + "]";
		}
	}

	return rs;
}