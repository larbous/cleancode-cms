<?php

class Migration_Table_Upgrade extends Migration {
 
	public function up() 
	{
		$this->load->dbforge();
 
		$fields = array('deleted' => array('type' => 'TINYINT(1)'), 'created_on' => array('type' => 'DATETIME'));
		$this->dbforge->add_column('messages', $fields);
		
	}
 
	//--------------------------------------------------------------------
 
	public function down() 
	{
		$this->load->dbforge();
 
		$this->dbforge->drop_column('messages', 'deleted');
		$this->dbforge->drop_column('messages', 'created_on');
	}
 
	//--------------------------------------------------------------------
 
}