<?php

namespace Controllers;
/**
* 
*/
class Posts extends \Controllers\Base
{
	/**
	*@var \Models\Posts
	*/
	private $postModel;
	/**
	*@var \GF\View
	*/
	public $view;
	/**
	*@var \GF\InputData
	*/
	private $inpData;


	public function __construct(){
		parent::__construct();
		$this->postModel = new \Models\Post();
		$this->view = \GF\View::getInstance();
		$this->inpData = \GF\InputData::getInstance();
	}

	public function index()	{
		$this->view->posts = $this->postModel->getAll();
		$_SESSION['asd']='qwerty';
		var_dump($_SESSION);
		//todo add view
		$this->view->appendToLayout('login','login');
		$this->view->display('layouts.default');
	}

	public function view(){
		if ($this->inpData->hasGet(0)) {
			$post_id = $this->inpData->get(0);
			$this->view->currentPost = $this->postModel->find($post_id);

			//todo add view
			$this->view->appendToLayout('login','login');
			$this->view->display('layouts.default');
		}else{
			header('Location: /Blog-Framework-Based.git/Blog/public/index.php/posts');
		}
	}

	public function add(){
		if ($this->inpData->hasPost('title') ) {
					# code...
		}	
		echo "<pre>".print_r($_SERVER,true)."</pre>";	
	}

}