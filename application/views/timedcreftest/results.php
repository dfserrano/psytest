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
			['Codigo de Imagen', 'Num. Respuestas Sobre-Estimadas', 'Num. Respuestas Infra-Estimadas'],
			<?php 
			foreach ($results as $code=>$result) {
				echo "['$code', " . $result['num_over'] . ", " . $result['num_under'] . "],";
			}?>
        ]);

        var dataTime = google.visualization.arrayToDataTable([
			['Codigo de Imagen', 'Tiempo Promedio Sobre-Estimacion', 'Tiempo Promedio Infra-Estimacion', 'Tiempo Promedio Error Total'],
            <?php 
            foreach ($results as $code=>$result) {
				$avg_over = (($result['num_over'] != 0)? $result['time_over']/$result['num_over'] : 0);
				$avg_under = (($result['num_under'] != 0)? $result['time_under']/$result['num_under'] : 0);
				$avg_total = (($result['num_over'] != 0 || $result['num_under'] != 0)? ($result['time_over']+$result['time_under'])/($result['num_over']+$result['num_under']) : 0);
            	echo "['$code', " . $avg_over . ", " . $avg_under . ", " . $avg_total . "],";
			}?>
		]);

        var optionsNum = {
    			title: 'Sobre-Estimacion vs. Infra-Estimacion - Numero de Respuestas',
    			hAxis: {title: 'Codigo de Imagen', titleTextStyle: {color: 'black'}}, 
    			vAxis: {title: 'Numero de Respuestas', titleTextStyle: {color: 'black'}}
    		};

        var optionsTime = {
    			title: 'Sobre-Estimacion vs. Infra-Estimacion - Tiempo Promedio',
    			hAxis: {title: 'Codigo de Imagen', titleTextStyle: {color: 'black'}},
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