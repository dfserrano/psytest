<?php echo form_error('code', '<span class="error">', '</span>'); ?>
<?php echo form_error('emotion', '<span class="error">', '</span>'); ?>
<?php echo form_error('userfile', '<span class="error">', '</span>'); ?>

<div id="main">
	<?php echo validation_errors(); ?>
	<div>
		<a href="#" id="btn-add"><?php echo $this->lang->line('add_face');?></a><br/><br/>
	</div>
	<div id="dialog-form" title="<?php echo $this->lang->line('new_face');?>">
		<div id="upload">
			<p class="validateTips"><?php echo $this->lang->line('label_all_required');?>.</p>
			<?php 
			$attributes = array('id' => 'create-form', 'name' => 'create-form');
			echo form_open_multipart('faces', $attributes);
			?>
			<fieldset>
				<label for="code"><?php echo $this->lang->line('label_code');?></label>
				<input type="text" id="code" name="code" />
				<label for="emotion"><?php echo $this->lang->line('label_emotion');?></label>
				<select id="emotion" name="emotion">
				  <option value="alegria"><?php echo $this->lang->line('option_joy');?></option>
				  <option value="asco"><?php echo $this->lang->line('option_disgust');?></option>
				  <option value="ira"><?php echo $this->lang->line('option_anger');?></option>
				  <option value="miedo"><?php echo $this->lang->line('option_fear');?></option>
				  <option value="sorpresa"><?php echo $this->lang->line('option_surprise');?></option>
				  <option value="tristeza"><?php echo $this->lang->line('option_sadness');?></option>
				  <option value="neutra"><?php echo $this->lang->line('option_neutral');?></option>
				</select> 
				<label for="userfile"><?php echo $this->lang->line('label_image_file');?></label>
				<?php 
				$attributes = array('id' => 'userfile', 'name' => 'userfile');
				echo form_upload($attributes);?>
			</fieldset>
			<?php echo form_close();?>
		</div>
	</div>
	
	<div id="gallery">
	<?php 
	$i = 0;
	$max_per_row = 5;
	
	if (sizeof($pictures) > 0) :
		foreach ($pictures as $picture): ?>
			<div class="pic-item">
				<div class="pic-img" style="width:<?php echo Faces_model::$MAX_THUMB_WIDTH?>px; height:<?php echo Faces_model::$MAX_THUMB_HEIGHT?>px;">
					<img src="<?php echo base_url() . 'resources/img/set1/thumbs/' . $picture['path']?>" />
				</div>
				<div class="pic-info" style="width:<?php echo Faces_model::$MAX_THUMB_WIDTH?>px;">
					<?php echo $picture['code'] . '<br/>' . ucfirst($picture['emotion'])?>
				</div>
			</div>
			<?php 
			if (++$i % $max_per_row == 0) {
				echo "<br/><br/>";
			}
		
		endforeach;
	else:
		echo $this->lang->line('error_no_images_yet');
	endif;
	?>
	</div>
</div>

<script>
var code = $("#code");
var emotion = $("#emotion");
var file = $("#userfile");
var allFields = $([]).add(code).add(emotion).add(file);
var tips = $(".validateTips");

$("#dialog-form").dialog({
	autoOpen: false,
	height: 300,
	width: 350,
	modal: true,
	position: { my: "center", at: "center", of: '#main' },
	buttons: {
		"<?php echo $this->lang->line('label_save');?>": function() {
			var bValid = true;
			allFields.removeClass("ui-state-error");
			bValid = bValid && checkLength( code, "<?php echo $this->lang->line('label_code');?>", 3, 16 );
			bValid = bValid && checkLength( emotion, "<?php echo $this->lang->line('label_emotion');?>", 3, 16 );
			bValid = bValid && checkLength( file, "<?php echo $this->lang->line('label_image_file');?>", 1, 255 );
			
			if ( bValid ) {
				// submit form
				$("#create-form").submit();
				$("#dialog-form").dialog("close");
			}
		},
		"<?php echo $this->lang->line('label_cancel');?>": function() {
			$( this ).dialog("close");
		}
	},
	//open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); },
	close: function() {
		allFields.val("").removeClass( "ui-state-error" );
	}
});

$("#btn-add").click(function( ){
	$("#dialog-form").dialog("open");
});

</script>