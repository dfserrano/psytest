<?php echo form_error('code', '<span class="error">', '</span>'); ?>
<?php echo form_error('emotion', '<span class="error">', '</span>'); ?>
<?php echo form_error('userfile', '<span class="error">', '</span>'); ?>

<div id="main">
	<div>
		<a href="#" id="btn-add">Agregar cara</a><br/><br/>
	</div>
	<div id="dialog-form" title="Nueva cara">
		<div id="upload">
			<p class="validateTips">Todos los datos son requeridos.</p>
			<?php 
			$attributes = array('id' => 'create-form', 'name' => 'create-form');
			echo form_open_multipart('faces', $attributes);
			?>
			<fieldset>
				<label for="code">C&oacute;digo</label>
				<input type="text" id="code" name="code" />
				<label for="emotion">Emotion</label>
				<select id="emotion" name="emotion">
				  <option value="alegria">Alegria</option>
				  <option value="asco">Asco</option>
				  <option value="ira">Ira</option>
				  <option value="miedo">Miedo</option>
				  <option value="sorpresa">Sorpresa</option>
				  <option value="tristeza">Tristeza</option>
				  <option value="neutra">Neutra</option>
				</select> 
				<label for="userfile">Imagen</label>
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
		echo "A&uacute;n no hay im&aacute;genes";
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
		"Guardar": function() {
			var bValid = true;
			allFields.removeClass("ui-state-error");
			bValid = bValid && checkLength( code, "codigo", 3, 16 );
			bValid = bValid && checkLength( emotion, "emocion", 3, 16 );
			bValid = bValid && checkLength( file, "imagen", 1, 255 );
			
			if ( bValid ) {
				// submit form
				$("#create-form").submit();
				$("#dialog-form").dialog("close");
			}
		},
		"Cancelar": function() {
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