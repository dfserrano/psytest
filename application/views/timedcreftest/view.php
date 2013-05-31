<!-- Modal Dialog -->
<div id="dialog-modal" title="Resumen">
	<div id="dialog-modal-message"></div>
	<div id="dialog-modal-saving" style="display: none">
		<img src="<?php echo base_url() . 'resources/img/ajax-loader.gif'?>" style="float:left"/> 
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
		<div id="instructions" style="text-align:center">
			<h2>Instrucciones</h2>
			<br/>
			A continuaci&oacute;n usted vera una serie de im&aacute;genes.  Cada una de las im&aacute;genes
			se presentar&aacute; durante un tiempo determinado.  Usted deber&aacute; calcular el tiempo 
			en el que la im&aacute;gen estuvo visible y una vez esta se haga invisible,
			dar clic en el bot&oacute;n AQU&Iacute; cuando estime que el mismo tiempo en el que la imagen estuvo 
			visible ha transcurrido.
			<br/><br/>
		</div>
		<div id="loading" style="text-align:center; width:100%">
			<img src="<?php echo base_url() . 'resources/img/ajax-loader.gif'?>"/> 
			<br/>Espere mientras se carga la prueba...<br/>
		</div>
	</div>
	<div id="buttons" style="text-align:center">
		<a href="#" class="continue-button">AQU&Iacute;</a>
	</div>
</div>

<script src="<?php echo base_url() . 'resources/js/timedtests.js'?>"></script>
<script src="<?php echo base_url() . 'resources/js/testsDialog.js'?>"></script>

<script>
// url for ajax save
urlSave = "<?php echo base_url() . 'index.php/timedcreftest/save'?>";
	
// Loads data of the test
testData.testId = <?php echo $test['id'] ?>; 
testData.disturbance = <?php echo $test['disturbance'] ?>;

// Loads information of the slides of the test
slides = [<?php 
		foreach ($slides as $slide) {
			echo "{";
			echo "path: '" . base_url() . "resources/img/set1/" . $slide['path'] . "', ";
			echo "code: '" . $slide['code'] . "', ";
			echo "emotion: '" . $slide['emotion'] . "', ";
			echo "exposure: '" . $slide['exposure'] . "', ";
			echo "posx: " . ((empty($slide['posx']))? "null" : $slide['posx']) . ", ";
			echo "posy: " . ((empty($slide['posy']))? "null" : $slide['posy']) . ", ";
			echo "color: " . $slide['color'] . ", ";
			echo "rotation: " . $slide['rotation'] . ", ";
			echo "flip: " . $slide['flip'] . ", ";
			echo "width: " . $slide['width'] . ", ";
			echo "height: " . $slide['height'];
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
			e.preventDefault();
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
	$("#dialog-form").dialog("open");
	
	showStartButton();
	
	// Handles clic on emotion buttons 
	$('.continue-button').click(function(e) {
		if (current > 0) {
		    e.preventDefault();
			
		    pick(slides[current-1].exposure);
		} else {
			alert("El botón solo funciona cuando inicia la prueba");
		}
	});
});
</script>