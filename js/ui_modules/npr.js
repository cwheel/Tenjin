function pageLoadModuleNpr(updateData) {
	for(var i = 0; i < 5; i++){
		$("#npr" + i).append('<div class=nprStory>' + updateData.nationalpublicradio[i].title + ' (' + updateData.nationalpublicradio[i].date + ')' + '</div>')
		$("#npr" + i).append('<div class=nprText>' + updateData.nationalpublicradio[i].teaser + '</div>')
	}	
}

function initModuleNpr(updateData) {
	addPage("Npr",'<div class=pageIcon style="background-image: url(/src/npr.png);"></div><div id=npr0 class=story0></div><div id=npr1 class=story1></div><div id=npr2 class=story2></div><div id=npr3 class=story3></div><div id=npr4 class=story4></div>');

}