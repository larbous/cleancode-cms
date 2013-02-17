<?php

class Migration_Threaded extends Migration {
 
	public function up() 
	{
		$this->load->dbforge();
 
		$fields = array('pm_reply_on' => array('type' => 'INT(11)'));
		$this->dbforge->add_column('messages', $fields);
		
	}
 
	//--------------------------------------------------------------------
 
	public function down() 
	{
		$this->load->dbforge();
 
		$this->dbforge->drop_column('messages', 'pm_reply_on');
	}
 
	//--------------------------------------------------------------------
 
}