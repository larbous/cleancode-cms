<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('TeamspeakViever.Content.View');
		$this->load->model('teamspeakviever_model', null, true);
		$this->lang->load('teamspeakviever');
		
		Template::set_block('sub_nav', 'content/_sub_nav');
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
					$result = $this->teamspeakviever_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('teamspeakviever_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('teamspeakviever_delete_failure') . $this->teamspeakviever_model->error, 'error');
				}
			}
		}

		$records = $this->teamspeakviever_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage TeamspeakViever');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a TeamspeakViever object.
	*/
	public function create()
	{
		$this->auth->restrict('TeamspeakViever.Content.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_teamspeakviever())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('teamspeakviever_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'teamspeakviever');

				Template::set_message(lang('teamspeakviever_create_success'), 'success');
				Template::redirect(SITE_AREA .'/content/teamspeakviever');
			}
			else
			{
				Template::set_message(lang('teamspeakviever_create_failure') . $this->teamspeakviever_model->error, 'error');
			}
		}
		Assets::add_module_js('teamspeakviever', 'teamspeakviever.js');

		Template::set('toolbar_title', lang('teamspeakviever_create') . ' TeamspeakViever');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of TeamspeakViever data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('teamspeakviever_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/teamspeakviever');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('TeamspeakViever.Content.Edit');

			if ($this->save_teamspeakviever('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('teamspeakviever_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'teamspeakviever');

				Template::set_message(lang('teamspeakviever_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('teamspeakviever_edit_failure') . $this->teamspeakviever_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('TeamspeakViever.Content.Delete');

			if ($this->teamspeakviever_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('teamspeakviever_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'teamspeakviever');

				Template::set_message(lang('teamspeakviever_delete_success'), 'success');

				redirect(SITE_AREA .'/content/teamspeakviever');
			} else
			{
				Template::set_message(lang('teamspeakviever_delete_failure') . $this->teamspeakviever_model->error, 'error');
			}
		}
		Template::set('teamspeakviever', $this->teamspeakviever_model->find($id));
		Assets::add_module_js('teamspeakviever', 'teamspeakviever.js');

		Template::set('toolbar_title', lang('teamspeakviever_edit') . ' TeamspeakViever');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_teamspeakviever()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_teamspeakviever($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('teamspeakviever_tsip','TeamSpeak IP','required|valid_ip|max_length[18]');
		$this->form_validation->set_rules('teamspeakviever_servername','Servername','required|unique[bf_teamspeak.teamspeakviever_servername,bf_forum.id]|alpha_numeric|max_length[255]');
		$this->form_validation->set_rules('teamspeakviever_query_port','Query Port','required|max_length[6]');
		$this->form_validation->set_rules('teamspeakviever_srvpassword','Password','max_length[255]');
		$this->form_validation->set_rules('teamspeakviever_server_id','Server ID','required|is_numeric|max_length[3]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['teamspeakviever_tsip']        = $this->input->post('teamspeakviever_tsip');
		$data['teamspeakviever_servername']        = $this->input->post('teamspeakviever_servername');
		$data['teamspeakviever_query_port']        = $this->input->post('teamspeakviever_query_port');
		$data['teamspeakviever_srvpassword']        = $this->input->post('teamspeakviever_srvpassword');
		$data['teamspeakviever_server_id']        = $this->input->post('teamspeakviever_server_id');

		if ($type == 'insert')
		{
			$id = $this->teamspeakviever_model->insert($data);

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
			$return = $this->teamspeakviever_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}