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
			['<?php echo $this->lang->line('label_code');?>', '<?php echo $this->lang->line('label_num_overestimated');?>', '<?php echo $this->lang->line('label_num_underestimated');?>'],
			<?php 
			foreach ($results as $code=>$result) {
				echo "['$code', " . $result['num_over'] . ", " . $result['num_under'] . "],";
			}?>
        ]);

        var dataTime = google.visualization.arrayToDataTable([
			['<?php echo $this->lang->line('label_code');?>', '<?php echo $this->lang->line('label_avg_time_overestimated');?>', '<?php echo $this->lang->line('label_avg_time_underestimated');?>', '<?php echo $this->lang->line('label_avg_time_total');?>'],
            <?php 
            foreach ($results as $code=>$result) {
				$avg_over = (($result['num_over'] != 0)? $result['time_over']/$result['num_over'] : 0);
				$avg_under = (($result['num_under'] != 0)? $result['time_under']/$result['num_under'] : 0);
				$avg_total = (($result['num_over'] != 0 || $result['num_under'] != 0)? ($result['time_over']+$result['time_under'])/($result['num_over']+$result['num_under']) : 0);
            	echo "['$code', " . $avg_over . ", " . $avg_under . ", " . $avg_total . "],";
			}?>
		]);

        var optionsNum = {
    			title: '<?php echo $this->lang->line('label_num_over_vs_under');?>',
    			hAxis: {title: '<?php echo $this->lang->line('label_code');?>', titleTextStyle: {color: 'black'}}, 
    			vAxis: {title: '<?php echo $this->lang->line('label_num_answers');?>', titleTextStyle: {color: 'black'}}
    		};

        var optionsTime = {
    			title: '<?php echo $this->lang->line('label_time_over_vs_under');?>',
    			hAxis: {title: '<?php echo $this->lang->line('label_code');?>', titleTextStyle: {color: 'black'}},
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