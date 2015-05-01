<?php

namespace GF;
/**
* 
*/
class FrontController{
	private static $_instance = null;
	private $ns = null;
	private $controller = null;
	private $method = null;
	/**
	*@var \GF\Routers\IRouter
	*/
	private $router = null;

	private function __construct(){
		# code...
	}

	public function getRouter(){
		return $this->router;
	}

	public function setRouter(\GF\Routers\IRouter $router){
		$this->router = $router;
	}

	public function dispatch(){
		if ($this->router == null) {
			throw new Exception("No valid router found", 500);	
		}

		$_uri = $this->router->getURI();
		$routes = \GF\App::getInstance()->getConfig()->routes;
		$_rc = null;

		if (is_array($routes) && count($routes) > 0) {
			foreach ($routes as $k => $v) {
				if (strpos($_uri, $k) === 0 && ($_uri == $k || strpos($_uri, $k . '/') === 0) && $v['namespace']) {
					$this->ns = $v['namespace'];
					$_uri = substr($_uri, strlen($k) + 1);
					$_rc = $v;
					break;
				}
			}
		}else{
			throw new Exception("Default route missing", 500);
		}

		if ($this->ns == null && $routes['*']['namespace']) {
			$this->ns = $routes['*']['namespace'];
		} else if ($this->ns == null && !$routes['*']['namespace']) {
			throw new Exception("Default route missing", 500);
		}

		$_params = explode('/', $_uri);
		if ($_params[0]) {
			$this->controller = strtolower($_params[0]);
			if ($_params[1]) {
				$this->method = strtolower($_params[1]);
				unset($_params[0], $_params[1]);
				\GF\InputData::getInstance()->setGet(array_values($_params));
			} else {
				$this->method = $this->getDefaultMethod();
			}
		} else {
			$this->controller = $this->getDefaultController();
			$this->method = $this->getDefaultMethod();
		}
		
		if (is_array($_rc) && $_rc['controllers']) {
			if ($_rc['controllers'][$this->controller]['methods'][$this->method]) {
				$this->method = strtolower($_rc['controllers'][$this->controller]['methods'][$this->method]);
			}

			if (isset($_rc['controllers'][$this->controller]['to'])) {
				$this->controller = strtolower($_rc['controllers'][$this->controller]['to']);
			}

		}
		//echo "<br/>URI :".$this->_uri. "<br/>Controller :".$this->controller. "<br/>Method :".$this->method. "<br/>Params :<br/>". print_r(\GF\InputData::getInstance()->get(0),true);
		$input = \GF\InputData::getInstance();
		$input->setPost($this->router->getPost());
		
		$f = $this->ns . '\\' . ucfirst($this->controller);
		$newController = new $f();
		$newController->{$this->method}();
	}

	public function getDefaultController(){
		$controller = \GF\App::getInstance()->getConfig()->app['default_controller'];
		if ($controller) {
			return strtolower($controller);
		}

		return 'Index';
	}

	public function getDefaultMethod(){
		$method = \GF\App::getInstance()->getConfig()->app['default_method'];
		if ($method) {
			return strtolower($method);
		}

		return 'index';
	}

	/**
	*
	* @return \GF\FrontController
	*/
	public static function getInstance(){
		if (self::$_instance == null){
			self::$_instance = new \GF\FrontController();
		}
		
		return self::$_instance;
	}
}