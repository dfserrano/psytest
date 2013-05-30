<?php 
$this->load->helper('url');
?>
<html>
<head>
<title><?php echo $title ?></title>
<link rel="stylesheet"
	href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="<?php echo base_url() . 'resources/js/transformations.js'?>"></script>
<script src="<?php echo base_url() . 'resources/js/images.js'?>"></script>
<script src="<?php echo base_url() . 'resources/js/simpleValidation.js'?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'resources/css/theme.css'?>">

</head>
<body>
	<h1>
		<?php echo $title?>
	</h1>