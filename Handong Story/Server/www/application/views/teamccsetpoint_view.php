<?php echo form_open_multipart('/teamcc/setpoints') ;?>
	
	<input type="hidden" name="id" value="admin">


	<div>
		<select name="activity">
		<option value="">활동입력</option>
	    <option value="같이밥먹기">같이밥먹기</option>
	    <option value="청강">청강</option>
	    <option value="영화">영화</option>
	    <option value="자장가">자장가</option>
		</select>
	</div>

	<div>
		<button type="submit" name="setpoint">입력</button>
	</div>
	
</form>