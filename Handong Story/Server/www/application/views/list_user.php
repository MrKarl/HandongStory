<?php
	$arr = $data;
	
?>
<table>
	<tr>
		<td>이름</td>
		<td>id</td>
	</tr>

	<?php
		foreach($arr as $entry){
			echo "<tr>";
			echo "<td>{$entry['name']}</td>";
			echo "<td>{$entry['id']}</td>";
			echo "</tr>";
		}


		echo date("Y-M-D H:i:s");
	?>

<table>