<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_posts extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'post_id' => array(
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
			'deleted' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => '0',
			),
			'created_on' => array(
				'type' => 'datetime',
				'default' => '0000-00-00 00:00:00',
			),
			'modified_on' => array(
				'type' => 'datetime',
				'default' => '0000-00-00 00:00:00',
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('post_id', true);
		$this->dbforge->create_table('posts');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('posts');

	}

	//--------------------------------------------------------------------

}