<!-- Modal Dialog -->
<?php $this->load->view('templates/summary_dialog');?>
<?php $this->load->view('templates/user_dialog');?>

<div id="main" style="text-align: center">
	<div id="slide"
		style="position: relative; height: 500px; width: 700px; display: inline-block; text-align: left">
		<div id="instructions" style="text-align: center">
			<h2><?php echo $this->lang->line('instr_header');?></h2>
			<br /> 
			<?php 
			switch ($test['type']) {
				case 1: echo $this->lang->line('instr_stroop_1');
						break;
				case 2: echo $this->lang->line('instr_stroop_2');
						break;
				case 3: echo $this->lang->line('instr_stroop_3');
						break;
			} 
			?>
			<br /> <br />
		</div>
		<div id="loading" style="text-align: center; width: 100%">
			<img src="<?php echo base_url() . 'resources/img/ajax-loader.gif'?>" />
			<br /><?php echo $this->lang->line('label_wait_while_loading');?>...<br />
		</div>
	</div>
	<div id="buttons" style="text-align: center">
		<?php 
		foreach ($slides as $slide) { 
			$option = "";
			$option = $slide['color'];
			/*switch($slide['color']) {
				case 'black': $option = 'black'; break;
				case 'red': $option = 'red'; break;
				case 'green': $option = 'green'; break;
				case 'blue': $option = 'blue'; break;
				case 'purple': $option = 'purple'; break;
				case 'yellow': $option = 'yellow'; break;
				case 'orange': $option = 'orange'; break;
				case 'magenta': $option = 'magenta'; break;
			}*/
			?> 
			<a href="#" rel="<?php echo $option?>" class="emotion-button"><?php echo $slide['word']?></a>
			<?php 
		}
		?>
	</div>
</div>

<script
	src="<?php echo base_url() . 'resources/js/strooptests.js'?>"></script>
<script
	src="<?php echo base_url() . 'resources/js/testsDialog.js'?>"></script>

<script>
// url for ajax save
urlSave = "<?php echo base_url() . 'index.php/strooptest/save'?>";
	
// Loads data of the test
testData.testId = <?php echo $test['id'] ?>; 
testData.disturbance = <?php echo $test['disturbance'] ?>;
testData.exposure = <?php echo $test['exposure'] ?>;
testData.type = <?php echo $test['type'] ?>;
testData.numQuestions = <?php echo $test['num_questions'] ?>;

//strings for summary report
label_num_right = '<?php echo $this->lang->line('label_num_right');?>';
label_num_wrong = '<?php echo $this->lang->line('label_num_wrong');?>';
label_avg_time_right = '<?php echo $this->lang->line('label_avg_time_right');?>';
label_avg_time_wrong = '<?php echo $this->lang->line('label_avg_time_wrong');?>';
label_avg_time_total = '<?php echo $this->lang->line('label_avg_time_total');?>';
error_save = '<?php echo $this->lang->line('error_save');?>';

// Loads information of the slides of the test
slides = [<?php 
		foreach ($slides as $slide) {
			echo "{";
			echo "word: '" . $slide['word'] . "', ";
			echo "color: '" . $slide['color'] . "', ";
			echo "}, ";
		}
		?>];
	

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
		if (current > 0) {
		    e.preventDefault();
			
		    pickColor(curTargetColor, $(this).attr('rel'));
		} else {
			alert("<?php echo $this->lang->line('error_button_disabled_bef_test');?>");
		}
	});
});
</script>
