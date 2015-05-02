<?php
/**
* 
*/
namespace GF;
include_once 'Loader.php';
class App
{
	private static $_instance = null;
	private $_config = null;
	private $_dbConnections = array();
	private $_session = null;
	private $router = null;
	/**
	*
	*@var \GF\FrontController
	*/
	private $_frontController = null;

	private function __construct(){
		set_exception_handler(array($this, '_exceptionHandler'));
		\GF\Loader::registerNamespace('GF', dirname(__FILE__) . DIRECTORY_SEPARATOR);
		\GF\Loader::registerAutoLoad();
		$this->_config = \GF\Config::getInstance();
	}

	public function setConfigFolder($path){
		$this->_config->setConfigFolder($path);
	}

	public function getConfigFolder(){
		return $this->_configFolder;
	}
	
	public function setRouter($router){
		$this->router = $router;
	}

	public function getRouter(){
		return $this->router;
	}

	/**
	*
	* @return \GF\Config
	*/
	public function getConfig(){
		return $this->_config;
	}

	public function run(){

		//If config folder is not set, use defaultone
		if ($this->_config->getConfigFolder() == null){
			$this->setConfigFolder('config');
		}

		$this->_frontController = \GF\FrontController::getInstance();

		if ($this->router instanceof \GF\Routers\IRouter) {
			$this->_frontController->setRouter($this->router);
		} else {
			$this->_frontController->setRouter(new \GF\Routers\DefaultRouter());
		}

		$_sess = $this->_config->app['session'];
		if ($_sess['autostart']) {
			if ($_sess['type'] == 'native') {
				 $_s = new \GF\Sessions\NativeSession($_sess['name'], $_sess['lifetime'], $_sess['path'], $_sess['domain'], $_sess['secure']);
			}
			elseif ($_sess['type'] == 'database') {
				 $_s = new \GF\Sessions\DBSession($_sess['dbConnection'], $_sess['name'], $_sess['dbTable'], $_sess['lifetime'], $_sess['path'], $_sess['domain'], $_sess['secure']);
			}
			else{
				throw new \Exception("No valid session", 500);
				
			}
			$this->setSession($_s);
		}

		$this->_frontController->dispatch();
	}

	public function setSession(\GF\Sessions\ISession $session){
		$this->_session = $session;
	}

	/**
	*@return \GF\Sessions\NativeSession
	*/
	public function getSession(){
		return $this->_session;
	}

	public function getDBConnection($connection = 'default'){
		if(!$connection){
			throw new \Exception("No Connection identifier provider", 500);		
		}

		if ($this->_dbConnections[$connection]) {
			return $this->_dbConnections[$connection];
		}

		$_cnf = $this->getConfig()->database;
		if (!$_cnf[$connection]) {
			throw new \Exception("No valid connection identificator is provided", 500);		
		}

		$dbh = new \PDO($_cnf[$connection]['connection_uri'], $_cnf[$connection]['username'], $_cnf[$connection]['password'], $_cnf[$connection]['pdo_options']);
		$this->_dbConnections[$connection] = $dbh;
		return $dbh;
	}	
	/**
	* @return \GF\App
	*/
	public static function getInstance(){
		if (self::$_instance == null) {
			self::$_instance = new \GF\App();
		}

		return self::$_instance;
	}

	public function _exceptionHandler(\Exception $ex)
	{
		if ($this->_config && $this->_config->app['displayExceptions'] == true) {
			echo "<pre>".print_r($ex,true)."</pre>";
		} else {
			$this->displayError($ex);
		}
	}

	public function displayError($error)	{
		try {
			$view = \GF\View::getInstance()->display('errors.'.$error);
		} catch (\Exception $exc) {
			echo $error;
			exit;
		}
	}

	public function __destruct(){
		if ($this->_session != null) {
			$this->_session->saveSession();
		}
	}



}