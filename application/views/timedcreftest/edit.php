<div id="main">
	<a href="<?php echo site_url("home/index");?>" class="menu-button"><?php echo $this->lang->line('back_to_menu');?></a>
	<br/>&nbsp;
	<?php if (sizeof($results) > 0):?>
		<div class="number_of_results">
			<?php echo $this->lang->line('label_number_of_results');?>: <strong><?php echo sizeof($results);?></strong>
		</div>
		
		<table class="CSS_Table_Example">
		
	    <tr>
	      <td><?php echo $this->lang->line('label_name');?></td>
	      <td><?php echo $this->lang->line('label_age');?></td>
	      <td><?php echo $this->lang->line('label_date');?></td>
	      <td><?php echo $this->lang->line('label_id_doc');?></td>
	      <td><?php echo $this->lang->line('label_edit');?></td>
	      <td><?php echo $this->lang->line('label_delete');?></td>
	      <td><?php echo $this->lang->line('label_report');?></td>
	    </tr>
	    <?php 
		for ($i=0; $i<sizeof($results); $i++) {
			$result = $results[$i];
			
			echo "<tr>";
			echo "<td>" . $result['firstname'] . ' ' . $result['lastname'] . "</td>";
			echo "<td>" . $result['age'] . "</td>";
			echo "<td>" . $result['date'] . "</td>";
			echo "<td>" . $result['docid'] . "</td>";
			echo "<td><a href='" . site_url("timedcreftest/edit_taker/" . $result['id']) . "'>" . $this->lang->line('label_edit') . "</a></td>";
			echo "<td><a href='#' class='delete-button' rel='" . $result['id'] . "'>" . $this->lang->line('label_delete') . "</a></td>";
			echo "<td><a href='" . site_url("timedcreftest/report_single/" . $result['id']) . "' target='_blank'>" . $this->lang->line('label_report') . "</a></td>";
			echo "</tr>";
		}?>
		</table>	
	<?php 
	else:
		echo '<br/>'.$this->lang->line('error_no_results_yet');
	endif;?>
</div>

<script>
	$('.delete-button').click(function(e) {
		answer = confirm("<?php echo $this->lang->line('label_confirmation_delete')?>");

		if (answer) {
			id =  $(this).attr("rel");
			window.location.href = "<?php echo site_url("timedcreftest/delete")?>/" + id;
		}
	});
</script>