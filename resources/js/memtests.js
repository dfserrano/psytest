// Slides of the test 
var slides = new Array();

// Images preloaded of the slides
var images = new Array();

// Results of the test
var results = new Array();

// Test taker data and general info
var testData = new Array();

// Time of exposure
var exposureTime = 0;

// Used to get time in milliseconds
var date = null;
var startTime = 0;
var endTime = 0;

// Number of images preloaded
var numPreloaded = 0;

// Current slide in the test
var current = 0;

// Timer of theslides
var timer;

/**
 * Waits one second and start the presentation
 * 
 * @returns
 */
function doStart() {
	// start timer
	timer = setInterval(function() {
		start();
	}, 1000);
}

/**
 * Starts image presentation of the test
 */
function start() {
	stopTimer(timer);

	// adjust top margin of slide
	$('#slide').css({
		marginTop : '120px'
	})

	// set first slide
	nextSlide();

	// start timer
	resetTimer();
}

/**
 * Return time in milliseconds
 * 
 * @returns time in milliseconds
 */
function getTime() {
	date = new Date();
	return date.getTime();
}

/**
 * Stops timer
 */
function stopTimer() {
	clearInterval(timer);
	timer = null;

	/*
	 * for (var i = 1; i < 99999; i++) window.clearInterval(i);
	 */
}

/**
 * Resets timer with the same exposure time
 */
function resetTimer() {
	stopTimer();
	timer = setInterval(function() {
		showOptions();
	}, exposureTime);
}

/**
 * When time is over, remove the picture in the slideshow
 */
function showOptions() {
	stopTimer();

	$('#slide').empty();

	// record start time
	startTime = getTime();

	showReelOfPictures();
}

/**
 * Records result and calls next slide
 * 
 * @param picId
 * @param picCode
 * @param success
 * @param curTime
 */
function advanceAndRecord(picId, picCode, success, curTime) {

	if (current <= images.length) {
		resultItem = {
			pic_id : picId,
			code : picCode,
			success : success,
			time : curTime
		};
		results.push(resultItem);

		if (current < images.length) {
			nextSlide();
		} else {
			stopTimer();
			displayResults();
			randomBackgroundColor($('body'), '#FFFFFF');
			$('#slide').empty();
		}
	}

}

function showReelOfPictures() {
	var curType = slides[current].type;

	$('#slide').empty();

	while (slides[current] != undefined && slides[current].type == curType) {
		var rotationDegrees = slides[current].rotation;
		var flipDirection = slides[current].flip;

		if (flipDirection != 0) {
			flip(images[current], flipDirection);
		}

		if (rotationDegrees != 0) {
			rotate(images[current], rotationDegrees);
		}

		images[current].css({
			'margin' : '10px'
		});

		if (slides[current].type == 2) {
			var actionLink = $('<a href="#" class="pic-button" rel="'
					+ slides[current].pic_id + '::' + slides[current].code
					+ '"></a>');
			actionLink.append(images[current++]);
			$('#slide').append(actionLink);
		} else {
			$('#slide').append(images[current++]);
		}

	}
	
	if (testData.disturbance == 1 && current > 20) {
		body = $('body');
		randomBackgroundColor(body, '');
	}

	// Handles clic on emotion buttons
	$('.pic-button').click(function(e) {
		e.preventDefault();
		value = $(this).attr('rel');
		mid = value.indexOf("::");

		picId = value.substring(0, mid);
		code = value.substring(mid + 2);

		pick(picId, code);
	});
}

/**
 * Changes picture in the slideshow
 * 
 * @returns true if it advanced to the next slide
 */
function nextSlide() {
	if (current < images.length) {
		resetTimer();

		showReelOfPictures();

		return true;
	}

	return false;
}

/**
 * Picks an image
 */
function pick(picId, picCode) {
	// record end time
	endTime = getTime();
	curTime = null;

	if (endTime > startTime) {
		curTime = endTime - startTime;
	}

	success = false;

	curType = slides[current - 1].type;

	prevType = false;
	examPick = current - 1;
	while (examPick >= 0) {
		if (slides[examPick].type == curType) {
			if (prevType) {
				break;
			}

			examPick--;
			continue;
		} else {
			prevType = true;
		}

		if (prevType) {
			if (slides[examPick--].pic_id == picId) {
				success = true;
				break;
			}
		}
	}

	advanceAndRecord(picId, picCode, success, curTime);
}

/**
 * Opens modal window with results of the test
 */
function displayResults() {
	var numRight = 0;
	var timeRight = 0;
	var numWrong = 0;
	var timeWrong = 0;
	var numUnanswered = 0;
	var total = 0;

	for (i = 0; i < results.length; i++) {
		if (results[i].success) {
			numRight++;
			timeRight += results[i].time;
		} else {
			numWrong++;
			timeWrong += results[i].time;
		}
	}

	if (numRight + numWrong != 0)
		total = (timeRight + timeWrong) / (numRight + numWrong);

	var summary = label_num_right + ": " + numRight + "<br/>";
	summary += label_num_wrong + ": " + numWrong + "<br/>";
	// summary += "No Contestadas: " + numUnanswered + "<br/>";
	summary += "<hr/>";
	summary += label_avg_time_right + ": "
			+ ((numRight != 0) ? Math.round(timeRight / numRight) : 0)
			+ " ms.<br/>";
	summary += label_avg_time_wrong + ": "
			+ ((numWrong != 0) ? Math.round(timeWrong / numWrong) : 0)
			+ " ms.<br/>";
	summary += label_avg_time_total + ": " + Math.round(total) + " ms.<br/>";

	$("#dialog-modal").dialog({
		height : 275,
		width : 400,
		modal : true,
		close : function() {
			window.location.replace("results/" + testData.testId);
		}
	});
	$("#dialog-modal-message").html("<p>" + summary + "</p>");
	$("#dialog-modal-saving").show();

	// saves using ajax
	var request = $.ajax({
		url : urlSave,
		type : "POST",
		data : {
			'testid' : testData.testId,
			'firstname' : testData.firstname,
			'lastname' : testData.lastname,
			'age' : testData.age,
			'docid' : testData.docid,
			'results' : JSON.stringify(results)
		}
	});

	request.done(function(msg) {
		if (msg == "success") {
			$("#dialog-modal-saving").hide();
		} else {
			$("#dialog-modal-saving").empty();
			$("#dialog-modal-saving")
					.text(error_save);
		}
	});

}
