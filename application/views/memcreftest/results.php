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
			['Numero', 'Num. Correcta', 'Num. Erronea'],
			<?php 
			foreach ($results as $num=>$result) {
				echo "['$num', " . $result['num_right'] . ", " . $result['num_wrong'] . "],";
			}?>
        ]);

        var dataTime = google.visualization.arrayToDataTable([
			['Numero', 'Tiempo Correcta', 'Tiempo Erronea'],
            <?php 
            foreach ($results as $num=>$result) {
            	echo "['$num', " . $result['time_right'] . ", " . $result['time_wrong'] . "],";
			}?>
		]);

        var options = {
			title: 'Correctas vs. Erroneas',
			hAxis: {title: 'Pregunta', titleTextStyle: {color: 'black'}}
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