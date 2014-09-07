function pageLoadModuleNpr(updateData) {
	for(var i = 0; i < 5; i++){
		$("#story" + i).append('<div class=nprStory>' + updateData.nationalpublicradio[i].title + ' (' + updateData.nationalpublicradio[i].date + ')' + '</div>')
		$("#story" + i).append('<div class=nprText>' + updateData.nationalpublicradio[i].teaser + '</div>')
		logStatus("npr",updateData.nationalpublicradio[i].teaser, true);
	}	
		logStatus("npr","loaded", true);
}

function initModuleNpr(updateData) {
	addPage("Npr",'<div id=story0></div><div id=story1></div><div id=story2></div><div id=story3></div><div id=story4></div>');

}