<div id="main">
	<?php if (isset($error) && strlen($error) > 0) echo $error . '<br/>'; ?>
	<?php echo validation_errors(); ?>
	<?php echo form_open('user/login') ?>
		<fieldset>
			<label for="username"><?php echo $this->lang->line('label_username');?></label>
			<input type="text" id="username" name="username" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			<label for="password"><?php echo $this->lang->line('label_password');?></label>
			<input type="password" id="password" name="password" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			
			<input type="submit" value="<?php echo $this->lang->line('label_enter');?>" />
		</fieldset>
	<?php form_close();?>
</div>