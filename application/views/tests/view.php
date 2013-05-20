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
		<div id="loading" style="position:absolute; top:50%; height:40px; margin-top:-20px; text-align:center; width:100%">
			<img src="/psytest/resources/img/ajax-loader.gif"/> 
			<br/>Espere mientras se carga la prueba...<br/>
			<a href="#" id="btnStart">Clic aqu&iacute; cuando est&eacute; listo para empezar</a>
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

<script src="/psytest/resources/js/tests.js"></script>
<script src="/psytest/resources/js/testsDialog.js"></script>

<script>
// Loads data of the test
testData.testId = <?php echo $test['id'] ?>; 
exposureTime = <?php echo $test['exposure']?>;

// Loads information of the slides of the test
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
	

function showStartButton() {
	if (timer != null)
		clearInterval(timer);
	
	if (numPreloaded == images.length) {
		$('#loading').empty();
		var startLink = $('<a href="#" id="btnStart">Clic aqu&iacute; cuando est&eacute; listo para empezar</a>');
		$('#loading').append(startLink);
		startLink.click(function(e) {
			$('#slide').empty();
			doStart();
		});
    } else {
    	timer = setInterval(function(){ showStartButton(); }, 200);
    }
}

$(document).ready(function() {
	// preload images
	preload(slides);

	// Opens test taker dialog
	//$("#dialog-form").dialog("open");
	
	showStartButton();
	
	// Handles clic on emotion buttons 
	$('.emotion-button').click(function(e) {
	    e.preventDefault();
		
	    pickEmotion(slides[current-1].emotion, $(this).attr('rel'));
	});
});
</script>