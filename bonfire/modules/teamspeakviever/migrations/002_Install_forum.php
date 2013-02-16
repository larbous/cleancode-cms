<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_forum extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'teamspeakviever_tsip' => array(
				'type' => 'VARCHAR',
				'constraint' => 18,
				
			),
			'teamspeakviever_servername' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'teamspeakviever_query_port' => array(
				'type' => 'INT',
				'constraint' => 6,
				
			),
			'teamspeakviever_srvpassword' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'teamspeakviever_server_id' => array(
				'type' => 'INT',
				'constraint' => 3,
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('forum');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('forum');

	}

	//--------------------------------------------------------------------

}