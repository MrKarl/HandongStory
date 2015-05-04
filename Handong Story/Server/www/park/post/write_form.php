<?php
	$Title = array_key_exists('Title', $_REQUEST) ? $_REQUEST['Title'] : "";
	$Writer = array_key_exists('Writer', $_REQUEST) ? $_REQUEST['Writer'] : "";
	$Content = array_key_exists('Content', $_REQUEST) ? $_REQUEST['Content'] : "";
	$Category = array_key_exists('Category', $_REQUEST) ? $_REQUEST['Category'] : "";
	
	// $Good = array_key_exists('Good', $param) ? $param['Good'] : 0;
	// $Hate = array_key_exists('Hate', $param) ? $param['Hate'] : 0;
	
	//$Created = array_key_exists('Created', $_REQUEST) ? $_REQUEST['Created'] : date("Y-m-d H:i:s");
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>	글쓰기 Form	</title>
		
		<script language="javascript">
		function check_submit() {
  
			if (document.post_form.Title.value == "") {
                alert('제목을 입력하세요');
                document.post_form.Title.focus();
                return;
                 
			} else if (document.post_form.Writer.value == "") {
                alert('이름을 입력하세요');				
                document.post_form.Writer.focus();
                return;
                
			} else if (document.post_form.Content.value == "") {
                alert('내용을 입력하세요');
                document.post_form.Content.focus();
                return;
                
			} else if (document.post_form.Category.value == "") {
                alert('카테고리를 입력하세요');
                document.post_form.Category.focus();
                return;
                
			} else {
                document.post_form.action = "write_check.php";
                document.post_form.submit();
			}
		}
		</script>
	</head>
	
	<body>
		<form name="post_form" action="write_check.php" method="POST">
			<table border=0 cellspacing=0 cellpadding=0>
				<tr>
					<td align="left">Writer <input type="text" name="Writer" maxlength="20"/></td>
				
					<td align="left"> Category
					<select name="Category">
								<option value="">분야선택</option>
								<option value="Android">안드로이드</option>
								<option value="iOS">iOS</option>
								<option value="JAVA">자바</option>
								<option value="C++/C">C/C++</option>
								<option value="Rails / Ruby">루비/레일즈</option>
								<option value="Jango / Phython">파이선/장고</option>
								<option value="CodeIgniter / PHP">PHP/코드이그나이터</option>
							</select>
					</td>
				</tr>
	
				<tr>
					<td colspan="2" align="left">Title 
					<input type="text" name="Title" size="61" width="100%" maxlength="50"/></td>
				</tr>
	
				<tr>
					<td colspan="2" valign="top"><textarea rows="20" name="Content" cols="60"></textarea>
					</td>
				</tr>
								
				<tr>
					<td colspan="2"><center>
						<input type="button" value="Write" onClick="javascript:check_submit();"/>
						<input type="button" value="Back" onClick="javascript:check_submit();"/>
					</center></td>
				</tr>
		

		</table>
</form>			
		
		
	</body>
</html>
