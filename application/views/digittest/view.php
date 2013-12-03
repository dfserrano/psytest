<!-- Modal Dialog -->
<?php $this->load->view('templates/summary_dialog');?>
<?php $this->load->view('templates/user_dialog');?>

<div id="main" style="text-align: center">
	<div id="slide"
		style="position: relative; height: 500px; width: 700px; display: inline-block; text-align: left">
		<div id="instructions" style="text-align: center">
			<h2><?php echo $this->lang->line('instr_header');?></h2>
			<br />
			<?php echo $this->lang->line('instr_digits');?> 
			<?php if ($test['type'] == 2) $this->lang->line('instr_digits_desc');?>. <br /> <br />
		</div>
		<div id="loading" style="text-align: center; width: 100%">
			<img src="<?php echo base_url() . 'resources/img/ajax-loader.gif'?>" />
			<br /><?php echo $this->lang->line('label_wait_while_loading');?>...<br />
		</div>
	</div>
	<div id="buttons" style="text-align: center">
		<a href="#" rel="0" class="emotion-button">0</a>
		<a href="#" rel="1" class="emotion-button">1</a>
		<a href="#" rel="2" class="emotion-button">2</a>
		<a href="#" rel="3" class="emotion-button">3</a>
		<a href="#" rel="4" class="emotion-button">4</a>
		<a href="#" rel="5" class="emotion-button">5</a>
		<a href="#" rel="6" class="emotion-button">6</a>
		<a href="#" rel="7" class="emotion-button">7</a>
		<a href="#" rel="8" class="emotion-button">8</a>
		<a href="#" rel="9" class="emotion-button">9</a> 
	</div>
</div>

<script
	src="<?php echo base_url() . 'resources/js/digittests.js'?>"></script>
<script>
var continueButtonString = "<?php echo $this->lang->line('continue');?>";
</script>
<script
	src="<?php echo base_url() . 'resources/js/testsDialog.js'?>"></script>

<script>
// url for ajax save
urlSave = "<?php echo base_url() . 'index.php/digittest/save'?>";
	
// Loads data of the test
testData.testId = <?php echo $test['id'] ?>; 
testData.disturbance = <?php echo $test['disturbance'] ?>;
testData.type = <?php echo $test['type'] ?>;
exposureTime = <?php echo $test['exposure']?>;

//strings for summary report
label_num_right = '<?php echo $this->lang->line('label_num_right');?>';
label_num_wrong = '<?php echo $this->lang->line('label_num_wrong');?>';
label_avg_time_right = '<?php echo $this->lang->line('label_avg_time_right');?>';
label_avg_time_wrong = '<?php echo $this->lang->line('label_avg_time_wrong');?>';
label_avg_time_total = '<?php echo $this->lang->line('label_avg_time_total');?>';
error_save = '<?php echo $this->lang->line('error_save');?>';

function showStartButton() {
	if (timer != null)
		clearInterval(timer);
	
	$('#loading').empty();
	var startLink = $('<a href="#" id="btnStart"><?php echo $this->lang->line('label_click_when_ready');?></a>');
	$('#loading').append(startLink);
	startLink.click(function(e) {
		e.preventDefault();
		$('#slide').empty();
		doStart();
	});
}

$(document).ready(function() {
	// Opens test taker dialog
	$("#dialog-form").dialog("open");
	
	showStartButton();
	
	// Handles clic on emotion buttons 
	$('.emotion-button').click(function(e) {
		if (prevRandomDigit != -1) {
		    e.preventDefault();
			
		    pickDigit($(this).attr('rel'));
		} else {
			alert("<?php echo $this->lang->line('error_button_disabled_bef_test');?>");
		}
	});
});
</script>
