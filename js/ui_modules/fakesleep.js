var sleepTimes = null;

function jsonUpdateModuleFakesleep(updateData) {
	sleepTimes = updateData.sleep;
}

function initModuleFakesleep(updateData) {
	alert("hi");
	$('body').append('<div id="sleep"></div>');
	checkForSleep();
}

function checkForSleep() {

}