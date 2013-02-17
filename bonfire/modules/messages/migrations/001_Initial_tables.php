<?php

class Migration_Initial_tables extends Migration {
 
	public function up() 
	{
		$this->load->dbforge();
 
		$this->dbforge->add_field('`pm_id` int(11) NOT NULL AUTO_INCREMENT');
		$this->dbforge->add_field('`pm_title` VARCHAR(45) NOT NULL');
		$this->dbforge->add_field('`pm_message` TEXT NOT NULL');
		$this->dbforge->add_key('pm_id', true);
		
		$this->dbforge->create_table('messages');
		
	}
 
	//--------------------------------------------------------------------
 
	public function down() 
	{
		$this->load->dbforge();
 
		$this->dbforge->drop_table('messages');
	}
 
	//--------------------------------------------------------------------
 
}