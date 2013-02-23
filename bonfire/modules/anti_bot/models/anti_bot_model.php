<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Anti_bot_model extends BF_Model {

	protected $table		= "anti_bot";
	protected $key			= "id";
	protected $soft_deletes	= false;
	protected $date_format	= "datetime";
	protected $set_created	= false;
	protected $set_modified = false;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/*
	 	Method: find()
	
		Finds a Bot in the Database
		
		Parameters:
		$IP	- An INT with the Bot's ID.
		
		Returns:
		An object with the Bot information.
	*/
	public function find($id=null)
	{
		if (empty($this->selects))
		{
			$this->select($this->table .'.*');
		}
		return parent::find($id);
	}
	
	
	/*
		Method: insert()

		Creates a new blocked bot in the database.

		Required parameters sent in the $botData array:
			- IP
			- userAgent

		Parameters:
			$botData	- An array of Bot information.

		Returns:
			$id	- The ID of the new blocked Bot.
	*/
	public function insert($botData){
		if (!isset($botData['IP']) || empty($botData['IP']))
		{
			$this->error = 'No IP present.';
			return false;
		}

		if (!isset($botData['userAgent']) || empty($botData['userAgent']))
		{
			$this->error = 'No UserAgent given.';
			return false;
		}
		
		$id = parent::insert($botData);
		return $id;
	}
}
