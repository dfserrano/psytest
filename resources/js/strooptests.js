// Slides of the test 
var slides = new Array();

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

// Current slide in the test
var current = 0;

// Timer of the slides
var timer;

var prevRandomIndex = -1;
var prevRandomColor = -1;
var curTargetColor = "";

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
	timer = setInterval(function(){ endSlideshow(); }, testData.exposure);
}

/**
 * When time is over, remove the picture in the slideshow
 */
function endSlideshow() {
	stopTimer();
	displayResults();
	console.log(results);
	randomBackgroundColor($('body'), '#FFFFFF');
	$('#slide').empty();
}

/**
 * Records result and calls next slide
 * @param targetPick
 * @param actualPick
 * @param curTime
 */
function advanceAndRecord(targetPick, actualPick, curTime) {
	if (current <= testData.numQuestions) {
		results[current-1] = {
    			target: targetPick, 
			    actual: actualPick,
			    time: curTime
		    };
		console.log(results);
		if (current < testData.numQuestions) {
    		nextSlide();
		} else {
			stopTimer();
			displayResults();
			console.log(results);
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
	if (current < testData.numQuestions) {
		$('#slide').empty();

		if (testData.disturbance == 1) {
			body = $('body');
			randomBackgroundColor(body, '');
		}
		
		var randomIndex = -1;
		do {
			randomIndex = Math.floor(Math.random()*slides.length);
		} while (randomIndex == prevRandomIndex);

		var color = 'black';
		if (testData.type == 1) {
			color = 'black';
			
			setCurrentTargetColor(slides[randomIndex].color);
		} else if (testData.type == 2) {
			color = slides[randomIndex].color;
			
			setCurrentTargetColor(color);
		} else {
			var randomColorIndex = -1;
			do {
				randomColorIndex = Math.floor(Math.random()*slides.length);
			} while (randomIndex == randomColorIndex || prevRandomColor == randomColorIndex);
			
			color = slides[randomColorIndex].color;
			prevRandomColor = randomColorIndex;
			
			setCurrentTargetColor(color);
		}
		
		var digit = $('<div style="width:300px; text-align:center; font-size:30pt; position:relative; text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white; color:' + color + '">' + slides[randomIndex].word + '</div>');
		
		current++;
		
		$('#slide').append(digit);
		
		translate(digit, $('#slide'), null, null, 300, 20);
		
		prevRandomIndex = randomIndex;
		
		// record start time
		startTime = getTime();
		return true;
	} 

	return false;
}


function setCurrentTargetColor(color) {
	switch(color) {
		case 'black': 	curTargetColor = "Negro"; break;
		case 'red': 	curTargetColor = "Rojo"; break;
		case 'green': 	curTargetColor = "Verde"; break;
		case 'blue': 	curTargetColor = "Azul"; break;
		case 'purple': 	curTargetColor = "Purpura"; break;
		case 'yellow': 	curTargetColor = "Amarillo"; break;
		case 'orange': 	curTargetColor = "Naranja"; break;
		case 'magenta':	curTargetColor = "Magenta"; break;
	}
}
/**
 * Picks color and save the result
 * @param targetColor Target
 * @param actualColor Actual
 */
function pickColor(targetColor, actualColor) {
	// record end time
    endTime = getTime();
	curTime = null;
	
    if (endTime > startTime) {
		curTime = endTime - startTime;
	}

    advanceAndRecord(targetColor, actualColor, curTime);
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
	//summary += "No Contestadas: " + numUnanswered + "<br/>";
	summary += "<hr/>";
	summary += "Tiempo Promedio Correctas: " + ((numRight != 0)? Math.round(timeRight/numRight) : 0) + " ms.<br/>";
	summary += "Tiempo Promedio Erroneas: " + ((numWrong != 0)? Math.round(timeWrong/numWrong) : 0) + " ms.<br/>";
	summary += "Tiempo Promedio Total: " + Math.round(total) + " ms.<br/>";

	$("#dialog-modal" ).dialog({
		height: 275,
		width: 400,
		modal: true,
		close: function() {
			window.location.replace("results/" + testData.testId);
		}
	});
	$("#dialog-modal-message").html("<p>" +summary+ "</p>");
	$("#dialog-modal-saving").show();

	// saves using ajax
	var request = $.ajax({
		url: urlSave,
		type: "POST",
		data: {'testid' : testData.testId,
			'firstname' : testData.firstname,
			'lastname' : testData.lastname,
			'age' : testData.age,
			'docid' : testData.docid,
			'results' : JSON.stringify(results)}
	});

	request.done(function(msg) {
		if (msg == "success") {
			$("#dialog-modal-saving").hide();
		} else {
			$("#dialog-modal-saving").empty();
			$("#dialog-modal-saving").text('Hubo un error y no se pudo guardar');
		}
	});
}
