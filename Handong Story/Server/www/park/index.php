<?php
	//require_once("$_SERVER[DOCUMENT_ROOT]/park/post/PostClass.php");
	require_once("./post/PostClass.php");
	
	$start_page = array_key_exists('start_page', $_REQUEST) ? $_REQUEST['start_page'] : 0;
	$record_scale = array_key_exists('record_scale', $_REQUEST) ? $_REQUEST['record_scale'] : 15;
	
	
	$post = new PostClass();
	$total_record = $post->getPostCount();			// Record 총 개수
	
	$page_scale = 10;											// Record / Page	=    Block
	//$start_page => Current Page
	
	$total_page =  ceil($total_record / $record_scale);		// the number of Page
	$total_block = floor($total_page/$page_scale);						// the number of Block
	$current_block = floor($start_page/$page_scale);				// Current Block
	
	$start_record = ($start_page * $record_scale);
	//phpinfo();
?>


<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title> 글쓰기 Test </title>
				
	</head>

	<body>
		<a href="./post/write_form.php"><input type="button" value="Write"/></a>
		
		<table>
			<tr>
				<td>글번호</td>
				<td>제목</td>
				<td>글쓴이</td>
				<td>생성날짜</td>
			</tr>
				
		<?php
			
			$RECORDS = $post->getPostsToArray($start_record, $record_scale);
		
			for($i=1; $i<=$record_scale; $i++){
		    	if($i<=$total_record){
		    		// $j = $start_page*$record_scale + $i;
		      		// if($j<=$total_record){
					$j = $total_record - $start_page*$record_scale - $i;
		      		if($j>0){
		       			echo "
							<tr id='row_".$j."' name ='rows' style='cursor:hand';>
			        	 		<th>".$j."</th>
			        	 		<th><a href='./post/view.php?PID=".$RECORDS[$i-1]->PID."&start_page=".$start_page."'>".$RECORDS[$i-1]->Title."</a></th>
			        	 		<th>".$RECORDS[$i-1]->Writer."</th>
								<th>".$RECORDS[$i-1]->Created_Date."</th>
			        		</tr>";			
					}									
		        }
		    }

			?>
		</table>
		
		
	
	
	
		<?php		
			echo "<div id='paging' style='text-align:center;'>";
			if($current_block>0){// 이전 링크 출력 조건. 현재 블럭 번호가 0보다 클 경우
				$p_start = ($current_block-1)*$page_scale;
				$link = "<a href='?start_page=${p_start}&record_scale=${record_scale}'>";
				$link .="이전";
				$link .= "</a>";
				echo $link."";
			}

			$is = $current_block * $page_scale; // 현재 페이지가 몇번째 페이지냐?
			for($i=$is; $i<$is+$page_scale; $i++){
				if($i < $total_page){
					$link = "<a href='?start_page=${i}&record_scale=${record_scale}'>";
					$link .= $i+1;
					$link .= "</a>";
					echo $link." ";
				}
			}

			if($current_block < $total_block){
				$link = "<a href='?start_page=${i}&record_scale=${record_scale}'>";
				$link .="다음";
				$link .= "</a>";
				echo $link;
			}
			echo "</div>";
		?>
		
	</body>

	
	
	
</html>