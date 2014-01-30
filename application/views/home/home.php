<?php 
$allowed_roles_bank = array('admin', 'cref_admin', 'memcref_admin', 'timedcref_admin');

$username = $this->session->userdata('username');
$role = $this->session->userdata('role');
?>
<div id="main">
	<div>
		<a href="<?php echo site_url("creftest/index");?>" class="menu-button"><?php echo $this->lang->line('menu_cref');?></a>
	</div>
	<br/>
	<div>
		<a href="<?php echo site_url("timedcreftest/index");?>" class="menu-button"><?php echo $this->lang->line('menu_cref_timed');?></a>
	</div>
	<br/>
	<div>
		<a href="<?php echo site_url("memcreftest/index");?>" class="menu-button"><?php echo $this->lang->line('menu_cref_mem');?></a>
	</div>
	<br/>
	<div>
		<a href="<?php echo site_url("digittest/index");?>" class="menu-button"><?php echo $this->lang->line('menu_digits');?></a>
	</div>
	<br/>
	<div>
		<a href="<?php echo site_url("strooptest/index");?>" class="menu-button"><?php echo $this->lang->line('menu_stroop');?></a>
	</div>
	<?php 
	$username = $this->session->userdata('username');
	
	if ($username && in_array($role, $allowed_roles_bank)) {
		?>
		<br/>
		<div>
			<a href="<?php echo site_url("faces/index");?>" class="menu-button-aux"><?php echo $this->lang->line('menu_image_bank');?></a>
		</div>
		<?php 
	}
	
	if ($username && in_array($role, array("admin"))) {
		?>
			<br/>
			<div>
				<a href="<?php echo site_url("user/index");?>" class="menu-button-aux"><?php echo $this->lang->line('menu_user');?></a>
			</div>
			<?php 
		}
	?>
	
	<br/><br/><br/>
	<div class="languages">
		<?php echo $this->lang->line('label_lang_availability');?>
		<a href="<?php echo site_url("home/switchLanguage/spanish");?>" title="<?php echo $this->lang->line('label_lang_spanish');?>"><img src="<?php echo base_url() . 'resources/img/co.png'?>"/></a>
		<a href="<?php echo site_url("home/switchLanguage/english");?>" title="<?php echo $this->lang->line('label_lang_english');?>"><img src="<?php echo base_url() . 'resources/img/us.png'?>"/></a>
		<a href="<?php echo site_url("home/switchLanguage/portuguese");?>" title="<?php echo $this->lang->line('label_lang_portuguese');?>"><img src="<?php echo base_url() . 'resources/img/br.png'?>"/></a>
	</div>
</div>