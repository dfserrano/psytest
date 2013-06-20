<div id="main">
	<div>
		<a href="<?php echo site_url("digittest/add");?>" id="btn-add">Agregar test</a><br/><br/>
	</div>
	
	<div id="gallery">
	<?php 	
	if (sizeof($tests) > 0) :
		foreach ($tests as $test): ?>
			<div class="test-item">
				<div class="test-info">
					<?php echo "<strong>" . $test['name'] . '</strong> - ' . $test['date']?>
				</div>
				<div id="test-actions">
					<a href="<?php echo site_url("digittest/" . $test['id']);?>">[Ver]</a>
					&nbsp;
					<a href="<?php echo site_url("digittest/results/" . $test['id']);?>">[Resultados]</a>
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
