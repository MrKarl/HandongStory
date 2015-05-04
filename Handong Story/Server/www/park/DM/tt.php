<?php
	$id = $_POST['id'] ? $_POST['id'] : -1;
	$pw1 = $_POST['pw'] ? $_POST['pw'] : -1;

	$db_host = "localhost";
	$db_user = "root";
	$db_passwd = "hdsoftware2013";
	$db_name = "db_test_park";
	
	$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
	if(mysqli_connect_errno()){
		echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
	}

	
	$query1 = "INSERT INTO user (id, pw1, pw2, pw3) VALUES ('{$id}', '{$pw1}', '', '')";
	$result = mysqli_query($conn,$query1);

	mysqli_close($conn);
?>