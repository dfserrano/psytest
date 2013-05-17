<!-- Modal Dialog -->
<div id="dialog-modal" title="Resumen">
	<div id="dialog-modal-message"></div>
	<div id="dialog-modal-saving" style="display: none">
		<img src="/psytest/resources/img/ajax-loader.gif" style="float:left"/> 
		<p>&nbsp;Guardando...</p>
	</div>
</div>

<div id="dialog-form" title="Datos del usuario">
	<p class="validateTips">Todos los datos son requeridos.</p>
	<form>
		<fieldset>
			<label for="firstname">Nombre</label>
			<input type="text" name="firstname" id="firstname" class="text ui-widget-content ui-corner-all" />
			<label for="lastname">Apellido</label>
			<input type="text" name="lastname" id="lastname" class="text ui-widget-content ui-corner-all" />
			<!-- <label for="email">Email</label>
			<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />-->
			<label for="age">Edad</label>
			<input type="text" name="age" id="age" value="" class="text ui-widget-content ui-corner-all" />
			<label for="age">C&eacute;dula</label>
			<input type="text" name="docid" id="docid" value="" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>

<div id="main" style="text-align: center">
	<div id="slide" style="position:relative; height:500px; width:700px; display:inline-block; text-align:left">
		<div style="position:absolute; top:50%; height:40px; margin-top:-20px; text-align:center; width:100%">
			<a href="#" id="btnStart">Clic Aqu&iacute; cuando est&eacute; listo para empezar</a>
		</div>
	</div>
	<div id="buttons" style="text-align:center">
		<a href="#" rel="alegria" class="emotion-button">Alegr&iacute;a</a>
		<a href="#" rel="asco" class="emotion-button">Asco</a>
		<a href="#" rel="ira" class="emotion-button">Ira</a>
		<a href="#" rel="miedo" class="emotion-button">Miedo</a>
		<br/>
		<a href="#" rel="sorpresa" class="emotion-button">Sorpresa</a>
		<a href="#" rel="tristeza" class="emotion-button">Tristeza</a>
		<a href="#" rel="neutra" class="emotion-button">Neutra</a>
	</div>
</div>

<script>
 	var slides = new Array();
 	var images = new Array();
 	var results = new Array();
 	var testData = new Array();
 	var date = null;
 	var startTime = 0;
 	var endTime = 0;
 	var numPreloaded = 0;
 	var current = 0;
 	var timer;

 	testData.testId = <?php echo $test['id'] ?>; 
	
 	slides = [<?php 
 			foreach ($slides as $slide) {
 				echo "{";
 				echo "path: '/psytest/resources/img/" . $slide['path'] . "', ";
 				echo "emotion: '" . $slide['emotion'] . "', ";
 				echo "posx: " . ((empty($slide['posx']))? "null" : $slide['posx']) . ", ";
 				echo "posy: " . ((empty($slide['posy']))? "null" : $slide['posy']) . ", ";
 				echo "color: " . $slide['color'] . ", ";
 				echo "rotation: " . $slide['rotation'] . ", ";
 				echo "flip: " . $slide['flip'] . ", ";
 				echo "width: 93, ";
 				echo "height: 124";
 				echo "}, ";
 			}
 			?>];
		
 	
	function preload(arrayOfImages) {
	    $(arrayOfImages).each(function(i){
	    	images[i] = $('<img/>', {'src': this.path, 'id': 'img'+i});
	    	images[i].css({position:'relative'});

	    	images[i].load(function () {
	    		numPreloaded++;

	    		if (numPreloaded == images.length) {
		    		//start();
	    		}
			});
	    });
	}
	
	function getTime() {
		date = new Date();
		return date.getTime();
	}

	function doStart() {
		// start timer
		timer = setInterval(function(){ start(); }, 1000);
	}
	
	function start() {
		clearInterval(timer);
		
		// set first slide
		nextSlide();
				
		// start timer
		timer = setInterval(function(){ slideshow(); }, <?php echo $test['exposure']?>);
	}

	function slideshow()
	{
		if (current <= images.length) {
			results[current-1] = {
			    target: slides[current-1].emotion, 
			    actual: null,
		    };

			if (current < images.length) {
	    		nextSlide();
			} else {
				stopTimer();
				console.log(results);
				displayResults();
			}
		}
	}

	function stopTimer() {
		clearInterval(timer);
		timer = null;

		/*for (var i = 1; i < 99999; i++)
	        window.clearInterval(i);*/
	}
	
	function resetTimer() {
		clearInterval(timer);
		timer = setInterval(function(){ slideshow(); }, <?php echo $test['exposure']?>);
	}

	function nextSlide() {
		if (current < images.length) {
			if (timer != null)
				resetTimer();
			
			$('#slide').empty();
	
			var posx = slides[current].posx;
			var posy = slides[current].posy;
			var rotation = slides[current].rotation;
			var flip = slides[current].flip;

			if (flip != 0) {
				// 1 - flip horizontally
				// 2 - flip vertically
				// 3 - double flip
				
				var scaleX = 1;
				var scaleY = 1;
				var filterMS = "none";
				
				if (flip == 1) {
					scaleX = -1;
					filterMS = "FlipH";
				} else if (flip == 2) {
					scaleY = -1;
					filterMS = "FlipV";
				} else if (flip == 3) {
					scaleX = -1;
					scaleY = -1;
					filterMS = "FlipH FlipV";
				} 

				images[current].css({
					"-webkit-transform": "scale(" + scaleX + ", " + scaleY + ")",
					"-moz-transform": "scale(" + scaleX + ", " + scaleY + ")",
					"transform": "scale(" + scaleX + ", " + scaleY + ")",
					"filter": filterMS
					//-ms-filter: "FlipH";
					//-o-transform: scaleX(-1);
				});
				
			} 
			
			if (rotation != 0) {
				// rotation through css3
				images[current].css({
			        "-webkit-transform": "rotate(" + rotation + "deg)",
			        "-moz-transform": "rotate(" + rotation + "deg)",
			        //"-ms-transform: rotate(" + rotation + "deg)", 
			        //"-o-transform: rotate(" + rotation + "deg)",
			        "transform": "rotate(" + rotation + "deg)" /* For modern browsers(CSS3)  */
			    });
			}

			
			if (posx == null) {
				// width dimensions
				divWidth = $('#slide').width();
				imgWidth = slides[current].width;
				
				// sets position in the center of the containing div
				posx = (divWidth/2) - (imgWidth/2);
			}
	
			if (posy == null) {
				// height dimensions
				divHeight = $('#slide').height();
				imgHeight = slides[current].height;
	
				// sets position in the center of the containing div
				posy = (divHeight/2) - (imgHeight/2);
			}
	
			images[current].css({top: posy, left: posx});
			
			$('#slide').append(images[current++]);

			// record start time
			startTime = getTime();
			return true;
		} 

		return false;
	}


	function displayResults() {
		var numRight = 0;
		var timeRight = 0;
		var numWrong = 0;
		var timeWrong = 0;
		var numUnanswered = 0;

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

		var summary = "Correctas: " + numRight + "<br/>";
		summary += "Erroneas: " + numWrong + "<br/>";
		summary += "No Contestadas: " + numUnanswered + "<br/>";
		summary += "<hr/>";
		summary += "Tiempo Promedio Correctas: " + Math.round(timeRight/numRight) + " ms.<br/>";
		summary += "Tiempo Promedio Erroneas: " + Math.round(timeWrong/numWrong) + " ms.<br/>";
		summary += "Tiempo Promedio Total: " + Math.round((timeRight + timeWrong) / (numRight + numWrong)) + " ms.<br/>";

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
			console.log(msg);
			$("#dialog-modal-saving").hide();
		});
	}

	//////////
	var firstname = $( "#firstname" ),
	lastname = $( "#lastname" ),
	age = $( "#age" ),
	docid = $( "#docid" ),
	allFields = $( [] ).add( firstname ).add( lastname ).add( age ).add(docid),
	tips = $( ".validateTips" );

	
		
	$("#dialog-form").dialog({
		autoOpen: false,
		height: 400,
		width: 350,
		modal: true,
		position: { my: "center", at: "center", of: '#slide' },
		buttons: {
			"Continuar": function() {
				var bValid = true;
				allFields.removeClass( "ui-state-error" );
				bValid = bValid && checkLength( firstname, "firstname", 3, 16 );
				bValid = bValid && checkLength( lastname, "lastname", 3, 16 );
				bValid = bValid && checkLength( age, "age", 1, 3 );
				bValid = bValid && checkLength( docid, "docid", 1, 16 );
				//bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
				// From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
				//bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
				//bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
				
				if ( bValid ) {
					// save data in variables
					testData.firstname = firstname.val();
					testData.lastname = lastname.val();
					testData.age = age.val();
					testData.docid = docid.val();

					// enable close button
					$("#dialog-form").dialog( { 
						beforeClose: function(event, ui) { return true; } });
					$("#dialog-form").dialog("close");
				}
			},
			/*Cancel: function() {
				$( this ).dialog( "close" );
			}*/
		},
		open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
		close: function() {
			allFields.val("").removeClass( "ui-state-error" );
		},
		beforeClose: function(event, ui) { return false; }
	});
	//$("#dialog-form").dialog( "open" );
	///////////
	
	
	$(document).ready(function() {
		// preload images
		preload(slides);

		$('#btnStart').click(function(e) {
			if (numPreloaded == images.length) {
				doStart();
				$('#slide').empty();
		    }
		});

		$('.emotion-button').click(function(e) {
		    e.preventDefault();

		    // record end time
		    endTime = getTime();
			curTime = null;
			
		    if (endTime > startTime) {
				curTime = endTime - startTime;
			}

		    if (current <= images.length) {
		    	results[current-1] = {
					    target: slides[current-1].emotion, 
					    actual: $(this).attr('rel'),
					    time: curTime
				    };

				if (current < images.length) {
		    		nextSlide();
				} else {
					stopTimer()
					console.log(results);
					displayResults();
				}
		    }
		});
	});
</script>



