<div id="main">
	<a href="<?php echo site_url("home/index");?>" class="menu-button">Volver a Men&uacute;</a>
	<?php if (sizeof($results) > 0):?>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var dataRightWrong = google.visualization.arrayToDataTable([
			['Pregunta', 'Num. Respuestas Correctas', 'Num. Respuestas Incorrectas'],
			<?php 
			foreach ($results as $num=>$result) {
				echo "['$num', " . $result['num_right'] . ", " . $result['num_wrong'] . "],";
			}?>
        ]);

        var dataTime = google.visualization.arrayToDataTable([
			['Pregunta', 'Tiempo Promedio Correctas', 'Tiempo Promedio Incorrectas', 'Tiempo Promedio Total'],
            <?php 
            foreach ($results as $num=>$result) {
				$avg_right = (($result['num_right'] != 0)? $result['time_right'] / $result['num_right'] : 0);
				$avg_wrong = (($result['num_wrong'] != 0)? $result['time_wrong'] / $result['num_wrong'] : 0);
				$avg_total = (($result['num_right'] != 0 || $result['num_wrong'] != 0)? ($result['time_right']+$result['time_wrong']) / ($result['num_right']+$result['num_wrong']) : 0);
            	echo "['$num', " . $avg_right . ", " . $avg_wrong . ", " . $avg_total . "],";
			}?>
		]);

        var optionsNum = {
    			title: 'Correctas vs. Incorrectas - Numero de Respuestas',
    			hAxis: {title: 'Pregunta', titleTextStyle: {color: 'black'}},
        		vAxis: {title: 'Numero de Respuestas', titleTextStyle: {color: 'black'}}
    		};

        var optionsTime = {
    			title: 'Correctas vs. Incorrectas - Tiempo Promedio',
    			hAxis: {title: 'Pregunta', titleTextStyle: {color: 'black'}},
    			vAxis: {title: 'Tiempo Promedio (ms)', titleTextStyle: {color: 'black'}}
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
		echo "No hay resultados disponibles";
	endif;?>
</div>