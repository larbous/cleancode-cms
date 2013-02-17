<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends Front_controller {
               
	function __construct()
	{
 		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('messages_model');
		$this->lang->load('messages');
	}
	
	/** 
	 * function index
	 *
	 * list form data
	 */
	function index()
	{
		Template::set('records', $this->messages_model->find_all_inbox_with_username());
		Template::set('inbox', 1);
		Template::set_view('messages');
		Template::render();
	}
	
	function outbox()
	{
		Template::set('records', $this->messages_model->find_all_outbox_with_username());
		Template::set_view('messages');
		Template::render();
	}
	
	function read($id)
	{
		$record = $this->messages_model->find_with_username($id);
		// REMOVE WHEN UPGRADING TO THREADED
		$record = $record['0'];
		
		if($record->deleted == null){
			if($record->id== $this->session->userdata('user_id') || $record->pm_receiver_uid == $this->session->userdata('user_id')){
				Template::set('record', $record);
				Template::set_view('read_message');
				Template::render();
			}else{
				Template::set_message(lang('no_access'), 'error');
				redirect('messages');
			}
		}else{
			Template::set_message(lang('doesnt_exist'), 'error');
			redirect('messages');
		}
	}
	
	public function send($id, $mid = 0) 
	{
		if($id == $this->session->userdata('user_id')){
			Template::set_message(lang('no_self'), 'error');
			redirect('messages');
		}
		
		if ($this->input->post('submit'))
		{
			if ($this->save_messages($id, $mid))
			{
				Template::set_message(lang("messages_create_success"), 'success');
				Template::redirect(site_url('users/profile/'.$id));
			}
			else 
			{
				Template::set_message(lang("messages_create_failure") . $this->messages_model->error, 'error');
			}
		}
	
		if($mid != 0) Template::set('message', $this->messages_model->find($mid));
		Template::set('toolbar_title', lang("messages_create_new_button"));
		Template::set_view('messages/create');
		Template::render();
	}
	
	public function delete($id=null)
	{
		if ($this->input->post('delete_checked'))
		{
			$ids = $this->input->post('checked');
					
			if(is_array($ids))
			{
				foreach($ids AS $id){
					if(!$this->messages_model->delete($id)) return false;
				}
			}
		}else{
			if(!$this->messages_model->delete($id)) return false;
		}
		
		Template::set_message(lang('messages_delete_success'), 'success');
		redirect(SITE_URL('messages'));
	}
		
	public function save_messages($id, $mid = 0) 
	{	
			
		$this->form_validation->set_rules('pm_title','Title','required|trim|xss_clean');			
		$this->form_validation->set_rules('pm_message','Message','required|trim|xss_clean');
		if ($this->form_validation->run() === false)
		{
			return false;
		}
		
		$data = array(
			'pm_title' 			=> $this->input->post('pm_title'),
			'pm_message' 		=> $this->input->post('pm_message'),
			'pm_receiver_uid'	=> $id,
			'pm_sender_uid'		=> $this->session->userdata('user_id'),
			'pm_reply_on'		=> $mid
		);
		
		$id = $this->messages_model->insert($data);
		
		if (is_numeric($id)) $return = true;
		else $return = false;
	
		
		return $return;
	}

}
