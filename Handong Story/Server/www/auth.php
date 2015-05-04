<?php
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Register extends CI_Controller {

	public function index(){

		// $this->load->model('user_model');

		// return $this->user_model->register();
		echo "[ERROR DETECTED]<BR>YOUR PERMISSION IS DENYED.<BR>PLEASE GET THE PERMISSION.";
	}

	public function login(){
		$this->load->model('user_model');
		return $this->user_model->isvalidateUser();
	}

	public function register(){

		$this->load->model('user_model');

		return $this->user_model->register();		
	}



}

?>
