<?php

class Teamcc_Model extends CI_Model{
	public $table_name = "table_teamcc";
	
	function __construct(){
		parent::__construct();
	}

	function register(){						// TEAM CC 세팅하는 함수.
		$uid1 = $_POST['uid1'];
		$uid2 = $_POST['uid2'];
		$point = 0;
		$created_date = date("Y-m-d H:i:s");
		$modified_date = date("Y-m-d H:i:s");

		$sql = "INSERT INTO {$this->table_name} (uid1, uid2, created_date, modified_date, point)
				VALUES ( ?, ?, ?, ?, ?)";

		$ret = $this->db->query($sql, array($uid1, $uid2, $created_date, $modified_date, $point));


	}
	function setmypoint(){						// uid 와, 활동내역을 입력하면, db에 추가된다.
		$id = $_POST['id'];

		$sql1 = "SELECT uid FROM table_user WHERE id = ?";
		$ret = $this->db->query($sql1, array($id));

		$uid = $ret->uid;
		$sql1 = "SELECT * FROM {$this->table_name} WHERE uid1 = ?";
		$ret = $this->db->query($sql1, array($uid));
		
		$ccid = $ret->ccid;
		$activity = $_POST['activity'];
		$created_date = date("Y-m-d H:i:s");
		$modified_date = date("Y-m-d H:i:s");
		
		$sql = "INSERT INTO {$this->table_name} (uid1, uid2, created_date, modified_date, ccid, activity)
				VALUES ( ?, ?, ?, ?, ?)";

		$ret = $this->db->query($sql, array($uid1, $uid2, $created_date, $modified_date, $ccid, $activity));
	}

	function getmyccinfo(){
		//$uid = $_POST['uid1'];
		$uid = 1;

		$sql1 = "SELECT * FROM {$this->table_name} WHERE uid1 = ? OR uid2 = ?";
		$ret = $this->db->query($sql1, array($uid, $uid))->result();
		return $ret;
	}

	function getallccinfo(){	//이찬영이 11/25일 4:32분에 추가
		return $this->db->query("SELECT * FROM {$this->table_name}")->result();
	}

}