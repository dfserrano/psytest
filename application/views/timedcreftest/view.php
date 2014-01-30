<!-- Modal Dialog -->
<?php $this->load->view('templates/summary_dialog');?>
<?php $this->load->view('templates/user_dialog');?>

<div id="main" style="text-align: center">
	<div id="slide" style="position:relative; height:500px; width:700px; display:inline-block; text-align:left">
		<div id="instructions" style="text-align:center">
			<h2><?php echo $this->lang->line('instr_header');?></h2>
			<br/>
			<?php echo $this->lang->line('instr_cref_timed');?>
			<br/><br/>
		</div>
		<div id="loading" style="text-align:center; width:100%">
			<img src="<?php echo base_url() . 'resources/img/ajax-loader.gif'?>"/> 
			<br/><?php echo $this->lang->line('label_wait_while_loading');?>...<br/>
		</div>
	</div>
	<div id="buttons" style="text-align:center">
		<a href="#" class="continue-button"><?php echo $this->lang->line('label_here');?></a>
	</div>
</div>

<script src="<?php echo base_url() . 'resources/js/timedtests.js'?>"></script>
<script src="<?php echo base_url() . 'resources/js/testsDialog.js'?>"></script>

<script>
// url for ajax save
urlSave = "<?php echo base_url() . 'index.php/timedcreftest/save'?>";
	
// Loads data of the test
testData.testId = <?php echo $test['id'] ?>; 
testData.disturbance = <?php echo $test['disturbance'] ?>;

// strings for summary report
label_avg_time_overestimated = '<?php echo $this->lang->line('label_avg_time_overestimated');?>';
label_avg_time_underestimated = '<?php echo $this->lang->line('label_avg_time_underestimated');?>';
label_avg_time_total = '<?php echo $this->lang->line('label_avg_time_total');?>';
error_save = '<?php echo $this->lang->line('error_save');?>';

// Loads information of the slides of the test
slides = [<?php 
		foreach ($slides as $slide) {
			echo "{";
			echo "path: '" . base_url() . "resources/img/set1/" . $slide['path'] . "', ";
			echo "code: '" . $slide['code'] . "', ";
			echo "emotion: '" . $slide['emotion'] . "', ";
			echo "exposure: '" . $slide['exposure'] . "', ";
			echo "posx: " . ((empty($slide['posx']))? "null" : $slide['posx']) . ", ";
			echo "posy: " . ((empty($slide['posy']))? "null" : $slide['posy']) . ", ";
			echo "color: " . $slide['color'] . ", ";
			echo "rotation: " . $slide['rotation'] . ", ";
			echo "flip: " . $slide['flip'] . ", ";
			echo "width: " . $slide['width'] . ", ";
			echo "height: " . $slide['height'];
			echo "}, ";
		}
		?>];
	

function showStartButton() {
	if (timer != null)
		clearInterval(timer);
	
	if (numPreloaded == images.length) {
		$('#loading').empty();
		var startLink = $('<a href="#" id="btnStart"><?php echo $this->lang->line('label_click_when_ready');?></a>');
		$('#loading').append(startLink);
		startLink.click(function(e) {
			e.preventDefault();
			$('#slide').empty();
			doStart();
		});
    } else {
    	timer = setInterval(function(){ showStartButton(); }, 200);
    }
}

$(document).ready(function() {
	// preload images
	preload(slides);

	// Opens test taker dialog
	$("#dialog-form").dialog({height: 500, modal:true, autoOpen:true});
	
	showStartButton();
	
	// Handles clic on emotion buttons 
	$('.continue-button').click(function(e) {
		if (current > 0) {
		    e.preventDefault();
			
		    pick(slides[current-1].exposure);
		} else {
			alert("<?php echo $this->lang->line('error_button_disabled_bef_test');?>");
		}
	});
});
</script>