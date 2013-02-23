<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_anti_bot extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'anti_bot_IP' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
			'anti_bot_useragent' => array(
				'type' => 'VARCHAR',
				'constraint' => 200,
				
			),
			'anti_bot_date' => array(
				'type' => 'DATETIME',
				'default' => '0000-00-00 00:00:00',
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('anti_bot');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('anti_bot');

	}

	//--------------------------------------------------------------------

}