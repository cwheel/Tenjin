var day = "Friday";

function pageLoadModuleWundergroundWeekly(updateData) {
	for (var i = 0; i < 7; i++) {
		logStatus("wundergroundWeekly",updateData.wunderground.weekly_forecast[i].icon, true);
		if (i == 0){
			day = "Today";
		}else if (i == 1){
			day = "Tom.";
		}else{
			switch(updateData.wunderground.weekly_forecast[i].date.weekday) 
			{
				case "Tuesday":
					day = updateData.wunderground.weekly_forecast[i].date.weekday.substring(0, 4) + ".";
					break; 
				case "Thursday":
					day = updateData.wunderground.weekly_forecast[i].date.weekday.substring(0, 5)+ ".";
					break;
				default: 
					day = updateData.wunderground.weekly_forecast[i].date.weekday.substring(0, 3)+ "."; 
			}
		}
		$("#wgDay" + i).append('<div class=wgDay>'+ day + '</div>');
		$("#wgDay" + i).append('<div class=wgicon style="background-image: url(/src/wunderground/'+ updateData.wunderground.weekly_forecast[i].icon + '.png);"> </div>');
		$("#wgDay" + i).append('<div class=wgtext><b>' +  updateData.wunderground.weekly_forecast[i].condition + '</b></div>')
		$("#wgDay" + i).append('<div class=wgtext1> Percip:&nbsp;' + updateData.wunderground.weekly_forecast[i].chancePrecipitation + '% <br> High: ' + updateData.wunderground.weekly_forecast[i].temperature.high + ' &#176;F <br> Low: ' + updateData.wunderground.weekly_forecast[i].temperature.low + ' &#176;F <br> Humidity:&nbsp;' + updateData.wunderground.weekly_forecast[i].humidity + '%</div>');
	}
}

function initModuleWundergroundWeekly(updateData) {
	addPage("WundergroundWeekly", '<div id="title">Weekly Weather Report</div><div id="bar"></div><div id=wgDay0></div><div id=wgDay1></div><div id=wgDay2></div><div id=wgDay3></div><div id=wgDay4></div><div id=wgDay5></div><div id=wgDay6></div>');
}
