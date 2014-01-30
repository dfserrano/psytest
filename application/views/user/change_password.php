<div id="main">
	<a href="<?php echo site_url("home/index");?>" class="menu-button"><?php echo $this->lang->line('back_to_menu');?></a>
	<?php if (isset($error) && strlen($error) > 0) echo $error . '<br/>'; ?>
	<?php echo validation_errors(); ?>
	<?php echo form_open('user/change_password') ?>
		<fieldset>
			<label for="password"><?php echo $this->lang->line('label_new_password');?></label>
			<input type="password" id="password" name="password" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			
			<label for="password_confirm"><?php echo $this->lang->line('label_password_conf');?></label>
			<input type="password" id="password_confirm" name="password_confirm" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			<input type="submit" value="<?php echo $this->lang->line('label_save');?>" />
		</fieldset>
	<?php form_close();?>
</div>