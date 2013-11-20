<div id="main">
	<a href="<?php echo site_url("home/index");?>" class="menu-button"><?php echo $this->lang->line('back_to_menu');?></a>
	<?php if (sizeof($results) > 0):?>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var dataRightWrong = google.visualization.arrayToDataTable([
			['<?php echo $this->lang->line('label_question');?>', '<?php echo $this->lang->line('label_num_right');?>', '<?php echo $this->lang->line('label_num_wrong');?>'],
			<?php 
			foreach ($results as $num=>$result) {
				echo "['$num', " . $result['num_right'] . ", " . $result['num_wrong'] . "],";
			}?>
        ]);

        var dataTime = google.visualization.arrayToDataTable([
			['<?php echo $this->lang->line('label_question');?>', '<?php echo $this->lang->line('label_avg_time_right');?>', '<?php echo $this->lang->line('label_avg_time_wrong');?>', '<?php echo $this->lang->line('label_avg_time_total');?>'],
            <?php 
            foreach ($results as $num=>$result) {
				$avg_right = (($result['num_right'] != 0)? $result['time_right'] / $result['num_right'] : 0);
				$avg_wrong = (($result['num_wrong'] != 0)? $result['time_wrong'] / $result['num_wrong'] : 0);
				$avg_total = (($result['num_right'] != 0 || $result['num_wrong'] != 0)? ($result['time_right']+$result['time_wrong']) / ($result['num_right']+$result['num_wrong']) : 0);
            	echo "['$num', " . $avg_right . ", " . $avg_wrong . ", " . $avg_total . "],";
			}?>
		]);

        var optionsNum = {
    			title: '<?php echo $this->lang->line('label_num_right_vs_wrong');?>',
    			hAxis: {title: '<?php echo $this->lang->line('label_question');?>', titleTextStyle: {color: 'black'}},
        		vAxis: {title: '<?php echo $this->lang->line('label_num_answers');?>', titleTextStyle: {color: 'black'}}
    		};

        var optionsTime = {
    			title: '<?php echo $this->lang->line('label_time_right_vs_wrong');?>',
    			hAxis: {title: '<?php echo $this->lang->line('label_question');?>', titleTextStyle: {color: 'black'}},
    			vAxis: {title: '<?php echo $this->lang->line('label_avg_time');?>', titleTextStyle: {color: 'black'}}
    		};
        

        var chartRightWrong = new google.visualization.ColumnChart(document.getElementById('chartRightWrong'));
        chartRightWrong.draw(dataRightWrong, optionsNum);

        var chartTime = new google.visualization.ColumnChart(document.getElementById('chartTime'));
        chartTime.draw(dataTime, optionsTime);
		
      }
      
      google.setOnLoadCallback(drawVisualization);
    </script>

	<div id="chartRightWrong" style="width: 900px; height: 500px;"></div>
	<div id="chartTime" style="width: 900px; height: 500px;"></div>
	<?php 
	else:
		echo $this->lang->line('error_no_results_yet');
	endif;?>
</div>