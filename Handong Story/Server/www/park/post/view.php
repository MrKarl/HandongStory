<?php
	require_once("./PostClass.php");
	
	$PID = array_key_exists('PID', $_REQUEST) ? $_REQUEST['PID'] : null;
	
	$start_page = array_key_exists('start_page', $_REQUEST) ? $_REQUEST['start_page'] : null;
	
	$post = new PostClass();
	$post  = $post->getPostClass($PID);
	
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>	글읽기 Form	</title>		
	</head>
	
	<body>
		
			<table border=0 cellspacing=0 cellpadding=0>
				<tr>
					<td align="left">Writer
						<?php echo $post->Writer; ?>
					</td>
					
					<td align="left"> Category
						<?php echo $post->Category; ?>
					</td>
				</tr>
	
				<tr>
					<td colspan="2" align="left">Title 
						<?php echo $post->Title; ?>
					</td>
				</tr>
				
				<tr>
					<td colspan="2" align="left">Created_at 
						<?php echo $post->Created; ?>
					</td>
				</tr>
				
				<tr>
					<td colspan="2" valign="top"><?php echo $post->Content; ?></textarea>
					</td>
				</tr>
								
				<tr>
					<td colspan="2"><center>						
						<a href="../index.php?start_page=<?php echo $start_page; ?>">[목록]</a>
					</center></td>
				</tr>		

		</table>	
		
	</body>
</html>
