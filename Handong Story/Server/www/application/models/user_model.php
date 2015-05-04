<?php

class User_Model extends CI_Model{
	public $table_name = "table_user";
	
	function __construct(){
		parent::__construct();
	}
	function gets(){
		return $this->db->query("SELECT * FROM {$this->table_name}")->result_array();
	}


	function isvalidateUser($params){
		$id = $params["id"];
        $pw = $params["pw"];

												//$pw = crypt(md5($pw));

		$sql = "SELECT * FROM {$this->table_name} WHERE id = ? AND password = ?";
		$isvalidateUser = $this->db->query($sql, array($id, $pw));

		if($isvalidateUser->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}


	function register($params){

		$name = $params["name"];
       	$id = $params["id"];
        $pw = $params["pw"];
												//$pw = crypt(md5($pw));

        $phone = $params["phone"];
		$email = $params["email"];
		$prof = $params["prof"];
		$major = $params["major"];
		$position = $params["position"];
		
		$created_date = date("Y-m-d H:i:s");


		if($this->isvalidateID($id) == false){
		 	// 이미 존재하는 아이디입니다.
		 	return false;
		}

		// if(isvalidatePW($pw))){
		// 	// 비밀번호가 8글자 미만입니다.
		// 	return false;
		// 	exit;
		// }


		$sql = "INSERT INTO {$this->table_name} (id, password, name, position, major, professor, email, cellphone, created_date)
				  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$ret = $this->db->query($sql, array($id, $pw, $name, $position, $major, $prof, $email, $phone, $created_date));
		
		return $ret;

	}



	function isvalidateID($id){
		
		$sql = "SELECT id FROM {$this->table_name} WHERE id = ?";
		$isok = $this->db->query($sql, array($id));
		
		if($isok->num_rows() > 0){
			return false;			// 이미 있는 유저
		}else{
			return true;
		}
	}

	function isvalidatePW($password){
		$isok = strlen($password);
		
		if(count($isok)>8){
			return false;
		}else{
			return true;
		}

	}

}