function pageLoadModuleNakedsecurity(updateData) {
	for(var i = 0; i < 5; i++){
		$("#naked" + i).append('<div class=nprStory>' + updateData.nakedsecurity[i].title + ' (' + updateData.nakedsecurity[i].date + ')' + '</div>')
		$("#naked" + i).append('<div class=nprText>' + updateData.nakedsecurity[i].description + '</div>')
	}	
}

function initModuleNakedsecurity(updateData) {
	addPage("Nakedsecurity",'<div class="pageIcon" style="background-image: url(/src/naked.png);"></div><div id=naked0 class=story0></div><div id=naked1 class=story1></div><div id=naked2 class=story2></div><div id=naked3 class=story3></div><div id=naked4 class=story4></div>');

}