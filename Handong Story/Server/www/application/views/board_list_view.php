	<div id="main_list">
		<center>
			<a href="/board/writeform"><button type="button">글쓰기</button></a>

			<table>
				<tr>
					<th>Num</th>
					<th>제목</th>
					<th>글쓴이</th>
					<th>날짜</th>
				</tr>

				<?php
					$all = count($posts);
					$i=$all;
					foreach($posts as $entry){

						echo "<tr>
								<td><a href='/board/view/{$entry->pid}'>{$i}</a></td>
								<td><a href='/board/view/{$entry->pid}'>{$entry->title}</a></td>
								<td><a href='/board/view/{$entry->pid}'>{$entry->uid}</a></td>
								<td><a href='/board/view/{$entry->pid}'>{$entry->created_date}</a></td>
							  </tr>";
						$i--;
					}
					$page = ceil($i/10);
				?>
			</table>

			<div id="more_loading"></div>
		</center>
	</div>