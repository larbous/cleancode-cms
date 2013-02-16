<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class teamspeakviever extends Front_Controller {
	
	// --------------------------------------------------------------------
	public function __construct() {
		parent::__construct ();
		
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'teamspeakviever_model', null, true );
		$this->lang->load ( 'teamspeakviever' );
	}
	
	// --------------------------------------------------------------------
	
	/*
	 * Method: index() Displays a list of form data.
	 */
	public function index() {
		$records = $this->teamspeakviever_model->find_all ();
		
		Template::set ( 'tsserver', $records );
		Template::render ();
	}
	
	// --------------------------------------------------------------------
	public function index_partial() {
		$records = $this->teamspeakviever_model->find_all ();
		$server = array();
		foreach($records as $record){
			$this->TSStatus($record->teamspeakviever_tsip,$record->teamspeakviever_query_port, $record->teamspeakviever_server_id);
			$srv = $this->render($record->teamspeakviever_tsip);
			var_dump($srv);
			if(!preg_match('/Socket error:/',$srv)){
				array_push($server,$srv);
			}else{
				array_push($server,"Socket error:");
			}
		}
		$data = array (
				'tsserver' => $server 
		);
		return $this->load->view('index_partial', $data, TRUE);
	}
	private function TSStatus($host, $queryPort, $serverId)
	{
		$this->_host = $host;
		$this->_qport = $queryPort;
		$this->_sid = $serverId;
	
		$this->_socket = null;
		$this->_updated = false;
		$this->_serverDatas = array();
		$this->_channelDatas = array();
		$this->_userDatas = array();
		$this->_serverGroupFlags = array();
		$this->_channelGroupFlags = array();
		$this->_login = false;
		$this->_password = false;
		$this->_cacheTime = 0;
		$this->_cacheFile = "/cache";
		$this->_limitedChannels = array();
	
		$this->imagePath = "./inc/resource/images/tsicons/";
		$this->decodeUTF8 = false;
		$this->showNicknameBox = false;
		$this->showPasswordBox = false;
		$this->timeout = 2;
	}
	private function unescape($str, $reverse = false) {
		$find = array (
				'\\\\',
				"\/",
				"\s",
				"\p",
				"\a",
				"\b",
				"\f",
				"\n",
				"\r",
				"\t",
				"\v" 
		);
		$rplc = array (
				chr ( 92 ),
				chr ( 47 ),
				chr ( 32 ),
				chr ( 124 ),
				chr ( 7 ),
				chr ( 8 ),
				chr ( 12 ),
				chr ( 10 ),
				chr ( 3 ),
				chr ( 9 ),
				chr ( 11 ) 
		);
		
		if (! $reverse)
			return str_replace ( $find, $rplc, $str );
		return str_replace ( $rplc, $find, $str );
	}
	private function parseLine($rawLine) {
		$datas = array ();
		$rawItems = explode ( "|", $rawLine );
		foreach ( $rawItems as $rawItem ) {
			$rawDatas = explode ( " ", $rawItem );
			$tempDatas = array ();
			foreach ( $rawDatas as $rawData ) {
				$ar = explode ( "=", $rawData, 2 );
				$tempDatas [$ar [0]] = isset ( $ar [1] ) ? $this->unescape ( $ar [1] ) : "";
			}
			$datas [] = $tempDatas;
		}
		return $datas;
	}
	private function sendCommand($cmd) {
		fputs ( $this->_socket, "$cmd\n" );
		$response = "";
		do {
			$response .= fread ( $this->_socket, 8096 );
		} while ( strpos ( $response, 'error id=' ) === false );
		if (strpos ( $response, "error id=0" ) === false) {
			throw new Exception ( "TS3 Server returned the following error: " . $this->unescape ( trim ( $response ) ) );
		}
		return $response;
	}
	private function queryServer($serverName) {
		if ($this->_qport == null) {
			$this->_qport = '10011';
			$this->timeout = 20;
			$this->_login = false;
			$this->_password = false;
			$this->_sid = 1;
		}
		$this->_socket = @fsockopen ( $serverName, $this->_qport, $errno, $errstr, $this->timeout );
		if ($this->_socket) {
			@socket_set_timeout ( $this->_socket, $this->timeout );
			$isTs3 = trim ( fgets ( $this->_socket ) ) == "TS3";
			if (! $isTs3)
				throw new Exception ( "Not a Teamspeak 3 server/bad query port" );
			
			if ($this->_login !== false) {
				$this->sendCommand ( "login client_login_name=" . $this->_login . " client_login_password=" . $this->_password );
			}
			
			$response = "";
			$response .= $this->sendCommand ( "use sid=" . $this->_sid );
			$response .= $this->sendCommand ( "serverinfo" );
			$response .= $this->sendCommand ( "channellist -topic -flags -voice -limits" );
			$response .= $this->sendCommand ( "clientlist -uid -away -voice -groups" );
			$response .= $this->sendCommand ( "servergrouplist" );
			$response .= $this->sendCommand ( "channelgrouplist" );
			
			$this->disconnect ();
			
			if ($this->decodeUTF8)
				$response = utf8_decode ( $response );
			
			return $response;
		} else
			throw new Exception ( "Socket error: $errstr [$errno]" );
	}
	private function disconnect() {
		@fputs ( $this->_socket, "quit\n" );
		@fclose ( $this->_socket );
	}
	private function sortUsers($a, $b) {
		return strcasecmp ( $a ["client_nickname"], $b ["client_nickname"] );
	}
	private function update($serverName) {
		$response = $this->queryServer ( $serverName );
		
		$lines = explode ( "error id=0 msg=ok\n\r", $response );
		if (count ( $lines ) == 7) {
			$this->_serverDatas = $this->parseLine ( $lines [1] );
			$this->_serverDatas = $this->_serverDatas [0];
			$this->_channelDatas = $this->parseLine ( $lines [2] );
			$this->_userDatas = $this->parseLine ( $lines [3] );
			usort ( $this->_userDatas, array (
					$this,
					"sortUsers" 
			) );
			
			$serverGroups = $this->parseLine ( $lines [4] );
			foreach ( $serverGroups as $sg )
				if ($sg ["iconid"] > 0)
					$this->setServerGroupFlag ( $sg ["sgid"], 'servergroup_' . $sg ["iconid"] . '.png' );
			
			$channelGroups = $this->parseLine ( $lines [5] );
			foreach ( $channelGroups as $cg )
				if ($cg ["iconid"] > 0)
					$this->setChannelGroupFlag ( $cg ["cgid"], 'changroup_' . $cg ["iconid"] . '.png' );
			
			$this->_updated = true;
		} else
			throw new Exception ( "Invalid server response" );
	}
	public function setLoginPassword($login, $password) {
		$this->_login = $login;
		$this->_password = $password;
	}
	public function setCache($cacheTime, $cacheFile = false) {
		$this->_cacheTime = $cacheTime;
		if ($cacheFile !== false)
			$this->_cacheFile = $cacheFile;
	}
	public function clearServerGroupFlags() {
		$this->_serverGroupFlags = array ();
	}
	public function setServerGroupFlag($serverGroupId, $image) {
		if (! isset ( $this->_serverGroupFlags [$serverGroupId] ))
			$this->_serverGroupFlags [$serverGroupId] = $image;
	}
	public function clearChannelGroupFlags() {
		$this->_channelGroupFlags = array ();
	}
	public function setChannelGroupFlag($channelGroupId, $image) {
		if (! isset ( $this->_channelGroupFlags [$channelGroupId] ))
			$this->_channelGroupFlags [$channelGroupId] = $image;
	}
	public function limitToChannels() {
		$ids = func_get_args ();
		foreach ( $ids as $id )
			$this->_limitedChannels [] = $id;
	}
	private function renderFlags($flags) {
		$out = "";
		foreach ( $flags as $flag )
			$out .= '<img src="/inc/resource/images/tsicons/' . $flag . '" />';
		return $out;
	}
	private function renderUsers($parentId) {
		$out = "";
		foreach ( $this->_userDatas as $user ) {
			if ($user ["client_type"] == 0 && $user ["cid"] == $parentId) {
				$icon = "16x16_player_off.png";
				if ($user ["client_away"] == 1)
					$icon = "16x16_away.png";
				else if ($user ["client_flag_talking"] == 1)
					$icon = "16x16_player_on.png";
				else if ($user ["client_output_hardware"] == 0)
					$icon = "16x16_hardware_output_muted.png";
				else if ($user ["client_output_muted"] == 1)
					$icon = "16x16_output_muted.png";
				else if ($user ["client_input_hardware"] == 0)
					$icon = "16x16_hardware_input_muted.png";
				else if ($user ["client_input_muted"] == 1)
					$icon = "16x16_input_muted.png";
				
				$flags = array ();
				
				if (isset ( $this->_channelGroupFlags [$user ["client_channel_group_id"]] ))
					$flags [] = $this->_channelGroupFlags [$user ["client_channel_group_id"]];
				
				$serverGroups = explode ( ",", $user ["client_servergroups"] );
				foreach ( $serverGroups as $serverGroup )
					if (isset ( $this->_serverGroupFlags [$serverGroup] ))
						$flags [] = $this->_serverGroupFlags [$serverGroup];
				
				$out .= '
				<div class="tsstatusItem">
					<div class="tsstatusLabel">
						<img src="/inc/resource/images/tsicons/' . $icon . '" />' . $this->checkUsername ( $user ["client_nickname"] ) . '
					</div>
					<div class="tsstatusFlags">
						' . $this->renderFlags ( $flags ) . '
					</div>
				</div>';
			}
		}
		return $out;
	}
	private function renderChannels($parentId, $show = false) {
		$out = "";
		foreach ( $this->_channelDatas as $channel ) {
			if ($channel ["pid"] == $parentId) {
				$icon = "16x16_channel_green.png";
				if ($channel ["channel_maxclients"] > - 1 && ($channel ["total_clients"] >= $channel ["channel_maxclients"]))
					$icon = "16x16_channel_red.png";
				else if ($channel ["channel_maxfamilyclients"] > - 1 && ($channel ["total_clients_family"] >= $channel ["channel_maxfamilyclients"]))
					$icon = "16x16_channel_red.png";
				else if ($channel ["channel_flag_password"] == 1)
					$icon = "16x16_channel_yellow.png";
				
				$flags = array ();
				if ($channel ["channel_flag_default"] == 1)
					$flags [] = '16x16_default.png';
				if ($channel ["channel_needed_talk_power"] > 0)
					$flags [] = '16x16_moderated.png';
				if ($channel ["channel_flag_password"] == 1)
					$flags [] = '16x16_register.png';
				
				$link = "javascript:tsstatusconnect('" . $this->_host . "','" . $this->_serverDatas ["virtualserver_port"] . "','" . htmlentities ( $channel ["channel_name"] ) . "')";
				
				$showCurrent = $show || count ( $this->_limitedChannels ) == 0 || in_array ( $channel ["cid"], $this->_limitedChannels );
				
				if ($showCurrent)
					$out .= '
				<div class="tsstatusItem">
					<div class="tsstatusLabel">
						<a href="' . $link . '">
							<img src="/inc/resource/images/tsicons/' . $icon . '" />' . $channel ["channel_name"] . '
						</a>
					</div>
					<div class="tsstatusFlags">
						' . $this->renderFlags ( $flags ) . '
					</div>
					' . (count ( $this->_userDatas ) > 0 ? $this->renderUsers ( $channel ["cid"] ) : '');
				
				$out .= $this->renderChannels ( $channel ["cid"], $showCurrent );
				
				if ($showCurrent)
					$out .= '</div>';
			}
		}
		return $out;
	}
	private function renderNickNameBox() {
		$cookieName = "tsstatus_" . str_replace ( ".", "_", $this->_host );
		$nickname = isset ( $_COOKIE [$cookieName] ) ? $_COOKIE [$cookieName] : "";
		$out = '<div class="tsstatusNickname">Nickname: <input type="text" id="tsstatusNick" value="' . $nickname . '" /></div>';
		return $out;
	}
	private function renderPasswordBox() {
		$cookieName = "tsstatus_" . str_replace ( ".", "_", $this->_host ) . "_pwd";
		$password = isset ( $_COOKIE [$cookieName] ) ? $_COOKIE [$cookieName] : "";
		$out = '<div class="content.tsstatusPassword">Password: <input type="text" id="tsstatusPasswd" value="' . $password . '" /></div>';
		return $out;
	}
	public function render($serverName) {
		$out = "";
		try {
			if ($this->_cacheTime > 0 && file_exists ( $this->_cacheFile ) && (filemtime ( $this->_cacheFile ) + $this->_cacheTime >= time ())) {
				$out .= file_get_contents ( $this->_cacheFile );
			} else {
				$out .= '<input type="hidden" class="tsServerIP" value="' . $serverName . '" /><div class="tsstatus">' . "\n";
				$this->update ( $serverName );
				
				$out .= '<div class="tsstatusServerName"><a href="javascript:content.tsstatusconnect(\'' . $this->_host . "','" . $this->_serverDatas ["virtualserver_port"] . '\')"><img src="/inc/resource/images/tsicons/16x16_server_green.png" />' . $this->_serverDatas ["virtualserver_name"] . "</a></div>\n";
				if (count ( $this->_channelDatas ) > 0)
					$out .= $this->renderChannels ( 0 );
				$out .= "</div>\n";
				
				if ($this->_cacheTime > 0) {
					if (! @file_put_contents ( $this->_cacheFile, $out )) {
						throw new Exception ( "Unable to write to file: " . $this->_cacheFile );
					}
				}
			}
		} catch ( Exception $ex ) {
			$this->disconnect ();
			$out = '<div class="tsstatuserror">' . $ex->getMessage () . '</div>';
		}
		return $out;
	}
	private function checkUsername($username) {
		if (strlen ( $username ) > 14) {
			$username = substr ( $username, 0, 12 ) . "...";
		}
		return htmlentities ( $username );
	}
}