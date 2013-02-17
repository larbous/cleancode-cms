<?php

class Migration_Table_Upgrade extends Migration {
 
	public function up() 
	{
		$this->load->dbforge();
 
		$fields = array('pm_sender_uid' => array('type' => 'INT'), 'pm_receiver_uid' => array('type' => 'INT'));
		$this->dbforge->add_column('messages', $fields);
		
	}
 
	//--------------------------------------------------------------------
 
	public function down() 
	{
		$this->load->dbforge();
 
		$this->dbforge->drop_column('messages', 'pm_sender_uid');
		$this->dbforge->drop_column('messages', 'pm_receiver_uid');
	}
 
	//--------------------------------------------------------------------
 
}