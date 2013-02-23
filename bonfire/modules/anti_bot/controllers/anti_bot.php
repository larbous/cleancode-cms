<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class anti_bot extends Front_Controller {

	//--------------------------------------------------------------------
	private $user_agent;
	private $ip;
	private $is_good;

	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('anti_bot_model', null, true);
		$this->lang->load('anti_bot');
		
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

		$records = $this->anti_bot_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------


	public function getAntiBotLink()
	{
		return "<a href='anti_bot/process' rel=nofollow style='display:none;'>_</a>";
		
	}
	
	public function process() {
		
		if(!$this->anti_bot_model){
			$this->load->model('anti_bot_model', null, true);
		} 
		
		$this->user_agent = $_SERVER['HTTP_USER_AGENT'];
		$this->is_good = preg_match("/(googlebot|slurp|msnbot|teoma|yandex|adsbot-google|altavista)/i", $this->user_agent);
		$this->ip = ip2long($_SERVER['REMOTE_ADDR']);
		
		if($this->is_blocked()) {
			exit('ACCESS DENIED');
		}else if(!$this->is_good){
			$this->blocked();
			exit('ACCESS DENIED');
		}
	}
	
	private function is_blocked() {
		$exist = 0;
		$result = $this->anti_bot_model->find($this->ip);
		($result) ? $exist = 1 : $exist = 0;
		return (bool)$exist;
	}

	private function blocked() {
		$result = $this->anti_bot_model->insert($this->ip);
	}
	
}