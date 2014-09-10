var roomateOne = "Cameron";
var roomateTwo = "James";

function pageLoadModuleHomework(updateData) {
	for (var assignment in updateData.homework.rm1) {
		if (updateData.homework.rm1[assignment] == "true") {
			$("#rmhw1").append('<div class="hwAssignmentCompleted">' + assignment + '</div>');
		} else {
			$("#rmhw1").append('<div class="hwAssignment">' + assignment + '</div>');
		}
	}
	for (var assignment in updateData.homework.rm2) {
		if (updateData.homework.rm2[assignment] == "true") {
			$("#rmhw2").append('<div class="hwAssignmentCompleted">' + assignment + '</div>');
		} else {
			$("#rmhw2").append('<div class="hwAssignment">' + assignment + '</div>');
		}
	}
}

function initModuleHomework(updateData) {
	addPage("Homework", '<div class="pageIcon" style="background-image: url(/src/onenote.png);"></div><div id="title">Homework</div><div id="bar"></div><div class="hwRoomate" id="rm1">' + roomateOne + '</div><div class="hwRoomate" id="rm2">' + roomateTwo + '</div><div class="hw" id="rmhw1"></div><div class="hw" id="rmhw2"></div>');
}
