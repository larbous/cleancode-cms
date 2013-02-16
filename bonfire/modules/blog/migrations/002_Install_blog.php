<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_blog extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'blog_title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'blog_slug' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'blog_body' => array(
				'type' => 'TEXT',
				
			),
			'blog_created_on' => array(
				'type' => 'DATETIME',
				'default' => '0000-00-00 00:00:00',
				
			),
			'blog_modified_on' => array(
				'type' => 'DATETIME',
				'default' => '0000-00-00 00:00:00',
				
			),
			'blog_deleted' => array(
				'type' => 'TINYINT',
				'constraint' => 0,
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('blog');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('blog');

	}

	//--------------------------------------------------------------------

}