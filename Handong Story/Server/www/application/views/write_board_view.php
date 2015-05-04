<!-- <link rel="stylesheet" href="themes/Bootstrap.css"> -->


<?php echo $error;?>

	<!-- <div data-role="content" data-theme="a"> -->
		<?php echo form_open_multipart('/board/doupload', 'data-ajax="false"') ;?>
		<!-- <form name="write_form" action="/welcome/do_upload" method="POST" enctype="multipart/form-data" data-ajax="false"> -->
		
		
		 	
				<input type="hidden" name="id" value='admin'/>
			
			
				<label for="userfile">Title</label>
				<input type="text" name="title"/>
			
			
			<!-- <div data-role="fieldcontain">																// 게시판에만 쓰임 /타임라인은 NONO/
				<label for="title">Title</label>
				<input type="text" name="title" id="title" value=""/>
			</div> -->

			
				<!-- <label for="textarea">내용</label> -->
				<!-- <textarea cols="20" rows="20" name="content" id="content"></textarea> -->
				<textarea rows="20" cols="20" name="content" id="content"></textarea>
			

			<!-- <div data-role="fieldcontain"> -->
			  	<label for="userfile">Photoes</label>
				<input type="file" name="userfile" accept="jpg|png|jpeg|JPG|PNG|JPEG"/>
		 		<input type="hidden" name="MAX_FILE_SIZE" value="10000" />
			<!-- </div> -->

			
				<!-- <button type="submit" data-theme="b">Write</button> -->
				<input type="submit" value="Write"/>				
			

			<!-- <div class="ui-body ui-body-b">
				<fieldset class="ui-grid-a">
					<div class="ui-block-a"><button type="submit" data-theme="d">Cancel</button></div>
					<div class="ui-block-b"><button type="submit" data-theme="a">Submit</button></div>
				</fieldset>
			 </div>-->

		</form>
	<!-- </div> -->