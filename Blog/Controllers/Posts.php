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
	*@var \Models\Tags
	*/
	private $tagModel;
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
		$this->tagModel = new \Models\Tags();
		$this->view = \GF\View::getInstance();
		$this->inpData = \GF\InputData::getInstance();
	}

	public function index()	{
		$this->view->posts = $this->postModel->getAll();
		var_dump($_SESSION);
		var_dump($this->isLoggedIn());
		var_dump($this->isLoggedIn());
		//todo add view
		$this->view->appendToLayout('login','login');
		$this->view->display('layouts.viewPost');
	}

	public function view(){
		if ($this->inpData->hasGet(0)) {
			$post_id = $this->inpData->get(0);
			$this->view->currentPost = $this->postModel->find($post_id);
			$this->view->title = $this->view->currentPost['title'];
			//todo add view
			$this->view->appendToLayout('viewPost','viewPost');
			$this->view->display('layouts.viewPost');
		}else{
			$this->redirect('posts');
		}
	}

	public function add(){
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$this->view->tagsToAdd = $this->tagModel->getAll();

			$this->view->appendToLayout('addedTags','addedTags');
			$this->view->appendToLayout('tagsToAdd','tagsToAdd');
			$this->view->appendToLayout('addPostForm','addPost');
			$this->view->display('layouts.addPost');

		} else if ($this->inpData->hasPost('title') && $this->inpData->hasPost('content')) {

			$title = $this->inpData->post('title');
			$content = $this->inpData->post('content');

			//todo add messages if crash
			$insertedRow = $this->postModel->create($title,$content);
			if ($insertedRow) {
				$this->redirect('posts','view',array($insertedRow));
			}
			//todo fix this with add mesege and load prevision data
			$this->redirect('posts','add');
		}	else {
			//todo return to form with messege
		}
	}

	public function comment() {

	}

}