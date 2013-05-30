<div id="main">
	<?php if (sizeof($results) > 0):?>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var dataRightWrong = google.visualization.arrayToDataTable([
			['Code', 'Num. Sobre', 'Num. Sub'],
			<?php 
			foreach ($results as $code=>$result) {
				echo "['$code', " . $result['num_over'] . ", " . $result['num_under'] . "],";
			}?>
        ]);

        var dataTime = google.visualization.arrayToDataTable([
			['Code', 'Tiempo Sobre', 'Tiempo Sub', 'Tiempo Error Total'],
            <?php 
            foreach ($results as $code=>$result) {
            	echo "['$code', " . $result['time_over'] . ", " . $result['time_under'] . ", " . ($result['time_over']+$result['time_under']) . "],";
			}?>
		]);

        var options = {
			title: 'Sobre vs. Sub',
			hAxis: {title: 'Code', titleTextStyle: {color: 'black'}}
		};
        

        var chartRightWrong = new google.visualization.ColumnChart(document.getElementById('chartRightWrong'));
        chartRightWrong.draw(dataRightWrong, options);

        var chartTime = new google.visualization.ColumnChart(document.getElementById('chartTime'));
        chartTime.draw(dataTime, options);
		
      }
      
      google.setOnLoadCallback(drawVisualization);
    </script>

	<div id="chartRightWrong" style="width: 900px; height: 500px;"></div>
	<div id="chartTime" style="width: 900px; height: 500px;"></div>
	<?php 
	else:
		echo "No hay resultados disponibles";
	endif;?>
</div>