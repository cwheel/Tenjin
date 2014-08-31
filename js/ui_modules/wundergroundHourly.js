function pageLoadModuleWundergroundHourly(updateData) {
	for (var i = 0; i < 6; i++) {
		logStatus("wundergroundhourly",updateData.wunderground.hourly_forecast[i].icon, true);

		$("#wghour" + i).append('<div class=wghour>'+ updateData.wunderground.hourly_forecast[i].hour + ':00</div>');
		$("#wghour" + i).append('<div class=wgicon style="background-image: url(/src/wunderground/'+ updateData.wunderground.hourly_forecast[i].icon + '.png);"> </div>');
		$("#wghour" + i).append('<div class=wgtext><b>' +  updateData.wunderground.hourly_forecast[i].condition + '</b></div>')
		$("#wghour" + i).append('<div class=wgtext1> Percip:&nbsp;' + updateData.wunderground.hourly_forecast[i].chancePrecipitation + '% <br> Temp: ' + updateData.wunderground.hourly_forecast[i].temp + ' &#176;F <br> Feels Like: ' + updateData.wunderground.hourly_forecast[i].feelsLike + '&nbsp;&#176;F <br> Humidity:&nbsp;' + updateData.wunderground.hourly_forecast[i].humidity + '%</div>');
	}
}

function initModuleWundergroundHourly(updateData) {
	addPage("WundergroundHourly", '<div id="wghTitle">6 Hour Weather Report</div><div id="wghbar"></div><div id="wghour0"></div><div id="wghour1"></div><div id="wghour2"></div><div id="wghour3"></div><div id="wghour4"></div><div id="wghour5"></div>');
}
