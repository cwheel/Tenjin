function interpretDataCalendar(updateData) {
	for (var i = 0; i < updateData.calendar.length; i++) {
		var title = updateData.calendar[i].title.$t;
		var desc = updateData.calendar[i].content.$t;
		
		if (title != "Spring" && title != "Summer" && title != "Fall" && title != "Winter") {
			//Assuming we'll never have more than one event per day...
			if (desc == "") {
				desc = "&nbsp;"
			}
			$("#eventTitle").html(title);
			$("#eventDesc").html(desc);
		}
	}
}