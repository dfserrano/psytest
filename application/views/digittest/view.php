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
			<br /> A continuaci&oacute;n usted vera una serie de n&uacute;meros.
			Trate de memorizar la secuencia y dig&iacute;telos<?php if ($test['type'] == 2) echo " en orden inverso";?>. <br /> <br />
		</div>
		<div id="loading" style="text-align: center; width: 100%">
			<img src="<?php echo base_url() . 'resources/img/ajax-loader.gif'?>" />
			<br />Espere mientras se carga la prueba...<br />
		</div>
	</div>
	<div id="buttons" style="text-align: center">
		<a href="#" rel="0" class="emotion-button">0</a>
		<a href="#" rel="1" class="emotion-button">1</a>
		<a href="#" rel="2" class="emotion-button">2</a>
		<a href="#" rel="3" class="emotion-button">3</a>
		<a href="#" rel="4" class="emotion-button">4</a>
		<a href="#" rel="5" class="emotion-button">5</a>
		<a href="#" rel="6" class="emotion-button">6</a>
		<a href="#" rel="7" class="emotion-button">7</a>
		<a href="#" rel="8" class="emotion-button">8</a>
		<a href="#" rel="9" class="emotion-button">9</a> 
	</div>
</div>

<script
	src="<?php echo base_url() . 'resources/js/digittests.js'?>"></script>
<script
	src="<?php echo base_url() . 'resources/js/testsDialog.js'?>"></script>

<script>
// url for ajax save
urlSave = "<?php echo base_url() . 'index.php/digittest/save'?>";
	
// Loads data of the test
testData.testId = <?php echo $test['id'] ?>; 
testData.disturbance = <?php echo $test['disturbance'] ?>;
testData.type = <?php echo $test['type'] ?>;
exposureTime = <?php echo $test['exposure']?>;

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
		if (prevRandomDigit != -1) {
		    e.preventDefault();
			
		    pickDigit($(this).attr('rel'));
		} else {
			alert("El botón solo funciona cuando inicia la prueba");
		}
	});
});
</script>
