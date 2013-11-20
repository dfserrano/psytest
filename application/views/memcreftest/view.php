<!-- Modal Dialog -->
<?php $this->load->view('templates/summary_dialog');?>
<?php $this->load->view('templates/user_dialog');?>

<div id="main" style="text-align: center">
	<div id="slide" style="position:relative; height:500px; width:900px; display:inline-block; text-align:center">
		<div id="instructions" style="text-align:center">
			<h2><?php echo $this->lang->line('instr_header');?></h2>
			<br/>
			<?php echo $this->lang->line('instr_cref_mem');?>
			<br/><br/>
		</div>
		<div id="loading" style="text-align:center; width:100%">
			<img src="<?php echo base_url() . 'resources/img/ajax-loader.gif'?>"/> 
			<br/><?php echo $this->lang->line('label_wait_while_loading');?>...<br/>
		</div>
	</div>
</div>

<script src="<?php echo base_url() . 'resources/js/memtests.js'?>"></script>
<script src="<?php echo base_url() . 'resources/js/testsDialog.js'?>"></script>

<script>
// url for ajax save
urlSave = "<?php echo base_url() . 'index.php/memcreftest/save'?>";
	
// Loads data of the test
testData.testId = <?php echo $test['id'] ?>; 
testData.disturbance = <?php echo $test['disturbance'] ?>;
exposureTime = <?php echo $test['exposure']?>;

// Loads information of the slides of the test
slides = [<?php 
		if (sizeof($slides) > 0) {
			$count = 0;
			$prevType = 5;
			foreach ($slides as $slide) {
				echo "{";
				echo "path: '" . base_url() . "resources/img/set1/" . $slide['path'] . "', ";
				echo "code: '" . $slide['code'] . "', ";
				echo "pic_id: '" . $slide['picture_fk'] . "', ";
				echo "emotion: '" . $slide['emotion'] . "', ";
				echo "type: '" . $slide['type'] . "', ";
				echo "rotation: " . $slide['rotation'] . ", ";
				echo "flip: " . $slide['flip'] . ", ";
				echo "width: " . $slide['width'] . ", ";
				echo "height: " . $slide['height'];
				echo "}, ";
			}
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
	$("#dialog-form").dialog("open");
	
	showStartButton();
	
});
</script>