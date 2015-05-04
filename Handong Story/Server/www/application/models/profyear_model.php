<?php

class Profyear_Model extends CI_Model{
	public $table_name = "table_profyear";
	
	function __construct(){
		parent::__construct();
	}

	function setprofyear($params){
		$prof = $params['prof'];
		$year = $params['year']; 
		$id = $params['id'];

		$created_date = date("Y-m-d H:i:s");
		
		$sql = "INSERT INTO {$this->table_name} (id, professor, year, created_date)
				VALUES ( ?, ?, ?, ?)";

		$ret = $this->db->query($sql, array($id, $prof, $year, $created_date));

		return $ret;

	}
	function getprofyear($params){
		$id = $params['id'];

		$result = array();

		$sql = "SELECT * FROM {$this->table_name} WHERE id = ?";

		$ret = $this->db->query($sql, array($id))->result();

		$i = 0;
		foreach($ret as $entry){
			$result[$i]['year'] = $entry->year;
			$result[$i]['prof'] = $entry->professor;
			$result[$i]['id'] = $entry->id;
			$i++;
		}
		$result = json_encode($result);
		//error_log($result);
		return $result;
	}

	function deleteprofyear($params){
		$prof = $params['prof'];
		$year = $params['year']; 
		$id = $params['id'];
		
		$sql = "DELETE FROM {$this->table_name} WHERE id = ? AND professor = ? AND year = ?";
		$ret = $this->db->query($sql, array($id, $prof, $year));

		return $ret;
	}

}
