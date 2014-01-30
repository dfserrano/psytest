<div id="main">
	<?php echo validation_errors();?>
	<?php echo form_open_multipart('creftest/edit_taker/' . $taker["id"]) ?>
		<fieldset>
			<input type="hidden" id="id" name="id" value="<?php echo $taker["id"]?>"/>
			<input type="hidden" id="test_fk" name="test_fk" value="<?php echo $taker["test_fk"]?>"/>
			
			<label for="name"><?php echo $this->lang->line('label_name');?></label>
			<input type="text" id="name" name="name" value="<?php echo $taker["firstname"]?>" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			<label for="lastname"><?php echo $this->lang->line('label_lastname');?></label>
			<input type="text" id="lastname" name="lastname" value="<?php echo $taker["lastname"]?>" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			<label for="age"><?php echo $this->lang->line('label_age');?></label>
			<input type="text" id="age" name="age" value="<?php echo $taker["age"]?>" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			<label for="docid"><?php echo $this->lang->line('label_id_doc');?></label>
			<input type="text" id="docid" name="docid" value="<?php echo $taker["docid"]?>" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			
			<input type="submit" value="<?php echo $this->lang->line('label_save');?>" />
		</fieldset>
	<?php form_close();?>
</div>

<script>
	
</script>