<div id="main">
	<?php echo validation_errors(); ?>
	<?php echo form_open_multipart('digittest/add') ?>
		<fieldset>
			<label for="name">Nombre</label>
			<input type="text" id="name" name="name" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			<label for="disturbance">Perturbador</label>
			<select id="disturbance" name="disturbance" class="text ui-widget-content ui-corner-all slide-input">
				<option value="0">Ninguno</option>
				<option value="1">Color de fondo</option>
			</select>
			<br/><br/>
			<label for="exposure">Exposici&oacute;n</label>
			<select id="exposure" name="exposure" class="text ui-widget-content ui-corner-all slide-input">
				<?php for ($i = 500; $i<20000; $i += 500):?>
				<option value="<?php echo $i?>"><?php echo ($i/1000) . " s."?></option>
				<?php endfor?>
			</select> 
			<br/><br/>
			<label for="type">Tipo</label>
			<select id="type" name="type" class="text ui-widget-content ui-corner-all slide-input">
				<option value="1">Directo</option>
				<option value="2">Inverso</option>
			</select>
			<br/><br/>
			
			<input type="submit" value="Guardar" />
		</fieldset>
	<?php form_close();?>
</div>