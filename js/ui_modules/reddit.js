var offscreen = "1000px";
var stories = "Some Story [3667] • Some Story [3667] • Some Story [3667] • Some Story [3667] • Some Story [3667] • Some Story [3667] • Some Story [3667] • Some Story [3667] • Some Story [3667] • Some Story [3667]";

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
	$("#redditScroller").animate({left: "-" + stories.length*6 + "px"}, stories.length*1000*0.1, 'linear', function() {
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
			rs = rs + "&nbsp;&nbsp;•&nbsp;&nbsp;" + post;
		}
	}

	return rs;
}