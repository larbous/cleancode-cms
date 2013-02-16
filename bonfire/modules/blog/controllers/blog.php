<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class blog extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('blog_model');
		$this->lang->load('blog');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
			Assets::add_css('jquery-ui-timepicker.css');
			Assets::add_js('jquery-ui-timepicker-addon.js');
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{
		//Template::set_block('blog', 'index', $this->blog_model->order_by('blog_created_on', 'asc')->limit(5)->find_all());
		Template::set('records', $this->blog_model->order_by('blog_created_on', 'asc')->limit(5)->find_all());
		Template::render();
	}

	//--------------------------------------------------------------------

	
	/**
	 * Index_partial for the Frontend the last 5 Blogentrys
	 */
	public function index_partial(){
		$data = array(
			'records' => $this->blog_model->order_by('blog_created_on', 'asc')->limit(5)->find_all()
		);
		return $this->load->view('index', $data, TRUE);
	}


}