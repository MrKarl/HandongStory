<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index(){
		// $this->load->model('user_model');

		// return $this->user_model->register();
		echo "[ERROR DETECTED]<BR>YOUR PERMISSION IS DENYED.<BR>PLEASE GET THE PERMISSION.";
	}

	public function login(){

		$id = $this->input->post("id");
        $pw = $this->input->post("pw");


        if($id != null && $pw != null){
	        $params = array(
				"id"=>$id,
				"pw"=>$pw);
			$this->load->model('user_model');
			$ret = $this->user_model->isvalidateUser($params);		//return true / false

			if($ret==false){
				$ret = "0";
			}else{
				$ret = "1";
			}
			echo $ret;
		}else{
			echo 0;
		}

	}

	public function register(){


		$name = $this->input->post("name");
        $id = $this->input->post("id");
        $pw = $this->input->post("pw");
        $phone = $this->input->post("phone");
		$email = $this->input->post("email");
		$prof = $this->input->post("prof");
		$major = $this->input->post("major");
		$position = $this->input->post("position");
		
		//echo $name.$id.$pw.$phone.$email.$prof.$major.$position;
		if($name != null && $id != null && $pw != null && $phone != null && $email != null && $prof != null && 
			$major != null && $position != null){

			$params = array(
				"name"=>$name,
				"id"=>$id,
				"pw"=>$pw,
				"phone"=>$phone,
				"email"=>$email,
				"prof"=>$prof,
				"major"=>$major,
				"position"=>$position);

			$this->load->model('user_model');

			$ret = $this->user_model->register($params);

			if($ret==false){
				$ret = "0";
			}else{
				$ret = "1";
			}
			echo $ret;
		}else{
			echo "0";
		}

	
		//$json = array('status' => false );
		//$this->response($json, 200);
        // $json = array('status' => false );
        // if($this->input->post()==null){
       // $this->response($json, 200);
        // }

		//$response = array('you are good'=>"kk");
		//header('Content-type: application/json');
       // echo json_encode($response);
	}
 	

 	public function setprofyear(){

		$id = $this->input->post("id");
        $year = $this->input->post("year");
		$prof = $this->input->post("prof");


        $params = array(
			"id"=>$id,
			"year"=>$year,
			"prof"=>$prof);

		$this->load->model('profyear_model');
		$ret = $this->profyear_model->setprofyear($params);		//return true / false

		if($ret==false){
			$ret = "0";
		}else{
			$ret = "1";
		}
		echo $ret;
	}


	public function getprofyear(){

		$id = $this->input->post("id");
        
        $params = array(
			"id"=>$id);

		$this->load->model('profyear_model');
		$ret = $this->profyear_model->getprofyear($params);		//return true / false

		echo $ret;
	}

	public function deleteprofyear(){

		$id = $this->input->post("id");
        $year = $this->input->post("year");
		$prof = $this->input->post("prof");


        $params = array(
			"id"=>$id,
			"year"=>$year,
			"prof"=>$prof);

		$this->load->model('profyear_model');
		$ret = $this->profyear_model->deleteprofyear($params);		//return true / false

		if($ret==false){
			$ret = "0";
		}else{
			$ret = "1";
		}
		echo $ret;
	}
}

?>