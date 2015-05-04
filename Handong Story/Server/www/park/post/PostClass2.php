<?php
	require_once("../common/default.php");
	
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
		
		static public function getClassWithRow($row) {
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
			
			$this->Created = array_key_exists('Created', $param) ? $param['Created'] : date("Y,m,d H:i:s");
			
		
		}
		
		public function insert(){
			$pdo = $get_pdo();
			
			$stmt = $pdo->prepare("INSERT INTO $table_name (Title, Writer, Content, Category, Good, Hate, Created_Date)
								VALUES (:Title, :Writer, :Content, :Category, :Good, :Hate, :Created) ");
			$stmt->bindValue(':Title', $this->Title);
			$stmt->bindValue(':Writer', $this->Writer);
			$stmt->bindValue(':Content', $this->Content);
			$stmt->bindValue(':Category', $this->Category);
			$stmt->bindValue(':Good', $this->Good);
			$stmt->bindValue(':Hate', $this->Hate);
			$stmt->bindValue(':Created', $this->Created);			
			
			$result = $stmt->execute();
			
			return $result;
		}
		
		public function update(){
		}
		
		public function getPostClass($PID){
			$post = new PostClass();
		
			$pdo = $get_pdo();
			
			$stmt = $pdo->prepare("SELECT * FROM $table_name 
												WHERE PID = :PID");
			$stmt->execute();
			
			
			
			//$result = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$post = PostClass::getClassWithRow($row)
			}
					
			/*while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[] = PostClass::getClassWithRow($row);
            }
			return $result;
			*/
			
			return $post;
		}
		
		public function getPostCount(){
			
			$pdo = $get_pdo();
			$stmt = $pdo->prepare("SELECT COUNT(PID)
												FROM $table_name");
			$result = $stmt->execute();		
			
			return $result;
		}
		
		public function findByWriter(){
		}
		
		public function findByTitle(){
		}

	}
?>