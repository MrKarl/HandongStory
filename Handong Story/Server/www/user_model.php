<?php

class User_Model extends CI_Model{
	public $table_name = "table_user";
	
	function __construct(){
		parent::__construct();
	}
	function gets(){
		return $this->db->query("SELECT * FROM {$this->table_name}")->result_array();
	}

	function isvalidateUser(){
		$id = $_POST['id'];
		$password = crypt(md5($_POST['password']));

		$sql = "SELECT * FROM {$this->table_name} WHERE id = ? AND password = ?";
		$isvalidateUser = $this->db->query($sql,array($id, $password))->result_array();

		if(count($isvalidateUser)>0){
			return true;
		}else{
			return false;
		}
	}


	function register(){
		$id = $_POST['id'];
		if(isvalidateID($id)){
			// 이미 존재하는 아이디입니다.
			return false;
			exit;
		}

		if(isvalidatePW($_POST['password'])){
			// 비밀번호가 8글자 미만입니다.
			return false;
			exit;
		}

		$password = crypt(md5($_POST['password']));					// 해쉬 펑션들 !
		$name = $_POST['name'];
		$position = $_POST['position'];
		$major = $_POST['major'];
		$professor = $_POST['professor'];
		$created_date = date("Y-M-D H:i:s");
		$modified_date = date("Y-M-D H:i:s");

		$this->db->query("INSERT INTO {$this->table_name} 
			(id, password, name, position, major, professor, created_date, modified_date)
			VALUES ('id_{$i}', 'password_{$i}', 'name__{$i}', 'position_{$i}', 'major_{$i}', 'professor_{$i}',
			'{$created_date}', '{$modified_date}')");

		return true;
	}



	function isvalidateID($id){
		$sql = "SELECT id FROM {$this->table_name} WHERE id = ?";
		$isok = $this->db->query($sql,array($id))->result_array();
		//$isok = $this->db->query("SELECT id FROM {$this->table_name} WHERE id={$id}")->result_array();
		if(count($isok)>0){
			return false;
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