<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Anti_Bot.Settings.View');
		$this->load->model('anti_bot_model', null, true);
		$this->lang->load('anti_bot');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
			Assets::add_css('jquery-ui-timepicker.css');
			Assets::add_js('jquery-ui-timepicker-addon.js');
		Template::set_block('sub_nav', 'settings/_sub_nav');
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->anti_bot_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('anti_bot_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('anti_bot_delete_failure') . $this->anti_bot_model->error, 'error');
				}
			}
		}

		$records = $this->anti_bot_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Anti-Bot');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a Anti-Bot object.
	*/
	public function create()
	{
		$this->auth->restrict('Anti_Bot.Settings.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_anti_bot())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('anti_bot_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'anti_bot');

				Template::set_message(lang('anti_bot_create_success'), 'success');
				Template::redirect(SITE_AREA .'/settings/anti_bot');
			}
			else
			{
				Template::set_message(lang('anti_bot_create_failure') . $this->anti_bot_model->error, 'error');
			}
		}
		Assets::add_module_js('anti_bot', 'anti_bot.js');

		Template::set('toolbar_title', lang('anti_bot_create') . ' Anti-Bot');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of Anti-Bot data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('anti_bot_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/anti_bot');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Anti_Bot.Settings.Edit');

			if ($this->save_anti_bot('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('anti_bot_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'anti_bot');

				Template::set_message(lang('anti_bot_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('anti_bot_edit_failure') . $this->anti_bot_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Anti_Bot.Settings.Delete');

			if ($this->anti_bot_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('anti_bot_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'anti_bot');

				Template::set_message(lang('anti_bot_delete_success'), 'success');

				redirect(SITE_AREA .'/settings/anti_bot');
			} else
			{
				Template::set_message(lang('anti_bot_delete_failure') . $this->anti_bot_model->error, 'error');
			}
		}
		Template::set('anti_bot', $this->anti_bot_model->find($id));
		Assets::add_module_js('anti_bot', 'anti_bot.js');

		Template::set('toolbar_title', lang('anti_bot_edit') . ' Anti-Bot');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_anti_bot()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_anti_bot($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('anti_bot_IP','IP','alpha_dash|max_length[11]');
		$this->form_validation->set_rules('anti_bot_useragent','UserAgent','max_length[200]');
		$this->form_validation->set_rules('anti_bot_date','date','');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['anti_bot_IP']        = $this->input->post('anti_bot_IP');
		$data['anti_bot_useragent']        = $this->input->post('anti_bot_useragent');
		$data['anti_bot_date']        = $this->input->post('anti_bot_date') ? $this->input->post('anti_bot_date') : '0000-00-00 00:00:00';

		if ($type == 'insert')
		{
			$id = $this->anti_bot_model->insert($data);

			if (is_numeric($id))
			{
				$return = $id;
			} else
			{
				$return = FALSE;
			}
		}
		else if ($type == 'update')
		{
			$return = $this->anti_bot_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}