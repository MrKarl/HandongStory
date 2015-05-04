<?php
	$db_host = "localhost";
	$db_user = "root";
	$db_passwd = "hdcapstone2013";
	$db_name = "db_test_park";
	
	$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
	
				
	if(mysqli_connect_errno()){
		echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
	}
	
	$table_name = "dev_table_post";
	
	for($i=1000; $i<1200; $i++){
		
		$Title = $i."-Title";
		$Writer = $i."-Writer";
		$Content = $i."-Content";
		$Category = $i."-Category";
		$Good = $i."-Good";
		$Hate = $i."-Hate";
		$Created = $i."-Created";
		
		 $query = "INSERT INTO $table_name (Title, Writer, Content, Category, Good, Hate, Created_Date)
						VALUES ('$Title', '$Writer', '$Content', '$Category', $Good, $Hate, '$Created') ";
		
		
		$result = mysqli_query($conn, $query);
	}
	
	mysqli_close($conn);
	
	return $result;

?>