<?php

namespace GF;
/**
* 
*/
class BaseController
{
	public $app;
	public $view;
	public $input;
	public $config;
	
	public function __construct()
	{
		$this->app = \GF\App::getInstance();
		$this->view = \GF\View::getInstance();
		$this->config = $this->app->getConfig();
		$this->input = \GF\InputData::getInstance();
	}
}