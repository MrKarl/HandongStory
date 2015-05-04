<?php
	$p1 = $_POST['password1'] ? $_POST['password1'] : -1;
	$p2 = $_POST['password2'] ? $_POST['password2'] : -1;
	$p3 = $_POST['password3'] ? $_POST['password3'] : -1;
	$id = $_POST['id'] ? $_POST['id'] : -1;
	

	if($id != -1 && $p1 != -1 && $p2 != -1 && $p3 != -1){

		$password = array();

		// echo "입력한 ID = ".$id; echo"<BR>";
		// echo "입력한 COLOR1 = ".$p1; echo"<BR>";
		// echo "입력한 COLOR2 = ".$p2; echo"<BR>";
		// echo "입력한 COLOR3 = ".$p3; echo"<BR>";

		$db_host = "localhost";
		$db_user = "root";
		$db_passwd = "hdsoftware2013";
		$db_name = "db_test_park";
		
		$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
		if(mysqli_connect_errno()){
			echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
		}

		
		$query1 = "SELECT * FROM user WHERE id = '{$id}'";
		//$query = "SELECT * FROM user WHERE id = 'park'";
		$result = mysqli_query($conn,$query1);

		while($row = mysqli_fetch_array($result)){
			$password[0] = $row['pw1'];

			$password[1] = $row['pw2'];
			$password[2] = $row['pw3'];
			$password[3] = 1;
		}

		if($password[3] == 1){
			// echo "비밀번호 COLOR1 = ".$password[0]; echo"<BR>";
			// echo "비밀번호 COLOR2 = ".$password[1]; echo"<BR>";
			// echo "비밀번호 COLOR3 = ".$password[2]; echo"<BR>";
			if($password[0] == $p1 && $password[1] == $p2 && $password[2] == $p3 ){
				echo "LOGIN 되었습니다.";
			}else{
				echo "비밀번호가 틀렸습니다.";
			}

		}else{
			echo "해당 아이디가 없습니다.";
		}
		// print_r($password);
		mysqli_close($conn);
	}


?>
<!doctype html>
<html>
	<head>
		<title> 이산수학 컬러-암호 프로젝트 </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<!-- Bootstrap -->
   		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
   		<link href="bootstrap/css/pick-a-color-1.1.8.min.css" rel="stylesheet" >
		<script>
			var color1 = $('#p1').val();
			var color2 = $('#p2').val();
			var color3 = $('#p3').val();

			hexcolor1 = $('#hexcolor1');
			hexcolor2 = $('#hexcolor1');
			hexcolor3 = $('#hexcolor1');
			
			hexcolor1.html(color1);
			hexcolor2.html(color2);
			hexcolor3.html(color3);

			$('#p1').on('change', function() {  
				hexcolor1.html(this.value);  
			});
			$('#p2').on('change', function() {  
				hexcolor2.html(this.value);  
			});
			$('#p3').on('change', function() {  
				hexcolor3.html(this.value);  
			});
		</script>

	</head>


	<body>
		<ul class="nav nav-tabs">
		  <li class="active">
		    <a href="./index.php">로그인</a>
		  </li>
		  <li><a href="./register.php">가입하기</a></li>
		  <li><a href="./list.php">가입자리스트</a></li>
		</ul>

		<div id="login-table">
			
			<form method="post">
				<table class="table table-striped" align="center">
					<tr>
						<td><label>Input YOUR ID </label></td>
						<td>
							<div class="control-group info">
								<div class="controls">
									<input type="text" name="id"  placeholder="아이디"/>
									</div>
							</div>
						</td>
					</tr>
					<tr>
						<td><label>Input YOUR PW </label></td>
						<td>
							<div class="control-group info">
								<div class="controls">
									<input type="color" name="password1" value="#ff0000" id="p1"  placeholder="컬러1"/>
									<input type="color" name="password2" value="#ff0000" id="p2"  placeholder="컬러2"/>
									<input type="color" name="password3" value="#ff0000" id="p3"  placeholder="컬러3"/>
								</div>
							</div>
						</td>
					</tr>
					
					<!-- <tr>
						<td>
							<div id="hexcolor1"></div><div id="hexcolor2"></div><div id="hexcolor3"></div>
						</td>
					</tr> -->
					
					<tr colspan='2'>
						<td><input type="submit" value="Login"/></td>
						<!-- <td><a href="./register.php"><button type="button">가입하기</button></a></td> -->
					</tr>
					<tr>
						<!-- <td><a href="./register.php"><button type="button">가입하기</button></a></td>
						<td><a href="./list.php"><button type="button">가입자 리스트 보기</button></a></td>-->
					</tr>
				</table>
			</form>
			
			

		
		</div>
		

		<footer class="footer">
			<div class="container">
				2013년 2학기 한동대학교 이산수학 팀 4-Minutes 컬러와 암호학
			</div>
		</footer>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="bootstrap/js/tinycolor-0.9.14.min.js"></script>
		<script src="bootstrap/js/pick-a-color-1.1.5.min.js"></script>
		

		<script type="text/javascript">
		   $(document).ready(function () {
		    $(".pick-a-color").pickAColor();
		   });
	 	</script>
		
	</body>


</html>
