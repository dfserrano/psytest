// Slides of the test 
var slides = new Array();

// Images preloaded of the slides
var images = new Array();

// Results of the test
var results = new Array();

// Test taker data and general info
var testData = new Array();

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

	// set first slide
	nextSlide();

	// start timer
	//resetTimer(1000);
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
function resetTimer(time) {
	stopTimer();
	timer = setInterval(function() {
		cleanSlideshow();
	}, time);
}

/**
 * When time is over, remove the picture in the slideshow
 */
function cleanSlideshow() {
	stopTimer(); 
	
	// record start time
	startTime = getTime();
	
	// show button
	$('#buttons').show();
	
	
	$('#slide').empty();
	// advanceAndRecord(slides[current-1].emotion, null, null);
}

/**
 * Records result and calls next slide
 * 
 * @param targetPick target time
 * @param actualPick actual time
 */
function advanceAndRecord(targetPick, actualPick) {
	if (current <= images.length) {
		results[current - 1] = {
			code : slides[current - 1].code,
			target : targetPick,
			actual : actualPick
		};

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

/**
 * Changes picture in the slideshow
 * 
 * @returns true if it advanced to the next slide
 */
function nextSlide() {
	if (current < images.length) {
		
		resetTimer(slides[current].exposure);

		$('#slide').empty();

		var posx = slides[current].posx;
		var posy = slides[current].posy;
		var rotationDegrees = slides[current].rotation;
		var flipDirection = slides[current].flip;

		if (flipDirection != 0) {
			flip(images[current], flipDirection);
		}

		if (rotationDegrees != 0) {
			rotate(images[current], rotationDegrees);
		}

		translate(images[current], $('#slide'), posx, posy,
				slides[current].width, slides[current].height);

		if (testData.disturbance == 1 && current >= 2) {
			body = $('body');
			randomBackgroundColor(body, '');
		}

		$('#slide').append(images[current++]);
		
		// hide button
		$('#buttons').hide();

		return true;
	}

	return false;
}

/**
 * Picks and save the result
 * 
 * @param targetTime
 *            Target
 */
function pick(targetTime) {
	// record end time
	endTime = getTime();

	curTime = null;

	if (endTime > startTime) {
		curTime = endTime - startTime;
	}

	advanceAndRecord(targetTime, curTime);
}

/**
 * Opens modal window with results of the test
 */
function displayResults() {
	var overTime = 0;
	var overNum = 0;
	var underTime = 0;
	var underNum = 0;
	var total = 0;

	for (i = 0; i < results.length; i++) {
		if (results[i].actual < results[i].target) {
			underTime += results[i].target - results[i].actual;
			underNum++;
		} else {
			overTime += results[i].actual - results[i].target;
			overNum++;
		}
	}

	if (overNum + underNum != 0)
		total = (overTime + underTime) / (overNum + underNum);

	summary = label_avg_time_overestimated + ": "
			+ ((overNum != 0) ? Math.round(overTime / overNum) : 0)
			+ " ms.<br/>";
	summary += label_avg_time_underestimated + ": "
			+ ((underNum != 0) ? Math.round(underTime / underNum) : 0)
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
