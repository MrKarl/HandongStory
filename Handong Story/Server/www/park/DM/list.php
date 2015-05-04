<?php
	$p1 = $_POST['password1'] ? $_POST['password1'] : -1;
	$p2 = $_POST['password2'] ? $_POST['password2'] : -1;
	$p3 = $_POST['password3'] ? $_POST['password3'] : -1;
	$id = $_POST['id'] ? $_POST['id'] : -1;
	

	if($id != -1 && $p1 != -1 && $p2 != -1 && $p3 != -1){
		$password = array();

		$db_host = "localhost";
		$db_user = "root";
		$db_passwd = "hdsoftware2013";
		$db_name = "db_test_park";
		
		$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
		if(mysqli_connect_errno()){
			echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
		}

		
		$query1 = "SELECT * FROM user WHERE id = '{$id}'";
		$result = mysqli_query($conn,$query1);

		while($row = mysqli_fetch_array($result)){
			$password[0] = $row['pw1'];

			$password[1] = $row['pw2'];
			$password[2] = $row['pw3'];
			$password[3] = 1;
		}
		mysqli_close($conn);
		if($password[3] == 1){
			echo "이미 존재하는 아이디입니다. 다시 시도해주세요.<BR>";
			echo "<a href='./index.php'><button type='button'>로그인화면으로가기</button></a>";
			echo "<a href='./register.php'><button type='button'>가입화면으로가기</button></a>";
			break;
		}else{
			$db_host = "localhost";
			$db_user = "root";
			$db_passwd = "hdsoftware2013";
			$db_name = "db_test_park";
			$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
			$query2 = "INSERT INTO user (id, pw1, pw2, pw3)
					   VALUES ('{$id}','{$p1}','{$p2}','{$p3}')";
			$result = mysqli_query($conn,$query2);
			echo "등록되었습니다.<BR>";
			echo "<a href='./index.php'><button type='button'>로그인화면으로가기</button></a>";
			echo "<a href='./register.php'><button type='button'>가입화면으로가기</button></a>";
			mysqli_close($conn);
			break;
		}
		
	}


?>
<!doctype html>
<html>
	<head>
		<title> 이산수학 컬러-암호 프로젝트 </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<!-- Bootstrap -->
   		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>


	<body>

		<ul class="nav nav-tabs">
		  <li>
		    <a href="./index.php">로그인</a>
		  </li>
		  <li><a href="./register.php">가입하기</a></li>
		  <li class="active"><a href="./list.php">가입자리스트</a></li>
		</ul>


		<div id="list-table">
			<table class="table table-bordered" align="center">
				<tr>
					<th width="20px">#</th>
					<th>ID</th>
					<th>PW COLOR1</th>
					<th>PW COLOR2</th>
					<th>PW COLOR3</th>
				</tr>

				<?php
					$db_host = "localhost";
					$db_user = "root";
					$db_passwd = "hdsoftware2013";
					$db_name = "db_test_park";
					
					$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);

					$query1 = "SELECT * FROM user";
					$result = mysqli_query($conn,$query1);

					$i = 1;
					while($row = mysqli_fetch_array($result)){
						echo "<tr>
								<td width='20px'>{$i}</td>
								<td>{$row['id']}</td>
								<td bgcolor='{$row['pw1']}'>{$row['pw1']}</td>
								<td bgcolor='{$row['pw2']}'>{$row['pw2']}</td>
								<td bgcolor='{$row['pw3']}'>{$row['pw3']}</td>
							  </tr>";
						$i++;
					}
				?>
				<!-- <td colspan='5'>
					<tr>
						<a href='./index.php'><button type='button'>로그인화면으로가기</button></a>
						<a href='./register.php'><button type='button'>가입화면으로가기</button></a>
					</tr>
				</td> -->
		</div>
	
		

	</body>

	
</html>
