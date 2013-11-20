<div id="dialog-modal" title="<?php echo $this->lang->line('label_pick_face');?>">
<div id="dialog-modal-message">
<?php
$i = 0;
$max_per_row = 6;

if (sizeof($pictures) > 0) :
			foreach ($pictures as $picture): ?>
				<a href="#" rel="<?php echo $picture['id'] . ";" . $picture['path']?>" class="pick-pic" style="text-decoration:none">
					<div class="pic-item">
						<div class="pic-img" style="width:<?php echo Faces_model::$MAX_THUMB_WIDTH?>px; height:<?php echo Faces_model::$MAX_THUMB_HEIGHT?>px;">
							<img src="<?php echo base_url() . 'resources/img/set1/thumbs/' . $picture['path']?>" />
						</div>
						<div class="pic-info" style="width:<?php echo Faces_model::$MAX_THUMB_WIDTH?>px;">
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
			echo $this->lang->line('error_no_images_yet');
		endif;
		?>
	</div>
</div>