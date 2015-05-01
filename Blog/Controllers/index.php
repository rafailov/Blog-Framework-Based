<?php

namespace Controllers;
/**
* 
*/
class Index extends \GF\BaseController
{
	public function __construct(){
		parent::__construct();
	}

	public function index2(){
		$view = \GF\View::getInstance();
		$view->chocho = "->".\GF\InputData::getInstance()->get('1')."<-";
		$view->qwerty = "->qwerty<-";
		$view->appendToLayout('login','login');
		$view->appendToLayout('register','register');
		$view->display('layouts.default');
	}
}