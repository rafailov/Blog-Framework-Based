<?php

namespace GF\Sessions;

/**
* 
*/
class DBSession extends \GF\DB\SimpleDB implements \GF\Sessions\ISession {

	private $sessionName;
	private $tableName;
	private $lifetime;
	private $path;
	private $domain;
	private $secure;
	private $sessionData = array();
	private $sessionId = null;

	public function __construct($dbconnection, $name, $tableName = 'sessions', $lifetime = 3600, $path = null, $domain = null, $secure = false){

		parent::__construct($dbconnection);
		$this->tableName = $tableName;
		$this->sessionName = $name;
		$this->lifetime = $lifetime;
		$this->path = $path;
		$this->domain = $domain;
		$this->secure = $secure;
		$this->sessionId = $_COOKIE[$name];
		if (rand(0,50) == 1) {
			$this->_gc();
		}

		if (strlen($this->sessionId) < 32) {
			$this->_startNewSession();
		} else if (!$this->validateSession()){
			$this->_startNewSession();
		}
	}

	public function __get($name){
		return $this->sessionData[$name];
	}

	public function __set($name, $value){
		$this->sessionData[$name] = $value;
	}

	private function _startNewSession(){
		$this->sessionId = md5(uniqid('gf', TRUE));
		$this->prepare('INSERT INTO ' . $this->tableName . ' (sessid,valid_until) VALUES (?,?)', array($this->sessionId, (time() + $this->lifetime)))->execute();
		setcookie($this->sessionName, $this->sessionId, (time() + $this->lifetime), $this->path, $this->domain, $this->secure, true);
	}

	private function validateSession() {
		//TODO ADD FINGEER PRINT
			if ($this->sessionId) {
				$d = $this->prepare('SELECT * FROM ' . $this->tableName . ' WHERE sessid=? AND valid_until<=?',
				 array($this->sessionId, (time() + $this->lifetime)))->execute()->fetchAllAssoc();

				if (is_array($d) && count($d) == 1 && $d[0]) {
					$this->sessionData = unserialize($d[0]['sess_data']);
					return true;
				}
			}
			return false;
		}
	

	public function getSessionId(){
	}
	
	public function saveSession(){
		if ($this->sessionId) {
			$this->prepare('UPDATE ' . $this->tableName . ' SET sess_data=?,valid_until=? WHERE sessid=?', array(serialize($this->sessionData), (time() + $this->lifetime), $this->sessionId))->execute();
			setcookie($this->sessionName, $this->sessionId, (time() + $this->lifetime), $this->path, $this->domain, $this->secure, true);

		}
	}

	public function destroySessionId(){
		if ($this->sessionId) {
			$this->prepare('DELETE FROM ' . $this->tableName . ' WHERE sessid=?', array($this->sessionId))->execute();
		}
	}

	private function _gc(){
		$this->prepare('DELETE FROM `' . $this->tableName . '` WHERE valid_until<?', array(time()))->execute();
	}

}