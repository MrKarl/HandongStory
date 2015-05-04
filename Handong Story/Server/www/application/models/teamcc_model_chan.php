<?php

class Teamcc_model_chan extends CI_Model{
	public $table_name = "table_teamcc";
	
	function __construct(){
		parent::__construct();
	}

	function getAllCC(){
		return $this->db->query("SELECT * FROM {$this->table_name}")->result();
	}

	function write($img_path){
		$title = $_POST['title'];

		$check = "SELECT uid FROM table_user WHERE id = ?";
		$data = $this->db->query($check,array($_POST['id']))->result();
		foreach($data as $entry){
			$uid = $entry->uid;
		}
		//$uid = $uid[0];
		//$uid = $_POST[''];
		
		$content = $_POST['content'];
		$hit = 0;
		$created_date = date("Y-m-d H:i:s");
		$modified_date = date("Y-m-d H:i:s");
		
		$comment_id = 0;
		$like_id = 0;
		//$img_path = $_POST['img_path'];


		// $sql = "INSERT INTO {$this->table_name} (title, uid, content, hit, created_date, modified_date, comment_id, like_id, img_path)
		// 		VALUES ($title, $uid, $content, $hit, $created_date, $modified_date, $comment_id, $like_id, $img_path)";

		$sql = "INSERT INTO {$this->table_name} (title, uid, content, hit, created_date, modified_date, comment_id, like_id, img_path)
				VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$ret = $this->db->query($sql, array($title, $uid, $content, $hit, $created_date, $modified_date, $comment_id, $like_id, $img_path));

		//return $ret;
	}
}