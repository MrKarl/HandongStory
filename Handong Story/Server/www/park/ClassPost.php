<?php
	class PostClass{
		
		public $Title;
		public $Writer;
		public $Content;
		public $Category;
		
		public $Good;
		public $Hate;
		
		public $Modified;
		public $Created;
		
		public $table_name;
		
		
		
		public function __construct(){
			$table_name = Post::getTableName();
		}
		
		public function __destruct(){			
		}
		
		public function getTableName(){
			return "dev_table_post";
		}
		
		public function init($param){
			$this->Title = array_key_exists('Title', $param) ? $param['Title'] : "";
			$this->Writer = array_key_exists('Writer', $param) ? $param['Writer'] : "";
			$this->Content = array_key_exists('Content', $param) ? $param['Content'] : "";
			$this->Category = array_key_exists('Category', $param) ? $param['Category'] : "";
			
			$this->Good = array_key_exists('Good', $param) ? $param['Good'] : 0;
			$this->Hate = array_key_exists('Hate', $param) ? $param['Hate'] : 0;
			
			$this->Created = array_key_exists('Created', $param) ? $param['Created'] : date("Y,m,d H:i:s");
			
		
		}
		
		public function insert(){
			$db_host = "localhost";
			$db_user = "root";
			$db_passwd = "hdcapstone2013";
			$db_name = "db_test_park";
			
			$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
			
			if(mysqli_connect_errno()){
			echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
			}
			
			$query = "INSERT INTO {$table_name} (Title, Writer, Content, Category, Good, Hate, Created_Date)
																		VALUES ('$Title', '$Writer', '$Content', '$Category', '$Good', '$Hate', '$Created') ";
			
			$result = mysqli_query($conn, $query);
			
			mysqli_close($conn);
		}
		
		public function update(){
		}
		
		public function getPostClass($PID){
			$post = new PostClass();
		
			$db_host = "localhost";
			$db_user = "root";
			$db_passwd = "hdcapstone2013";
			$db_name = "db_test_park";
			
			$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
			
			if(mysqli_connect_errno()){
			echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
			}
			
			$query = "SELECT *
						   FROM {$table_name} 
						   WHERE PID = {$PID} ";
			
			$result = mysqli_query($conn, $query);
			
			while($row = mysqli_fetcharray($result)){
				$post->Title = $row['Title'];
				$post->Writer = $row['Writer'];
				$post->Content = $row['Content'];
				$post->Category = $row['Category'];
				$post->Good = $row['Good'];
				$post->Hate = $row['Hate'];
				$post->Created = $row['Created_Date'];
				$post->Modified_Date = $row['Modified_Date'];				
			}
			mysqli_close($conn);
			
			return $post;		
		}
		
		public function getPostCount(){
		
			$db_host = "localhost";
			$db_user = "root";
			$db_passwd = "hdcapstone2013";
			$db_name = "db_test_park";
			
			$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
			
			if(mysqli_connect_errno()){
			echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
			}
			
			$query = "SELECT COUNT(PID)
						   FROM {$table_name}";
			
			$result = mysqli_query($conn, $query);
			
			while($row = mysqli_fetcharray($result)){
				$total = $row['COUNT(PID)'];
			}
			mysqli_close($conn);
			
			return $total;
		}
		
		public function findByWriter(){
		}
		
		public function findByTitle(){
		}

	}
?>