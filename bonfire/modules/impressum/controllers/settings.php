<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Impressum.Settings.View');
		$this->load->model('impressum_model', null, true);
		$this->lang->load('impressum');
		
			Assets::add_js(Template::theme_url('js/editors/tiny_mce/tiny_mce.js'));
			Assets::add_js(Template::theme_url('js/editors/tiny_mce/tiny_mce_init.js'));
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
					$result = $this->impressum_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('impressum_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('impressum_delete_failure') . $this->impressum_model->error, 'error');
				}
			}
		}

		$records = $this->impressum_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Impressum');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a Impressum object.
	*/
	public function create()
	{
		$this->auth->restrict('Impressum.Settings.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_impressum())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('impressum_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'impressum');

				Template::set_message(lang('impressum_create_success'), 'success');
				Template::redirect(SITE_AREA .'/settings/impressum');
			}
			else
			{
				Template::set_message(lang('impressum_create_failure') . $this->impressum_model->error, 'error');
			}
		}
		Assets::add_module_js('impressum', 'impressum.js');

		Template::set('toolbar_title', lang('impressum_create') . ' Impressum');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of Impressum data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('impressum_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/impressum');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Impressum.Settings.Edit');

			if ($this->save_impressum('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('impressum_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'impressum');

				Template::set_message(lang('impressum_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('impressum_edit_failure') . $this->impressum_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Impressum.Settings.Delete');

			if ($this->impressum_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('impressum_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'impressum');

				Template::set_message(lang('impressum_delete_success'), 'success');

				redirect(SITE_AREA .'/settings/impressum');
			} else
			{
				Template::set_message(lang('impressum_delete_failure') . $this->impressum_model->error, 'error');
			}
		}
		Template::set('impressum', $this->impressum_model->find($id));
		Assets::add_module_js('impressum', 'impressum.js');

		Template::set('toolbar_title', lang('impressum_edit') . ' Impressum');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_impressum()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_impressum($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('impressum_impress_text','Impressum','required');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['impressum_impress_text']        = $this->input->post('impressum_impress_text');

		if ($type == 'insert')
		{
			$id = $this->impressum_model->insert($data);

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
			$return = $this->impressum_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}