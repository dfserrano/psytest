<div id="main">
	<?php 
	$allowed_roles_add = array('admin', 'digit_admin');
	$allowed_roles_report = array('admin', 'digit_admin', 'digit_viewer');
	
	$username = $this->session->userdata('username');
	$role = $this->session->userdata('role');
	
	if ($username && in_array($role, $allowed_roles_add)) {
		?>
		<div>
			<a href="<?php echo site_url("digittest/add");?>" id="btn-add"><?php echo $this->lang->line('add_test');?></a><br/><br/>
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
					<a href="<?php echo site_url("digittest/" . $test['id']);?>">[<?php echo $this->lang->line('take_test');?>]</a>
					&nbsp;
					<a href="<?php echo site_url("digittest/results/" . $test['id']);?>">[<?php echo $this->lang->line('results');?>]</a>
					<?php 
					if ($username && in_array($role, $allowed_roles_report)) {
						?>
						&nbsp;
						<a href="<?php echo site_url("digittest/report/" . $test['id']);?>">[<?php echo $this->lang->line('report');?>]</a>
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
