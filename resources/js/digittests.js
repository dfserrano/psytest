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

//Current serie's length in the test
var currentSerieLength = 2;

//Current input length in the test
var currentInputLength = 0;

//Current try in the test
var currentTry = 0;

//
var points = 0;
var lastCorrectSerie = "";
var prevRandomDigit = -1;
var valSerie = "";
var valInput = "";
var curLength = 0;

// Timer of the slides
var timer;

/**
 * Waits one second and start the presentation
 * @returns
 */
function doStart() {
	// start timer
	timer = setInterval(function(){ start(); }, 1000);
	
	$('#buttons').hide();
}

/**
 * Starts image presentation of the test
 */
function start() {
	stopTimer(timer);

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
 * When time is over, remove the picture in the slideshow
 */
function slideshow() {
	$('#slide').empty();
	
	if (curLength < currentSerieLength) {
		nextSlide();
		curLength++;
		console.log(curLength);
		
	} else {
		stopTimer();
		
		// record start time
		startTime = getTime();
		console.log("Start time");
		
		$('#buttons').show();
		valInput = "";
	}
}

/**
 * Records result and calls next slide
 * @param digit
 * @param curTime
 */
function advanceAndRecord(digit, curTime) {
	$('#buttons').hide();
	
	if (testData.type == 2) {
		valSerie = valSerie.split("").reverse().join("");
	}
	
	console.log(valSerie+' == '+valInput);
	if (valSerie == valInput) {
		points++;
		lastCorrectSerie = valInput;	
	}
	
	var item = {
		    target: valSerie, 
		    actual: valInput,
		    time: curTime,
		    success: ((valSerie == valInput)? true:false)
	    };
	results.push(item);
	
	curLength = 0;
	valInput = "";
	valSerie = "";
	
	if (currentTry++ != 0) {
		if (lastCorrectSerie.length < currentSerieLength) {
			stopTimer();
			displayResults();
			randomBackgroundColor($('body'), '#FFFFFF');
			$('#slide').empty();
			
			return;
		}
		currentSerieLength++;
		currentTry = 0;
	}
	
	
	console.log("Points = " + points);
	
	resetTimer();
}

/**
 * Changes picture in the slideshow
 * @returns true if it advanced to the next slide
 */
function nextSlide() {
	if (timer != null)
		resetTimer();
	
	$('#slide').empty();

	if (testData.disturbance == 1) {
		body = $('body');
		randomBackgroundColor(body, '');
	}
	
	var randomDigit = -1;
	do {
		randomDigit = Math.floor(Math.random()*10);
	} while (randomDigit == prevRandomDigit);
	
	valSerie += randomDigit;
	
	var digit = $('<div style="width:50px; text-align:center; font-size:30pt; position:relative; text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;">' + randomDigit + '</div>');
	$('#slide').append(digit);
	
	translate(digit, $('#slide'), null, null, 20, 20);
	
	prevRandomDigit = randomDigit;
	
	return true;
}


/**
 * Picks digit and save the result
 * @param digit Digit
 */
function pickDigit(digit) {
	
	if (currentInputLength < currentSerieLength) {
		valInput += digit;
		currentInputLength++;
		
		if (currentInputLength == currentSerieLength) {
			// record end time
		    endTime = getTime();
		    
			curTime = null;
			currentInputLength = 0;
			
		    if (endTime > startTime) {
				curTime = endTime - startTime;
			}

		    advanceAndRecord(digit, curTime);
		}
	}
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
