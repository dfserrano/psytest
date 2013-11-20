<div id="main">
	<?php 
	$username = $this->session->userdata('username');
	
	if ($username) {
		?>
		<div>
			<a href="<?php echo site_url("creftest/add");?>" id="btn-add"><?php echo $this->lang->line('add_test');?></a><br/><br/>
		</div>
		<?php 
	}
	?>
	
	<div id="gallery">
	<?php 	
	if (sizeof($tests) > 0) :
		foreach ($tests as $test): ?>
			<div class="test-item">
				<div class="test-info">
					<?php echo "<strong>" . $test['name'] . '</strong> - ' . $test['date']?>
				</div>
				<div id="test-actions">
					<a href="<?php echo site_url("creftest/" . $test['id']);?>">[<?php echo $this->lang->line('take_test');?>]</a>
					&nbsp;
					<a href="<?php echo site_url("creftest/results/" . $test['id']);?>">[<?php echo $this->lang->line('results');?>]</a>
					<?php 
					if ($username) {
						?>
						&nbsp;
						<a href="<?php echo site_url("creftest/report/" . $test['id']);?>">[<?php echo $this->lang->line('report');?>]</a>
						<?php 
					}
					?>
				</div>
			</div>
			<?php 
		endforeach;
	else:
		echo $this->lang->line('error_no_test_yet');
	endif;
	?>
	</div>
</div>
