<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages_model extends MY_Model {

	protected $table		= 'messages';
	protected $key			= 'pm_id';
	protected $soft_deletes	= true;
	protected $date_format	= 'datetime';
	protected $set_modified = false;
	protected $set_created	= true;

	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	function find_all_inbox_with_username()
	{
		$this->db->select('
			messages.pm_id, 
			messages.pm_title,
			messages.created_on,
			users.username,
			users.id
		');
		$this->db->from('messages');
		$this->db->join('users', 'messages.pm_sender_uid = users.id', 'left');
		$this->db->where('messages.pm_receiver_uid', $this->session->userdata('user_id'));
		$this->db->where('messages.deleted', null);
		//$this->db->where('messages.pm_reply_on', 0);
		

		return $this->db->get()->result();
	}
	
	function find_all_outbox_with_username()
	{
		$this->db->select('
			messages.pm_id, 
			messages.pm_title,
			messages.created_on,
			users.username,
			users.id
		');
		$this->db->from('messages');
		$this->db->join('users', 'messages.pm_receiver_uid = users.id', 'left');
		$this->db->where('messages.pm_sender_uid', $this->session->userdata('user_id'));
		$this->db->where('messages.deleted', null);

		return $this->db->get()->result();
	}
	
	function find_with_username($id)
	{
		$this->db->select('
			messages.pm_id, 
			messages.pm_title,
			messages.pm_message,
			messages.pm_receiver_uid,
			messages.created_on,
			messages.deleted,
			users.username,
			users.id
		');
		$this->db->from('messages');
		$this->db->join('users', 'messages.pm_sender_uid = users.id', 'left');
		$this->db->where('messages.pm_id', $id);
		$this->db->or_where('messages.pm_reply_on', $id);
		$this->db->where('messages.deleted', null);

		return $this->db->get()->result();
	}
}
