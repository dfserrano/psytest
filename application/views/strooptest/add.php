<div id="main">
	<?php echo validation_errors(); ?>
	<?php echo form_open_multipart('strooptest/add') ?>
		<fieldset>
			<label for="name">Nombre</label>
			<input type="text" id="name" name="name" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			<label for="disturbance">Perturbador</label>
			<select id="disturbance" name="disturbance" class="text ui-widget-content ui-corner-all slide-input">
				<option value="0">Ninguno</option>
				<option value="1">Color de fondo</option>
			</select>
			<br/>
			<label for="type">Tipo</label>
			<select id="type" name="type" class="text ui-widget-content ui-corner-all slide-input">
				<option value="1">Sin color</option>
				<option value="2">Color</option>
				<option value="3">Color diferente</option>
			</select>
			<br/>
			<label for="num_questions">N. Preguntas</label>
			<select id="num_questions" name="num_questions" class="text ui-widget-content ui-corner-all slide-input">
				<?php 
				for ($i=1; $i<=120; $i++) {
					?>
					<option value="<?php echo $i?>"><?php echo $i?></option>
					<?php 
				}
				?>
			</select>
			<br/>
			<label for="exposure">Exposici&oacute;n</label>
			<select id="exposure" name="exposure" class="text ui-widget-content ui-corner-all slide-input">
				<?php 
				for ($i=1; $i<=120; $i++) {
					?>
					<option value="<?php echo ($i * 1000)?>"><?php echo $i?> s.</option>
					<?php 
				}
				?>
			</select>
			<br/><br/>
			
			<div id="slides">
				<?php 
				$initial_slides = 3;
				for ($i = 1; $i<=$initial_slides; $i++):?>
					<div class="slide">
						<div class="slide-info">
							<label for="word" class="slide-label">Palabra</label>
							<input type="text" id="word" name="word[]" class="text ui-widget-content ui-corner-all slide-input" />
							<br/>
							<label for="color" class="slide-label">Color</label>
							<select id="color" name="color[]" class="text ui-widget-content ui-corner-all slide-input">
								<option value="black">Negro</option>
								<option value="green">Verde</option>
								<option value="red">Rojo</option>
								<option value="blue">Azul</option>
								<option value="purple">Purpura</option>
								<option value="yellow">Amarillo</option>
								<option value="orange">Naranja</option>
								<option value="magenta">Magenta</option>
							</select>
						</div>
					</div>
				<?php endfor?>
				
			</div>
			<div style="width:320px; text-align:right">
				<a href="#" id="add-slide" title="Agregar Palabra">
				<img src="<?php echo base_url() . 'resources/img/add_contact_small.png'?>" />
				</a>
			</div>
			
			<input type="submit" value="Guardar" />
		</fieldset>
	<?php form_close();?>
</div>

<div class="slide" id="clone-slide" style="display:none">
	<div class="slide-info">
		<label for="word" class="slide-label">Palabra</label>
		<input type="text" id="word" name="word[]" class="text ui-widget-content ui-corner-all slide-input" />
		<br/>
		<label for="color" class="slide-label">Color</label>
		<select id="color" name="color[]" class="text ui-widget-content ui-corner-all slide-input">
			<option value="black">Negro</option>
			<option value="green">Verde</option>
			<option value="red">Rojo</option>
			<option value="blue">Azul</option>
			<option value="purple">Purpura</option>
			<option value="yellow">Amarillo</option>
			<option value="orange">Naranja</option>
			<option value="magenta">Magenta</option>
		</select>
	</div>
</div>

<script>
	curIndex = 0;
	
	$('#add-slide').click(function(event) {
		event.preventDefault();
		var cloned = $('#clone-slide').clone();
		cloned.attr('id', '');
		cloned.css({'display': 'block'});
		cloned.appendTo('#slides');
		$('.btn-pick', cloned).click(openFaceDialog);
	});

</script>