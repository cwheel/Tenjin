function interpretDataBackground(updateData) {
	for (var i = 0; i < updateData.calendar.length; i++) {
		var title = updateData.calendar[i].title.$t;

		if (title == "Spring" || title == "Summer" || title == "Fall" || title == "Winter") {
			var imageId = (Math.floor(Math.random() * imagesForSeason(title)) + 1).toString();

			if (imagesForSeason(title) > 99) {
				if (imageId.length == 1) {
					imageId = "00" + imageId;
				} else if (imageId.length == 2) {
					imageId = "0" + imageId;
				}
			} else if (imageId.length == 1) {
				imageId = "0" + imageId;
			}

			if ($('#bkg1').css('z-index') == -1) {
				$('#bkg2').css('background-image', "url('backgrounds/" + title + "/" + imageId + ".jpg')");
				$('#bkg2').fadeIn(0);
				$('#bkg1').fadeOut(500);

				setTimeout(function () {
					$('#bkg1').css('z-index', -2);
					$('#bkg2').css('z-index', -1);
				}, 1000);
			} else if ($('#bkg2').css('z-index') == -1) {
				$('#bkg1').css('background-image', "url('backgrounds/" + title + "/" + imageId + ".jpg')");
				$('#bkg1').fadeIn(0);
				$('#bkg2').fadeOut(500);

				setTimeout(function () {
					$('#bkg2').css('z-index', -2);
					$('#bkg1').css('z-index', -1);
				}, 1000);
			}
		}
	}
}

function imagesForSeason(season) {
	switch (season) {
		case "Spring":
			return 17;
		case "Summer":
			return 166;
		case "Fall":
			return 23;
		case "Winter":
			return 27;
	}
}