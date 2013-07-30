<!-- Modal Dialog -->
<div id="dialog-modal" title="Resumen">
	<div id="dialog-modal-message"></div>
	<div id="dialog-modal-saving" style="display: none">
		<img src="<?php echo base_url() . 'resources/img/ajax-loader.gif'?>"
			style="float: left" />
		<p>&nbsp;Guardando...</p>
	</div>
</div>

<div id="dialog-form" title="Datos del usuario">
	<p class="validateTips">Todos los datos son requeridos.</p>
	<form>
		<fieldset>
			<label for="firstname">Nombre</label> <input type="text"
				name="firstname" id="firstname"
				class="text ui-widget-content ui-corner-all" /> <label
				for="lastname">Apellido</label> <input type="text" name="lastname"
				id="lastname" class="text ui-widget-content ui-corner-all" />
			<!-- <label for="email">Email</label>
			<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />-->
			<label for="age">Edad</label> <input type="text" name="age" id="age"
				value="" class="text ui-widget-content ui-corner-all" /> <label
				for="age">C&eacute;dula</label> <input type="text" name="docid"
				id="docid" value="" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>

<div id="main" style="text-align: center">
	<div id="slide"
		style="position: relative; height: 500px; width: 700px; display: inline-block; text-align: left">
		<div id="instructions" style="text-align: center">
			<h2>Instrucciones</h2>
			<br /> 
			<?php 
			switch ($test['type']) {
				case 1: echo "A continuaci&oacute;n usted ver&aacute; una palabra, y deber&aacute;
							escoger la palabra a la cual se refiere.";
						break;
				case 2: echo "A continuaci&oacute;n usted ver&aacute; una palabra, y deber&aacute;
							escoger el color de la palabra.";
						break;
				case 3: echo "A continuaci&oacute;n usted ver&aacute; una palabra de cierto color, y deber&aacute;
							escoger el color con el cual se escribe la palabra.";
						break;
			} 
			?>
			<br /> <br />
		</div>
		<div id="loading" style="text-align: center; width: 100%">
			<img src="<?php echo base_url() . 'resources/img/ajax-loader.gif'?>" />
			<br />Espere mientras se carga la prueba...<br />
		</div>
	</div>
	<div id="buttons" style="text-align: center">
		<?php 
		foreach ($slides as $slide) { 
			$option = "";
			
			switch($slide['color']) {
				case 'black': $option = "Negro"; break;
				case 'red': $option = "Rojo"; break;
				case 'green': $option = "Verde"; break;
				case 'blue': $option = "Azul"; break;
				case 'purple': $option = "Purpura"; break;
				case 'yellow': $option = "Amarillo"; break;
				case 'orange': $option = "Naranja"; break;
				case 'magenta': $option = "Magenta"; break;
			}
			?> 
			<a href="#" rel="<?php echo $option?>" class="emotion-button"><?php echo $option?></a>
			<?php 
		}
		?>
	</div>
</div>

<script
	src="<?php echo base_url() . 'resources/js/strooptests.js'?>"></script>
<script
	src="<?php echo base_url() . 'resources/js/testsDialog.js'?>"></script>

<script>
// url for ajax save
urlSave = "<?php echo base_url() . 'index.php/strooptest/save'?>";
	
// Loads data of the test
testData.testId = <?php echo $test['id'] ?>; 
testData.disturbance = <?php echo $test['disturbance'] ?>;
testData.exposure = <?php echo $test['exposure'] ?>;
testData.type = <?php echo $test['type'] ?>;
testData.numQuestions = <?php echo $test['num_questions'] ?>;

// Loads information of the slides of the test
slides = [<?php 
		foreach ($slides as $slide) {
			echo "{";
			echo "word: '" . $slide['word'] . "', ";
			echo "color: '" . $slide['color'] . "', ";
			echo "}, ";
		}
		?>];
	

function showStartButton() {
	if (timer != null)
		clearInterval(timer);
	
	$('#loading').empty();
	var startLink = $('<a href="#" id="btnStart">Clic aqu&iacute; cuando est&eacute; listo para empezar</a>');
	$('#loading').append(startLink);
	startLink.click(function(e) {
		e.preventDefault();
		$('#slide').empty();
		doStart();
	});    
}

$(document).ready(function() {
	// Opens test taker dialog
	$("#dialog-form").dialog("open");
	
	showStartButton();
	
	// Handles clic on emotion buttons 
	$('.emotion-button').click(function(e) {
		if (current > 0) {
		    e.preventDefault();
			
		    pickColor(curTargetColor, $(this).attr('rel'));
		} else {
			alert("El botón solo funciona cuando inicia la prueba");
		}
	});
});
</script>
