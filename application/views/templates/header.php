<?php 
$this->load->helper('url');
?>
<html>
<head>
<title><?php echo $title ?></title>
<link rel="stylesheet"
	href="<?php echo base_url() . 'resources/css/jquery-ui.css'?>" />
<script src="<?php echo base_url() . 'resources/js/jquery-1.9.1.js'?>"></script>
<script src="<?php echo base_url() . 'resources/js/jquery-ui.js'?>"></script>
<script src="<?php echo base_url() . 'resources/js/transformations.js'?>"></script>
<script src="<?php echo base_url() . 'resources/js/images.js'?>"></script>
<script src="<?php echo base_url() . 'resources/js/simpleValidation.js'?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'resources/css/theme.css'?>">

</head>
<body>
	<h1>
		<?php echo $title?>
	</h1>
	<div class="login">
	<?php 
	$username = $this->session->userdata('username');
	
	if ($username) {
		echo $this->lang->line('label_loggedin_as') . 
			" <a href=" . site_url("user/profile") . ">" . $username . "</a> ";
		?>
		<a href="<?php echo site_url("user/logout");?>">[<?php echo $this->lang->line('label_exit');?>]</a>
		<?php 
	} else {
		?>
		<a href="<?php echo site_url("user/login");?>"><?php echo $this->lang->line('label_enter');?></a>
		<?php
	}
	?>
	</div>