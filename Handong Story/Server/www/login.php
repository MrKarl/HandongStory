<?php
		$hostname_localhost = "localhost";
		$database_localhost = "_handongstory";
		$id_localhost= "root";
		$password_localhost = "hdsortware2013";
		$localhost = mysql_connect($hostname_localhost, $id_localhost, $password_localhost)
or
trigger_error(mysql_error(), E_USER_ERROR);
		$id = $_POST['id'];
		$password = crypt(md5($_POST['password']));
		$query_search = "select * from table_user where id= '".$id."' AND password = '".$password."'";
		$query_exec = mysql_query($query_search); or die(mysql_error());
		$rows = mysql_num_rows($query_exec);

		if($rows == 0){
			echo "User Found";
		}else{
			echo "No Such User Found";
		}
	
?>
