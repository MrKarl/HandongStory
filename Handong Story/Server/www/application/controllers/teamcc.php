<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teamcc extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->model('teamcc_model');
		$teamcc = $this->teamcc_model->getmyccinfo();
		// var_dump($teamcc);
		$this->load->view('header_view');
		$this->showChart();
		// $this->load->view('teamcc_view', array('teamcc'=>$teamcc));
		$this->load->view('teamccsetpoint_view');
		$this->load->view('footer_view');
		
	}

	function setpoints()
	{		
		$this->load->model('teamcc_model');
		$this->teamcc_model->setmypoint();

	}

	function setteamcc()
	{		
		// $this->load->view('header_view');
		// $this->load->view('write_view',array('error' => ' ' ));
		// $this->listing($page);
		// $this->load->view('footer_view');
	}

	function showChart()
	{
		$this->load->model('teamcc_model');
		$teamcc = $this->teamcc_model->getallccinfo();
		$this->load->view('teamccchart_view',array('teamcc' => $teamcc));
	}

}