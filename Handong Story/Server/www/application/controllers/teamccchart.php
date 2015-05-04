<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teamccchart extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index($page=1)
	{
		$this->load->view('header_view');
		$this->showChart();
		$this->load->view('footer_view');
	}

	function showChart()
	{
		$this->load->model('teamcc_model');
		$teamcc = $this->teamcc_model->getallccinfo();
		$this->load->view('teamccchart_view',array('teamcc' => $teamcc));
	}
}

/* End of file testingChan.php */
/* Location: ./application/controllers/welcome.php */