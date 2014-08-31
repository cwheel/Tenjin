var sleepTimes = null;
var isSleeping = false;

function initModuleSleep(updateData) {
	$('body').append('<div id="sleep"></div>');
	$('#sleep').hide();

	$(document).keyup(function(e) {
		if (isSleeping) {
			$("#sleep").hide();

			setTimeout(function() { 
				if (isSleeping) {
					$("#sleep").show(); 
				}
			}, 1000 * 60 * 30);
		}	
	});

	checkSleep();
}

function jsonUpdateModuleSleep(updateData) {
	sleepTimes = updateData.sleep;
}

function checkSleep() {
	if (sleepTimes !== null) {
		var now = new Date();
		var nowTime = null;

		if (now.getMinutes().toString().length == 1) {
				nowTime = now.getHours() + ":0" + now.getMinutes();
		} else {
				nowTime = now.getHours() + ":" + now.getMinutes();
		}

		if ($("#sleep").css('display') == "none") {
			if (sleepTimes.sleep == nowTime) {
				if (!isSleeping) {
					isSleeping = true;
					$("#sleep").show();
				}
			}
		} else {
			if (sleepTimes.wake == nowTime) {
				isSleeping = false;
				if (isSleeping) {
					isSleeping = false;
					$("#sleep").hide();
				}
			}
		}
	}
	setTimeout(checkSleep, 1000 * 10);
}