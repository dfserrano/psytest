<div id="main">
	<?php if (isset($error) && strlen($error) > 0) echo $error . '<br/>'; ?>
	<?php echo validation_errors(); ?>
	<?php echo form_open('user/add') ?>
		<fieldset>
			<label for="username"><?php echo $this->lang->line('label_username');?></label>
			<input type="text" id="username" name="username" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			<label for="password"><?php echo $this->lang->line('label_password');?></label>
			<input type="password" id="password" name="password" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			
			<label for="role"><?php echo $this->lang->line('label_role');?></label>
			<select id="role" name="role" class="text ui-widget-content ui-corner-all slide-input">
				<option value="admin"><?php echo $this->lang->line('option_admin');?>
				<option value="cref_admin"><?php echo $this->lang->line('option_cref_admin');?>
				<option value="cref_viewer"><?php echo $this->lang->line('option_cref_viewer');?>
				<option value="digit_admin"><?php echo $this->lang->line('option_digit_admin');?>
				<option value="digit_viewer"><?php echo $this->lang->line('option_digit_viewer');?>
				<option value="memcref_admin"><?php echo $this->lang->line('option_memcref_admin');?>
				<option value="memcref_viewer"><?php echo $this->lang->line('option_memcref_viewer');?>
				<option value="stroop_admin"><?php echo $this->lang->line('option_stroop_admin');?>
				<option value="stroop_viewer"><?php echo $this->lang->line('option_stroop_viewer');?>
				<option value="timedcref_admin"><?php echo $this->lang->line('option_timedcref_admin');?>
				<option value="timedcref_viewer"><?php echo $this->lang->line('option_timedcref_viewer');?>
			</select>
			
			
			<input type="submit" value="<?php echo $this->lang->line('label_save');?>" />
		</fieldset>
	<?php form_close();?>
</div>