<?php

namespace Controllers;

/**
* 
*/
class Base extends \GF\BaseController{
	
	public function __construct(){
		parent::__construct();
	}

    protected function redirect($controller = null, $action = null, $params = []) {
        if ($controller == null) {
            $controller = $this->controller;
        }
        $url = "/Blog-Framework/Blog/index.php/$controller/$action";
        $paramsUrlEncoded = array_map('urlencode', $params);
        $paramsJoined = implode('/', $paramsUrlEncoded);
        if ($paramsJoined != '') {
            $url .= '/' . $paramsJoined;
        }
        $this->redirectToUrl($url);
    }

    protected function redirectToUrl($url) {
        header("Location: $url");
        die;
    }


    protected function isLoggedIn() {
        if ($this->app->getSession()->username !== null) {
            return true;
        }
        return false;
    }

    protected function authorize() {
        if (! $this->isLoggedIn()) {
            $this->redirect("users", "login");
        }
    }
}