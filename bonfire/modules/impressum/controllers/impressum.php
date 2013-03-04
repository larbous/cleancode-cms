<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class impressum extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('impressum_model', null, true);
		$this->lang->load('impressum');
		
			Assets::add_js(Template::theme_url('js/editors/tiny_mce/tiny_mce.js'));
			Assets::add_js(Template::theme_url('js/editors/tiny_mce/tiny_mce_init.js'));
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{

		$records = $this->impressum_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------




}