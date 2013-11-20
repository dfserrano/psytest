<div id="main">
	<?php echo validation_errors(); ?>
	<?php echo form_open_multipart('strooptest/add') ?>
		<fieldset>
			<label for="name"><?php echo $this->lang->line('label_name');?></label>
			<input type="text" id="name" name="name" class="text ui-widget-content ui-corner-all slide-input" />
			<br/>
			<label for="disturbance"><?php echo $this->lang->line('label_disturber');?></label>
			<select id="disturbance" name="disturbance" class="text ui-widget-content ui-corner-all slide-input">
				<option value="0"><?php echo $this->lang->line('option_none');?></option>
				<option value="1"><?php echo $this->lang->line('option_bgcolor');?></option>
			</select>
			<br/>
			<label for="type"><?php echo $this->lang->line('label_type');?></label>
			<select id="type" name="type" class="text ui-widget-content ui-corner-all slide-input">
				<option value="1"><?php echo $this->lang->line('option_no_color');?></option>
				<option value="2"><?php echo $this->lang->line('option_color');?></option>
				<option value="3"><?php echo $this->lang->line('option_different_color');?></option>
			</select>
			<br/>
			<label for="num_questions"><?php echo $this->lang->line('label_num_questions');?></label>
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
			<label for="exposure"><?php echo $this->lang->line('label_exposition');?></label>
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
							<label for="word" class="slide-label"><?php echo $this->lang->line('label_word');?></label>
							<input type="text" id="word" name="word[]" class="text ui-widget-content ui-corner-all slide-input" />
							<br/>
							<label for="color" class="slide-label"><?php echo $this->lang->line('label_color');?></label>
							<select id="color" name="color[]" class="text ui-widget-content ui-corner-all slide-input">
								<option value="black"><?php echo $this->lang->line('option_black');?></option>
								<option value="green"><?php echo $this->lang->line('option_green');?></option>
								<option value="red"><?php echo $this->lang->line('option_red');?></option>
								<option value="blue"><?php echo $this->lang->line('option_blue');?></option>
								<option value="purple"><?php echo $this->lang->line('option_purple');?></option>
								<option value="yellow"><?php echo $this->lang->line('option_yellow');?></option>
								<option value="orange"><?php echo $this->lang->line('option_orange');?></option>
								<option value="magenta"><?php echo $this->lang->line('option_magenta');?></option>
							</select>
						</div>
					</div>
				<?php endfor?>
				
			</div>
			<div style="width:320px; text-align:right">
				<a href="#" id="add-slide" title="<?php echo $this->lang->line('label_add_word');?>">
				<img src="<?php echo base_url() . 'resources/img/add_contact_small.png'?>" />
				</a>
			</div>
			
			<input type="submit" value="<?php echo $this->lang->line('label_save');?>" />
		</fieldset>
	<?php form_close();?>
</div>

<div class="slide" id="clone-slide" style="display:none">
	<div class="slide-info">
		<label for="word" class="slide-label"><?php echo $this->lang->line('label_word');?></label>
		<input type="text" id="word" name="word[]" class="text ui-widget-content ui-corner-all slide-input" />
		<br/>
		<label for="color" class="slide-label"><?php echo $this->lang->line('label_color');?></label>
		<select id="color" name="color[]" class="text ui-widget-content ui-corner-all slide-input">
			<option value="black"><?php echo $this->lang->line('option_black');?></option>
			<option value="green"><?php echo $this->lang->line('option_green');?></option>
			<option value="red"><?php echo $this->lang->line('option_red');?></option>
			<option value="blue"><?php echo $this->lang->line('option_blue');?></option>
			<option value="purple"><?php echo $this->lang->line('option_purple');?></option>
			<option value="yellow"><?php echo $this->lang->line('option_yellow');?></option>
			<option value="orange"><?php echo $this->lang->line('option_orange');?></option>
			<option value="magenta"><?php echo $this->lang->line('option_magenta');?></option>
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