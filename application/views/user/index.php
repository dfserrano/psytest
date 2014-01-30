<div id="main">
	<a href="<?php echo site_url("home/index");?>" class="menu-button"><?php echo $this->lang->line('back_to_menu');?></a>
	<br/>&nbsp;
	<div>
		<a href="<?php echo site_url("user/add");?>" id="btn-add"><?php echo $this->lang->line('label_add_user');?></a><br/><br/>
	</div>
	<?php if (sizeof($results) > 0):?>
		
		<table class="CSS_Table_Example">
		
	    <tr>
	      <td><?php echo $this->lang->line('label_name');?></td>
	      <td><?php echo $this->lang->line('label_username');?></td>
	      <td><?php echo $this->lang->line('label_role');?></td>
	      <td><?php echo $this->lang->line('label_delete');?></td>
	    </tr>
	    <?php 
	    $prevId = -1;
	    
		for ($i=0; $i<sizeof($results); $i++) {
			$result = $results[$i];
			
			echo "<tr>";
			echo "<td>" . $result['name'] . "</td>";
			echo "<td>" . $result['username'] . "</td>";
			echo "<td>" . $result['role'] . "</td>";
			echo "<td><a href='#' class='delete-button' rel='" . $result['id'] . "'>" . $this->lang->line('label_delete') . "</a></td>";
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
			window.location.href = "<?php echo site_url("user/delete")?>/" + id;
		}
	});
</script>