<div id="main">
	<a href="<?php echo site_url("home/index");?>" class="menu-button"><?php echo $this->lang->line('back_to_menu');?></a>
	<br/>&nbsp;
	<?php if (sizeof($results) > 0):?>
		<div class="number_of_results">
			<?php echo $this->lang->line('label_number_of_results');?>: <strong><?php echo $num_results;?></strong>
		</div>
		
		<table class="CSS_Table_Example">
	    <tr>
	      <td><?php echo $this->lang->line('label_name');?></td>
	      <td><?php echo $this->lang->line('label_age');?></td>
	      <td><?php echo $this->lang->line('label_date');?></td>
	      <td><?php echo $this->lang->line('label_code');?></td>
	      <td><?php echo $this->lang->line('label_expected_answer');?></td>
	      <td><?php echo $this->lang->line('label_provided_answer');?></td>
	      <td><?php echo $this->lang->line('label_diff_time');?></td>
	    </tr>
	    <?php 
	    $prevId = -1;
	    
		for ($i=0; $i<sizeof($results); $i++) {
			$result = $results[$i];
			
			echo "<tr>";
			
			if ($prevId != $result["id"]) {
				$count = 1;
			
				for ($j=$i+1; $j<sizeof($results); $j++) {
					if ($result["id"] == $results[$j]["id"]) {
						$count++;
					} else {
						break;
					}
				}
			
				echo "<td rowspan='".$count."'>" . $result['firstname'] . ' ' . $result['lastname'] . "</td>";
				echo "<td rowspan='".$count."'>" . $result['age'] . "</td>";
				echo "<td rowspan='".$count."'>" . $result['date'] . "</td>";
			
				$prevId = $result["id"];
			}
			
			echo "<td>" . $result['pic_code'] . "</td>";
			echo "<td>" . $result['target_time'] . "</td>";
			echo "<td>" . $result['actual_time'] . "</td>";
			echo "<td>" . abs($result['target_time'] - $result['actual_time']) . "</td>";
			echo "</tr>";
		}?>
		</table>	
	<?php 
	else:
		echo '<br/>'.$this->lang->line('error_no_results_yet');
	endif;?>
</div>