<div id="main">
	<?php echo validation_errors(); ?>
	<?php echo form_open_multipart('digittest/add') ?>
		<fieldset>
			<label for="name"><?php echo $this->lang->line('label_name');?></label>
			<input type="text" id="name" name="name" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			<label for="disturbance"><?php echo $this->lang->line('label_disturber');?></label>
			<select id="disturbance" name="disturbance" class="text ui-widget-content ui-corner-all slide-input">
				<option value="0"><?php echo $this->lang->line('option_none');?></option>
				<option value="1"><?php echo $this->lang->line('option_bgcolor');?></option>
			</select>
			<br/><br/>
			<label for="exposure"><?php echo $this->lang->line('label_exposition');?></label>
			<select id="exposure" name="exposure" class="text ui-widget-content ui-corner-all slide-input">
				<?php for ($i = 500; $i<20000; $i += 500):?>
				<option value="<?php echo $i?>"><?php echo ($i/1000) . " s."?></option>
				<?php endfor?>
			</select> 
			<br/><br/>
			<label for="type"><?php echo $this->lang->line('label_type');?></label>
			<select id="type" name="type" class="text ui-widget-content ui-corner-all slide-input">
				<option value="1"><?php echo $this->lang->line('option_direct');?></option>
				<option value="2"><?php echo $this->lang->line('option_inverse');?></option>
			</select>
			<br/><br/>
			
			<input type="submit" value="<?php echo $this->lang->line('label_save');?>" />
		</fieldset>
	<?php form_close();?>
</div>