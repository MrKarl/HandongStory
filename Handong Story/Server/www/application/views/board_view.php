<?php
	foreach($param as $entry){
		$title = $entry->title;
		$content = $entry->content;
		$hit = $entry->hit;
		$created_date = $entry->created_date;
		$modified_date = $entry->modified_date;
		$img_path = $entry->img_path;
		$uid = $entry->uid;
	}

?>
	<div id="main_list">
		<center>


			<table>
				<tr>
					<td colspan='3'>제목 <?php echo $title;?></td>
				</tr>
				<tr>
					<td>글쓴이 <?php echo $uid;?></td>
					<td>날짜 <?php echo $modified_date;?></td>
					<td>조회수 <?php echo $hit;?></td>
				</tr>
				<tr>
					<td colspan='3'><textarea rows="50" cols="50"><?php echo $content;?></textarea></td>
				</tr>
				<tr>
					<td colspan='3'><img src='/<?php echo $img_path ?>' width='300'/></td>
				</tr>

			</table>

			<a href="/board/"><button type="button">뒤로</button></a>

		</center>
	</div>