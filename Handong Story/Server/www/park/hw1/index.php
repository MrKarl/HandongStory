<?php
	$Color = $_POST["Color"] ? $_POST["Color"] : null;
	$TopBottom = $_POST["TopBottom"] ? $_POST["TopBottom"] : null;
	$Sex = $_POST["Sex"] ? $_POST["Sex"] : null;
	$Category = $_POST["Category"] ? $_POST["Category"] : null;
	$Style = $_POST["Style"] ? $_POST["Style"] : null;
	$Preference = $_POST["Preference"] ? $_POST["Preference"] : null;
	$Note = $_POST["Note"] ? $_POST["Note"] : null;

	
	if($Color != null){
		
		$db_host = "localhost";
		$db_user = "root";
		$db_passwd = "hdcapstone2013";
		$db_name = "db_test_park";
		
	//	$conn = mysql_connect($db_host,$db_user,$db_passwd) or die("db���� ����");
		$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
		if(mysqli_connect_errno()){
			echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
		}

		$Created = date("Y,m,d H:i:s");
		$result = mysqli_query($conn,"INSERT INTO dev_table_photoes (Color,TopBottom,Sex,Category,Style,Preference,Note,Created)
														VALUES ('$Color','$TopBottom','$Sex','$Category','$Style','$Preference','$Note','$Created') ");
		
		
		echo "result = ".$result."<BR>";
		mysqli_close($conn);
		
		echo "COLOR = ".$Color."<BR>";
	}
	
?>



<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	 
	 Park's Test HomePage  <BR>
 </head>

</body>
	<form method="POST" action="index.php">
		<table>
			<tr colspan = "2">
				<td>
					input your Photoes:<BR>
				</td>
			</tr>
			<tr>
				<td>
					Color :
				</td>
				<td>
					<input type="text" name="Color"/>
				</td>
			</tr>
			<tr>
				<td>
					TopBottom :
				</td>
				<td>
					<input type="text" name="TopBottom"/><BR>
				</td>
			</tr>
			<tr>
				<td>
					Sex :
				</td>
				<td>
					<input type="text" name="Sex"/><BR>
				</td>
			</tr>
			<tr>
				<td>
					Category :
				</td>
				<td>
					<input type="text" name="Category"/><BR>
				</td>
			<tr>
			</tr>
				<td>
					Style :
				</td>
				<td>
					<input type="text" name="Style"/><BR>
				</td>
			</tr>
			<tr>
				<td>
					Preference :
				</td>
				<td>
					<input type="text" name="Preference"/><BR>
				</td>
			</tr>
			<tr>
				<td>
					Note :
				</td>
				<td>
					<input type="text" name="Note"/><BR>
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="submit">
				</td>
			</tr>
		</table>
	</form>
	
	<?php
		$db_host = "localhost";
		$db_user = "root";
		$db_passwd = "hdcapstone2013";
		$db_name = "db_test_park";
		
		$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
		if(mysqli_connect_errno()){
			echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
		}
		
		echo "<table>
					<tr>
						<td>Number</td>
						<td>Color</td>
						<td>Category</td>
						<td>Style</td>
						<td>Preference</td>
					</tr>";
		$result = mysqli_query($conn,"SELECT * FROM dev_table_photoes");
		$i = 0;
		while($row = mysqli_fetch_array($result)){
			$i++;
		    echo "<tr>
						<td>".$i."</td>".
						"<td>".$row['Color']."</td>".
						"<td>".$row['Category']."</td>".
						"<td>".$row['Style']."</td>".
						"<td>".$row['Preference']."</td>
					</tr>";						
	    }
		echo "</table>";
	?>
	
	
</body>

</html>