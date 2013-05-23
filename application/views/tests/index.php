<div id="main" style="text-align: center; height:100%; text-align:left; padding:15px">
	<div>
		<a href="<?php echo site_url("tests/add");?>" id="btn-add">Agregar test</a><br/><br/>
	</div>
	
	<div id="gallery" style="text-align:left">
	<?php 	
	if (sizeof($tests) > 0) :
		foreach ($tests as $test): ?>
			<div id="test-item" style="padding:3px; ">
				<div id="test-info" style="inline-block; width: 250px; display:inline-block;">
					<?php echo "<strong>" . $test['name'] . '</strong> - ' . $test['date']?>
				</div>
				<div id="test-actions" style="display:inline-block;">
					<a href="<?php echo site_url("tests/" . $test['id']);?>">[Ver]</a>
				</div>
			</div>
			<?php 
		endforeach;
	else:
		echo "A&uacute;n no hay pruebas";
	endif;
	?>
	</div>
</div>
