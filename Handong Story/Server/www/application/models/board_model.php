<?php

class Board_Model extends CI_Model{
	public $table_name = "table_board";
	
	function __construct(){
		parent::__construct();
	}

	function getAllPosts(){
		return $this->db->query("SELECT * FROM {$this->table_name}")->result();
	}

	function getPost($pid){
		
		return $this->db->query("SELECT * FROM {$this->table_name} WHERE pid = {$pid}")->result();

	}

	function getTenPosts($first, $last){
		return $this->db->query("SELECT * FROM {$this->table_name} ORDER BY modified_date DESC LIMIT {$first}, {$last}")->result();
	}

	function write($img_path){
		$title = $_POST['title'];

		$check = "SELECT uid FROM table_user WHERE id = ?";
		$data = $this->db->query($check,array($_POST['id']))->result();
		foreach($data as $entry){
			$uid = $entry->uid;
		}
		
		$content = $_POST['content'];
		$hit = 0;
		$created_date = date("Y-m-d H:i:s");
		$modified_date = date("Y-m-d H:i:s");
		
		$comment_id = 0;
		$like_id = 0;
		
		$sql = "INSERT INTO {$this->table_name} (title, uid, content, hit, created_date, modified_date, comment_id, like_id, img_path)
				VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$ret = $this->db->query($sql, array($title, $uid, $content, $hit, $created_date, $modified_date, $comment_id, $like_id, $img_path));

		//return $ret;
	}
}