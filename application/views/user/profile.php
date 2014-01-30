<div id="main">
	<table>
		<tr>
		<td><strong><?php echo $this->lang->line('label_name');?>:</strong></td>
		<td><?php echo $results["name"]?></td>
		</tr>
		<tr>
		<td><strong><?php echo $this->lang->line('label_username');?>:</strong></td>
		<td><?php echo $results["username"]?></td>
		</tr>
		<tr>
		<td><strong><?php echo $this->lang->line('label_role');?>:</strong></td>
		<td><?php echo $results["role"]?></td>
		</tr>
		<tr>
		<td><strong><?php echo $this->lang->line('label_password');?></strong></td>
		<td>***** <a href="<?php echo site_url("user/change_password");?>"><?php echo $this->lang->line('label_change_password');?></a></td>
		</tr>
	</table>
</div>