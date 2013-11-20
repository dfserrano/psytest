<!-- Modal Dialog -->
<?php $this->load->view('templates/faces_dialog');?>

<div id="main">
	<?php echo validation_errors(); ?>
	<?php echo form_open_multipart('creftest/add') ?>
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
			
			<div id="slides">
				<?php 
				$initial_slides = 3;
				for ($i = 1; $i<=$initial_slides; $i++):?>
					<div class="slide">
						<div class="slide-pic">
							<a href="#" id="btnPick" class="btn-pick"><img id="slide-img" class="slide-img" src="<?php echo base_url() . 'resources/img/no-image.jpg'?>" /></a>
							<input type="hidden" name="pic[]" id="pic" value="" />
						</div>
						<div class="slide-info">
							<label for="posx" class="slide-label"><?php echo $this->lang->line('label_x');?></label>
							<input type="text" id="posx" name="posx[]" class="text ui-widget-content ui-corner-all slide-input" />px
							<br/>
							<label for="posy" class="slide-label"><?php echo $this->lang->line('label_y');?></label>
							<input type="text" id="posy" name="posy[]" class="text ui-widget-content ui-corner-all slide-input" />px
							<br/>
							<label for="rotation" class="slide-label"><?php echo $this->lang->line('label_rotate');?></label>
							<input type="text" id="rotation" name="rotation[]" class="text ui-widget-content ui-corner-all slide-input" />&deg;
							<br/>
							<label for="flip" class="slide-label"><?php echo $this->lang->line('label_flip');?></label>
							<select id="flip" name="flip[]" class="text ui-widget-content ui-corner-all slide-input">
								<option value="0"><?php echo $this->lang->line('option_none');?></option>
								<option value="1"><?php echo $this->lang->line('option_vertical');?></option>
								<option value="2"><?php echo $this->lang->line('option_horizontal');?></option>
								<option value="3"><?php echo $this->lang->line('option_both');?></option>
							</select>
						</div>
					</div>
				<?php endfor?>
				
			</div>
			<div style="width:320px; text-align:right">
				<a href="#" id="add-slide" title="<?php echo $this->lang->line('label_add_image');?>">
				<img src="<?php echo base_url() . 'resources/img/add_contact_small.png'?>" />
				</a>
			</div>
			
			<input type="submit" value="<?php echo $this->lang->line('label_save');?>" />
		</fieldset>
	<?php form_close();?>
</div>

<div class="slide" id="clone-slide" style="display:none">
	<div class="slide-pic">
		<a href="#" id="btnPick" class="btn-pick"><img id="slide-img" class="slide-img" src="<?php echo base_url() . 'resources/img/no-image.jpg'?>" /></a>
		<input type="hidden" name="pic[]" id="pic" value="" />
	</div>
	<div class="slide-info">
		<label for="posx" class="slide-label"><?php echo $this->lang->line('label_x');?></label>
		<input type="text" id="posx" name="posx[]" class="text ui-widget-content ui-corner-all slide-input" />px
		<br/>
		<label for="posy" class="slide-label"><?php echo $this->lang->line('label_y');?></label>
		<input type="text" id="posy" name="posy[]" class="text ui-widget-content ui-corner-all slide-input" />px
		<br/>
		<label for="rotation" class="slide-label"><?php echo $this->lang->line('label_rotate');?></label>
		<input type="text" id="rotation" name="rotation[]" class="text ui-widget-content ui-corner-all slide-input" />&deg;
		<br/>
		<label for="flip" class="slide-label"><?php echo $this->lang->line('label_flip');?></label>
		<select id="flip" name="flip[]" class="text ui-widget-content ui-corner-all slide-input">
			<option value="0"><?php echo $this->lang->line('option_none');?></option>
			<option value="1"><?php echo $this->lang->line('option_horizontal');?></option>
			<option value="2"><?php echo $this->lang->line('option_vertical');?></option>
			<option value="3"><?php echo $this->lang->line('option_both');?></option>
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

	$("#dialog-modal" ).dialog({
		height: 275,
		width: 400,
		modal: true
	});
	$("#dialog-modal").dialog("close");

	$('.btn-pick').click(openFaceDialog);

	function openFaceDialog(event) {
		event.preventDefault();
		var parent = $(this).parent().parent();
		curIndex = parent.index();
		
		$("#dialog-modal").dialog("open");
	}

	$('.pick-pic').click(function(event) {
		event.preventDefault();
		
		var data = $(this).attr("rel");
		
		var idxSemicolon = data.indexOf(";");
		var picId = data.substring(0, idxSemicolon);
		var picPath = data.substring(idxSemicolon+1);
		
		console.log(picId+" "+picPath);
		
		var curSlide = $('.slide').get(curIndex);
		var img = $('.slide-img', curSlide);
		
		$('.slide-img', curSlide).attr('src', '<?php echo base_url()?>resources/img/set1/' + picPath);
		$('#pic', curSlide).val(picId);

		$("#dialog-modal").dialog("close");
	});
</script>