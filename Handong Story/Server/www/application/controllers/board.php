<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Board extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index($page=1)
	{		
		

		$scale = 10;

		$current = ($page-1) * $scale;
		$last = $scale * $page;
		$this->load->model('board_model');
		$posts = $this->board_model->getTenPosts($current, $last);

		$this->load->view('header_view');	
		$this->load->view('board_list_view',array('posts'=>$posts));

		$this->load->view('footer_view');
	}

	function writeform()
	{		
		$this->load->view('header_view');
		$this->load->view('write_board_view',array('error' => ' ' ));
		
		$this->load->view('footer_view');
	}

	function doupload()
	{		
		$config['upload_path'] = 'images/upload/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '10000';
		$config['max_width']  = '4000';
		$config['max_height']  = '3000';
		$this->load->library('upload', $config);		
		
		$error = array();
		if (!($this->upload->do_upload())){
			$error = array('error' => $this->upload->display_errors());
			var_dump($error);
			return;
		}
		
		$img = $this->upload->data();

		$img_path = $config['upload_path'].$img['file_name'];		
		

		$this->load->model('board_model');
		$posts = $this->board_model->write($img_path);

		$this->index(1);
	}

	function view($pid)
	{		
		$this->load->model('board_model');

		$param = $this->board_model->getPost($pid);

		$this->load->view('header_view');
		$this->load->view('board_view',array('param'=>$param));
		
		$this->load->view('footer_view');
	}

}

/* End of file board.php */
/* Location: ./application/controllers/board.php */