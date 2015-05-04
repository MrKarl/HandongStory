<script type="text/javascript">

$(document).ready(function(){
    
    $('form#mainForm').bind('submit', function(e){
        e.preventDefault();
        // checkForm();
    });
    
    //$('input#hostName').focus();
	
	function lastAddedLiveFunc(){ 
		$('div#lastPostsLoader').html('<img src="images/loader.gif">');
		//$.post("default.asp?action=getLastPosts&lastPostID="+$(".wrdLatest:last").attr("id"),
		$.post("scroll.asp?action=getLastPosts&lastID=" + $(".wrdLatest:last").attr("id"),    
			//$.post("/welcome/morelisting/&lastPostID="+$(".wrdLatest:last").attr("id"),
		function(data){
			if (data != "") {
				$(".wrdLatest:last").after(data);			
			}
			$('div#lastPostsLoader').empty();
		});
		
	};  
	
	$(window).scroll(function(){
		if  ($(window).scrollTop() == $(document).height() - $(window).height()){
		   lastAddedLiveFunc();
		}
	}); 
});

</script>


	<hr class="bs-docs-separator">
	<div id="main_list">
		<center>
	<?php
		$i=0;
		foreach($posts as $entry){
			echo "<div id='post".$i."' class='wrdLatest'>
					<table> <td> <tr>";
			//echo $entry->uid."</BR>";
			if($entry->img_path != "images/upload/")
				echo "<img src='/".$entry->img_path."' width='300'/></BR>";
			
			echo $entry->content."</BR>";
			echo $entry->modified_date."</BR>";
			echo "</tr> </td> </table> </div>";
			$i++;

			echo "<hr class='bs-docs-separator'>";
		}
		$page = ceil($i/10);
	?>

		<div id="more_loading"></div>

		</center>
	</div>
	<!-- </div> -->

	<!-- <a href="/welcome/morelisting/<?php //echo $page+1; ?>#post<?php //echo $i-9;?>"><input type="button" name="more" value="더보기"/></a> -->




	<div id="lastPostsLoader">


		<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
		</script>
	