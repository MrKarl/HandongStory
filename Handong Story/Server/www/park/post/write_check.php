<?php
	require_once("./PostClass.php");
	date_default_timezone_set('Asia/Seoul');
	$param = array();
	$param['Title'] = array_key_exists('Title', $_REQUEST) ? $_REQUEST['Title'] : null;
	$param['Writer'] = array_key_exists('Writer', $_REQUEST) ? $_REQUEST['Writer'] : null;
	$param['Content'] = array_key_exists('Content', $_REQUEST) ? $_REQUEST['Content'] : null;
	$param['Category'] = array_key_exists('Category', $_REQUEST) ? $_REQUEST['Category'] : null;
	
	// $Good = array_key_exists('Good', $param) ? $param['Good'] : 0;
	// $Hate = array_key_exists('Hate', $param) ? $param['Hate'] : 0;
	
	//$param['Created'] = array_key_exists('Created', $_REQUEST) ? $_REQUEST['Created'] : date("Y-m-d H:i:s");

	
	if($param['Title'] != null && $param['Writer'] != null && $param['Content'] != null && $param['Category'] != null ){
		$post = new PostClass();
		$post->init($param);
		$post->insert();
	}else{
		echo "
		<form action='write_form.php' method='POST'>
			<input type='hidden' name='Title' value=".$param['Title']."/>
			<input type='hidden' name='Writer' value=".$param['Writer']."/>
			<input type='hidden' name='Content' value=".$param['Content']."/>
			<input type='hidden' name='Category' value=".$param['Category']."/>
		</form>";		
	}
	header("Location:../index.php");
	
?>