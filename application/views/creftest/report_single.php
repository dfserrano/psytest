<html>
<head>
<title><?php echo $this->lang->line('report')?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'resources/css/theme.css'?>">

</head>
<body>
<div id="main">
	<h1><?php echo $this->lang->line('report')?></h1>
	<?php if (sizeof($results) > 0):?>
		<table class="tabla_reporte">
			<tr>
				<td><?php echo $this->lang->line('label_name');?>:</td>
				<td colspan="3"><?php echo $results[0]['firstname'] . ' ' . $results[0]['lastname']?></td>
			</tr>
			<tr>
				<td><?php echo $this->lang->line('label_age');?>:</td>
				<td><?php echo $results[0]['age']?></td>
				<td><?php echo $this->lang->line('label_id_doc');?>:</td>
				<td><?php echo $results[0]['docid']?></td>
			</tr>
			<tr>
				<td><?php echo $this->lang->line('label_date');?>:</td>
				<td colspan="3"><?php echo $results[0]['date']?></td>
			</tr>
		</table>
		
		<hr/>
		
		<table class="tabla_reporte" >
		
	    <tr style="background-color: #E8E8E8">
	      <td><?php echo $this->lang->line('label_code');?></td>
	      <td><?php echo $this->lang->line('label_expected_answer');?></td>
	      <td><?php echo $this->lang->line('label_provided_answer');?></td>
	      <td><?php echo $this->lang->line('label_time');?></td>
	    </tr>
	    <?php 
	    $prevId = -1;
	    
		for ($i=0; $i<sizeof($results); $i++) {
			$result = $results[$i];
			
			echo "<tr>";
			echo "<td>" . $result['pic_code'] . "</td>";
			echo "<td>" . $result['target'] . "</td>";
			echo "<td>" . $result['actual'] . "</td>";
			echo "<td>" . $result['time'] . "</td>";
			echo "</tr>";
		}?>
		</table>	
	<?php 
	else:
		echo '<br/>'.$this->lang->line('error_no_results_yet');
	endif;?>
</div>
</body>
</html>