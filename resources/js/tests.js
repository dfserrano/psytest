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
 * @returns
 */
function doStart() {
	// start timer
	timer = setInterval(function(){ start(); }, 1000);
}

/**
 * Starts image presentation of the test
 */
function start() {
	stopTimer(timer);
	
	// set first slide
	nextSlide();
			
	// start timer
	resetTimer();
}

/**
 * Return time in milliseconds
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

	/*for (var i = 1; i < 99999; i++)
        window.clearInterval(i);*/
}

/**
 * Resets timer with the same exposure time
 */
function resetTimer() {
	stopTimer();
	timer = setInterval(function(){ slideshow(); }, exposureTime);
}

/**
 * Slideshow
 */
function slideshow() {
	advanceAndRecord(slides[current-1].emotion, null, null);
}

/**
 * Records result and calls next slide
 * @param targetPick
 * @param actualPick
 * @param curTime
 */
function advanceAndRecord(targetPick, actualPick, curTime) {
	if (current <= images.length) {
    	results[current-1] = {
			    target: targetPick, 
			    actual: actualPick,
			    time: curTime
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
 * @returns true if it advanced to the next slide
 */
function nextSlide() {
	if (current < images.length) {
		if (timer != null)
			resetTimer();
		
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

		translate(images[current], $('#slide'), posx, posy, slides[current].width, slides[current].height);
		
		if (testData.disturbance == 1) {
			body = $('body');
			randomBackgroundColor(body, '');
		}
		
		$('#slide').append(images[current++]);
		
		// record start time
		startTime = getTime();
		return true;
	} 

	return false;
}


/**
 * Picks emotion and save the result
 * @param targetEmotion Target
 * @param actualEmotion Actual
 */
function pickEmotion(targetEmotion, actualEmotion) {
	// record end time
    endTime = getTime();
	curTime = null;
	console.log("start " + startTime + " end " + endTime);
    if (endTime > startTime) {
		curTime = endTime - startTime;
	}

    advanceAndRecord(targetEmotion, actualEmotion, curTime);
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
	console.log(results);
	for (i=0; i<results.length; i++) {
		if (results[i].actual == null) {
			numUnanswered++;
		} else {
			if (results[i].actual == results[i].target) {
				numRight++;
				timeRight += results[i].time;
			} else {
				numWrong++;
				timeWrong += results[i].time;
			}
		}
	}
	
	if (numRight + numWrong != 0)
		total = (timeRight + timeWrong) / (numRight + numWrong); 

	var summary = "Correctas: " + numRight + "<br/>";
	summary += "Erroneas: " + numWrong + "<br/>";
	summary += "No Contestadas: " + numUnanswered + "<br/>";
	summary += "<hr/>";
	summary += "Tiempo Promedio Correctas: " + ((numRight != 0)? Math.round(timeRight/numRight) : 0) + " ms.<br/>";
	summary += "Tiempo Promedio Erroneas: " + ((numWrong != 0)? Math.round(timeWrong/numWrong) : 0) + " ms.<br/>";
	summary += "Tiempo Promedio Total: " + Math.round(total) + " ms.<br/>";

	$("#dialog-modal" ).dialog({
		height: 275,
		width: 400,
		modal: true
	});
	$("#dialog-modal-message").html("<p>" +summary+ "</p>");
	$("#dialog-modal-saving").show();

	// saves using ajax
	var request = $.ajax({
		url: "/psytest/index.php/tests/save",
		type: "POST",
		data: {id : "x"}
	});

	request.done(function(msg) {
		$("#dialog-modal-saving").hide();
	});
}
