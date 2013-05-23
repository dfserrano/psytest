<!-- Modal Dialog -->
<div id="dialog-modal" title="Escoja una cara">
	<div id="dialog-modal-message">
		<?php 
		$i = 0;
		$max_per_row = 6;
		
		if (sizeof($pictures) > 0) :
			foreach ($pictures as $picture): ?>
				<a href="#" rel="<?php echo $picture['id'] . ";" . $picture['path']?>" class="pick-pic" style="text-decoration:none">
				<div id="pic-item" style="display:inline-block; border:gray solid 1px; padding:3px; ">
					<div id="pic-img" style="width:<?php echo Faces_model::$MAX_THUMB_WIDTH?>px; height:<?php echo Faces_model::$MAX_THUMB_HEIGHT?>px; overflow:hidden; margin-left:auto; margin-right:auto">
						<img src="/psytest/resources/img/set1/thumbs/<?php echo $picture['path']?>" />
					</div>
					<div id="pic-info" style="text-align: center; font-size: 8pt; width:<?php echo Faces_model::$MAX_THUMB_WIDTH?>px; overflow:hidden; margin-left:auto;">
						<?php echo $picture['code'] . '<br/>' . ucfirst($picture['emotion'])?>
					</div>
				</div>
				</a>
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

<div id="main" style="text-align: center; height:100%; text-align:left; padding:15px; padding-top:0px">
	<?php echo form_open_multipart('tests/add') ?>
		<fieldset>
			<label for="name">Nombre</label>
			<input type="text" id="name" name="name" />
			<br/>
			<label for="disturbance">Perturbador</label>
			<select id="disturbance" name="disturbance">
				<option value="0">Ninguno</option>
				<option value="1">Color de fondo</option>
			</select>
			<br/><br/>
			<label for="exposure">Exposici&oacute;n</label>
			<select id="exposure" name="exposure">
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
						<div class="slide-pic" style="width:97px; height:124px; overflow: hidden; text-align:center">
							<a href="#" id="btnPick" class="btn-pick"><img id="slide-img" class="slide-img" src="/psytest/resources/img/no-image.jpg" /></a>
							<input type="hidden" name="pic[]" id="pic" value="" />
						</div>
						<div class="slide-info">
							<label for="posx" class="slide-label">X</label>
							<input type="text" id="posx" name="posx[]" class="slide-input" />px
							<br/>
							<label for="posy" class="slide-label">Y</label>
							<input type="text" id="posy" name="posy[]" class="slide-input" />px
							<br/>
							<label for="rotation" class="slide-label">Rotaci&oacute;n</label>
							<input type="text" id="rotation" name="rotation[]" class="slide-input" />&deg;
							<br/>
							<label for="flip" class="slide-label">Voltear</label>
							<select id="flip" name="flip[]" class="slide-input">
								<option value="0">Ninguno</option>
								<option value="1">Horizontalmente</option>
								<option value="2">Verticalmente</option>
								<option value="3">Ambos</option>
							</select>
						</div>
					</div>
				<?php endfor?>
				
			</div>
			<div>
				<a href="#" id="add-slide">Agregar imagen</a>
			</div>
			
			<input type="submit" />
		</fieldset>
	<?php form_close();?>
</div>

<div class="slide" id="clone-slide" style="display:none">
	<div class="slide-pic" style="width:97px; height:124px; overflow:hidden; text-align:center">
		<a href="#" id="btnPick" class="btn-pick"><img id="slide-img" class="slide-img" src="/psytest/resources/img/no-image.jpg" /></a>
		<input type="hidden" name="pic[]" id="pic" value="" />
	</div>
	<div class="slide-info">
		<label for="posx" class="slide-label">X</label>
		<input type="text" id="posx" name="posx[]" class="slide-input" />px
		<br/>
		<label for="posy" class="slide-label">Y</label>
		<input type="text" id="posy" name="posy[]" class="slide-input" />px
		<br/>
		<label for="rotation" class="slide-label">Rotaci&oacute;n</label>
		<input type="text" id="rotation" name="rotation[]" class="slide-input" />&deg;
		<br/>
		<label for="flip" class="slide-label">Voltear</label>
		<select id="flip" name="flip[]" class="slide-input">
			<option value="0">Ninguno</option>
			<option value="1">Horizontalmente</option>
			<option value="2">Verticalmente</option>
			<option value="3">Ambos</option>
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
		
		$('.slide-img', curSlide).attr('src', '/psytest/resources/img/set1/' + picPath);
		$('#pic', curSlide).val(picId);

		$("#dialog-modal").dialog("close");
	});
</script>