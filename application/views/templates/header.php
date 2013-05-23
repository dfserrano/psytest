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
<script src="/psytest/resources/js/transformations.js"></script>
<script src="/psytest/resources/js/images.js"></script>
<script src="/psytest/resources/js/simpleValidation.js"></script>

<style type="text/css">
::selection {
	background-color: #E13300;
	color: white;
}

::moz-selection {
	background-color: #E13300;
	color: white;
}

::webkit-selection {
	background-color: #E13300;
	color: white;
}

body {
	background-color: #fff;
	/*margin: 40px;*/
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#body {
	margin: 0 15px 0 15px;
}

p.footer {
	text-align: right;
	font-size: 11px;
	border-top: 1px solid #D0D0D0;
	line-height: 32px;
	padding: 0 10px 0 10px;
	margin: 20px 0 0 0;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

#dialog-form,#dialog-modal {
	font-size: 62.5%;
}

label,input {
	display: block;
}

input.text {
	margin-bottom: 12px;
	width: 95%;
	padding: .4em;
}

fieldset {
	padding: 0;
	border: 0;
	margin-top: 25px;
}

div#users-contain {
	width: 350px;
	margin: 20px 0;
}

div#users-contain table {
	margin: 1em 0;
	border-collapse: collapse;
	width: 100%;
}

div#users-contain table td,div#users-contain table th {
	border: 1px solid #eee;
	padding: .6em 10px;
	text-align: left;
}

.ui-dialog .ui-state-error {
	padding: .3em;
}

.validateTips {
	border: 1px solid transparent;
	padding: 0.3em;
}

.emotion-button {
	padding: 10px;
	line-height: 25pt;
	font-size: 16pt;
	text-decoration: none;
	text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;
}

.slide {
	border: gray solid 1px;
	padding: 10px;
	width: 400px;
	margin-bottom: 10px;
}

.slide-pic {
	display: inline-block;
}

.slide-info {
	display: inline-block;
	vertical-align: top;
}

.slide-label {
	display: inline-block;
	width: 90px;
	padding-bottom: 10px;
}

.slide-input {
	display: inline-block;
	margin-bottom: 10px;
}
</style>
</head>
<body>
	<h1>
		<?php echo $title?>
	</h1>