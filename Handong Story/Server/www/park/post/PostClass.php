<?php
	class PostClass{
		
		public $PID;
		
		
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
			$this->table_name = PostClass::getTableName();
		}
		
		public function __destruct(){			
		}
		
		public function getTableName(){
			return "dev_table_post";
		}
		
		public function getPostWithRow($row){
			$post = new PostClass();
            foreach ($row as $key => $value) {
                $post->$key = $value;
            }
            return $post;
		}
		
		public function init($param){
			$this->Title = array_key_exists('Title', $param) ? $param['Title'] : "";
			$this->Writer = array_key_exists('Writer', $param) ? $param['Writer'] : "";
			$this->Content = array_key_exists('Content', $param) ? $param['Content'] : "";
			$this->Category = array_key_exists('Category', $param) ? $param['Category'] : "";
			
			$this->Good = array_key_exists('Good', $param) ? $param['Good'] : 0;
			$this->Hate = array_key_exists('Hate', $param) ? $param['Hate'] : 0;
			
			$this->Created = array_key_exists('Created', $param) ? $param['Created'] : date("Y-m-d H:i:s");
			
		
		}
		
		public function insert(){
						
			$db_host = "localhost";
			$db_user = "root";
			$db_passwd = "hdsoftware2013";
			$db_name = "db_test_park";
			
			$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
			
						
			if(mysqli_connect_errno()){
				echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
			}
			
			 $query = "INSERT INTO $this->table_name (Title, Writer, Content, Category, Good, Hate, Created_Date)
							VALUES ('{$this->Title}', '{$this->Writer}', '{$this->Content}', '{$this->Category}', {$this->Good}, {$this->Hate}, '{$this->Created}') ";
			
			
			$result = mysqli_query($conn, $query);
			
			mysqli_close($conn);
			
			return $result;
		}
		
		public function update($PID){					// 미완성
			$db_host = "localhost";
			$db_user = "root";
			$db_passwd = "hdsoftware2013";
			$db_name = "db_test_park";
			
			$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
			
						
			if(mysqli_connect_errno()){
				echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
			}
			
			 $query = "UPDATE $this->table_name 
							SET Title='{$this->Title}',	Writer='{$this->Writer}', Content='{$this->Content}',
							Category='{$this->Category}', Good={$this->Good}, Hate={$this->Hate}, Created_Date='{$this->Created}'
							WHERE PID=$PID";
			
			$result = mysqli_query($conn, $query);
			
			mysqli_close($conn);
			
			return $result;
		}
		
		public function delete($PID) {
            $db_host = "localhost";
			$db_user = "root";
			$db_passwd = "hdsoftware2013";
			$db_name = "db_test_park";
			
			$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
			
						
			if(mysqli_connect_errno()){
				echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
			}
			
			$query = "DELETE FROM $this->table_name
                           WHERE PID=$PID";
			
			$result = mysqli_query($conn, $query);
			
			mysqli_close($conn);
			
			return $result;
        }
		
		
		public function getPostClass($PID){
		
			$post = new PostClass();
		
			$db_host = "localhost";
			$db_user = "root";
			$db_passwd = "hdsoftware2013";
			$db_name = "db_test_park";
			
			$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
			
			if(mysqli_connect_errno()){
			echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
			}
			
			$query = "SELECT *
						   FROM $this->table_name 
						   WHERE PID = $PID ";
			
			$result = mysqli_query($conn, $query);
			
			while($row = mysqli_fetch_array($result)){
				$post->PID = $row['PID'];
				
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
			
			//$table_name = 'dev_table_post';
			$db_host = "localhost";
			$db_user = "root";
			$db_passwd = "hdsoftware2013";
			$db_name = "db_test_park";
			
			$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
			
			if(mysqli_connect_errno()){
				echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
			}
			
			// $query = "SELECT *
						   // FROM $this->table_name";
			// echo "1".$query."<BR>";
			
			$query = "SELECT *
						   FROM {$this->table_name}";
			
			$result = mysqli_query($conn, $query);
			
			$total = mysqli_num_rows($result);
			// //$row_cnt = mysqli_num_rows($result);

			// //printf("Result set has %d rows.\n", $row_cnt);

			// /* close result set */
			// //mysqli_free_result($result);
						
			// /*echo $data['total'];
			// */
			// $total = 0;
			// while($row = mysqli_fetch_array($result)){
				// $total = $row['COUNT(PID)'];
			// }
			mysqli_close($conn);
			
			//return"2";
			return $total;
		}
				
		public function getPostsToArray($start_record, $record_scale){
		
			$db_host = "localhost";
			$db_user = "root";
			$db_passwd = "hdsoftware2013";
			$db_name = "db_test_park";
			
			$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
			
			if(mysqli_connect_errno()){
			echo "MySQL 접속이 실패하였습니다. : ".mysqli_connect_error()."<BR>";
			}
			
			$query = "SELECT * FROM $this->table_name ORDER BY PID DESC LIMIT $start_record, $record_scale";
			
			$result = mysqli_query($conn, $query);
			
			$array = array();
			while($row = mysqli_fetch_array($result)){
				$array[] = PostClass::getPostWithRow($row);				
			}
			mysqli_close($conn);
						
			return $array;		
		}
		
		public function findByWriter(){
		}
		
		public function findByTitle(){
		}

	}
?>