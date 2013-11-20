<div id="main">
	<a href="<?php echo site_url("home/index");?>" class="menu-button"><?php echo $this->lang->line('back_to_menu');?></a>
	<br/>&nbsp;
	<?php if (sizeof($results) > 0):?>
		<table class="CSS_Table_Example">
	    <tr>
	      <td><?php echo $this->lang->line('label_name');?></td>
	      <td><?php echo $this->lang->line('label_age');?></td>
	      <td><?php echo $this->lang->line('label_date');?></td>
	      <td><?php echo $this->lang->line('label_question');?></td>
	      <td><?php echo $this->lang->line('label_expected_answer');?></td>
	      <td><?php echo $this->lang->line('label_provided_answer');?></td>
	      <td><?php echo $this->lang->line('label_time');?></td>
	    </tr>
	    <?php 
		foreach ($results as $code=>$result) {
			echo "<tr>";
			echo "<td>" . $result['firstname'] . ' ' . $result['lastname'] . "</td>";
			echo "<td>" . $result['age'] . "</td>";
			echo "<td>" . $result['date'] . "</td>";
			echo "<td>" . $result['num'] . "</td>";
			echo "<td style='background-color:".$result['target']."'>" . $result['target'] . "</td>";
			echo "<td style='background-color:".$result['actual']."'>" . $result['actual'] . "</td>";
			echo "<td>" . $result['time'] . "</td>";
			echo "</tr>";
		}?>
		</table>	
	<?php 
	else:
		echo '<br/>'.$this->lang->line('error_no_results_yet');
	endif;?>
</div>