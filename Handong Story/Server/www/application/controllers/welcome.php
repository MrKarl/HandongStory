<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index($page=1)
	{		
		$this->load->view('header_view');
		$this->load->view('write_view',array('error' => ' ' ));
		$this->listing($page);

		$this->load->view('footer_view');
	}

	function timeline(){
		$this->load->view('write_view',array('error' => ' ' ));
		$this->listing(1);
		$this->load->view('footer_view');	
	}

	function morelisting($more){
		

		$scale = 10;

		$last = $scale * $more;
		$this->load->model('post_model');
		$posts = $this->post_model->getTenPosts(0, $last);
		

		$this->load->view('header_view');
		$this->load->view('write_view',array('error' => ' ' ));
		
		$this->load->view('timeline_view',array('posts'=>$posts));

		$this->load->view('footer_view');
	}

	function listing($page)
	{
		$scale = 10;

		$last = $scale * $page;
		$this->load->model('post_model');
		$posts = $this->post_model->getTenPosts(0, $last);

		$this->load->view('timeline_view',array('posts'=>$posts));
		
		
	}

	function writeform()
	{
		//사용자의 권한 확인해야함, 그리고나서 View로 사용자 정보(id)보내주어야합니다~

		$this->load->view('write_view',array('error' => ' ' ));
	}

	function do_upload()
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
		

		$this->load->model('post_model');
		$posts = $this->post_model->write($img_path);

		$this->index(1);
	}

	public function writing()
	{
		$this->load->model('post_model');
		$posts = $this->post_model->write();
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */