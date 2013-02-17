<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_analytics_code extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;
		$this->db->query("INSERT INTO {$prefix}settings (`name`, `module`, `value`) VALUES ('ga.code', 'analytics', '');");
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;
		$this->db->query("DELETE FROM {$prefix}settings WHERE name='ga.code';");
	}

	//--------------------------------------------------------------------

}
