<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Analytics extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	//--------------------------------------------------------------------

	/*
		Method: index()

		Does nothing.
	*/
	public function index()
	{

	}

	// ------------------------------------------------------------------------

	/*
		Method: show_gcode()

		Outputs the google analytics script code for the footer of a website.
	*/
	public function show_gcode()
	{
		if ( settings_item('ga.enabled') == 1 )
		{
			$data['gcode'] = settings_item('ga.code');
			return $this->load->view('analytics/index', $data, true);
		}

	}

}

/* End of file analytics.php */
/* Location: ./modules/analytics/controllers/analytics.php */