<div id="main">
	<a href="<?php echo site_url("home/index");?>" class="menu-button">Volver a Men&uacute;</a>
	<?php if (sizeof($results) > 0):?>
		<br/>&nbsp;
	    <table width="100%" class="CSS_Table_Example">
	    <tr>
	      <td>Nombre</td>
	      <td>Edad</td>
	      <td>Fecha</td>
	      <td>Codigo de imagen</td>
	      <td>Respuesta Esperada</td>
	      <td>Respuesta Otorgada</td>
	      <td>Tiempo (ms)</td>
	    </tr>
	    <?php 
		foreach ($results as $code=>$result) {
			echo "<tr>";
			echo "<td>" . $result['firstname'] . ' ' . $result['lastname'] . "</td>";
			echo "<td>" . $result['age'] . "</td>";
			echo "<td>" . $result['date'] . "</td>";
			echo "<td>" . $result['pic_code'] . "</td>";
			echo "<td>" . $result['target'] . "</td>";
			echo "<td>" . $result['actual'] . "</td>";
			echo "<td>" . $result['time'] . "</td>";
			echo "</tr>";
		}?>
		</table>	
	<?php 
	else:
		echo "No hay resultados disponibles";
	endif;?>
</div>