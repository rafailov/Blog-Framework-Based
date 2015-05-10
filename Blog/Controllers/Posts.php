<?php

namespace Controllers;
/**
* 
*/
class Posts extends \Controllers\Base
{
	/**
	*@var \Models\Post
	*/
	private $postModel;
	/**
	*@var \Models\Tag
	*/
	private $tagModel;
	/**
	*@var \Models\User
	*/
	private $userModel;


	public function __construct(){
		parent::__construct();
		$this->postModel = new \Models\Post();
		$this->tagModel = new \Models\Tag();
		$this->userModel = new \Models\User();
	}

	public function index()	{
		$this->view->posts = $this->postModel->getAll();
			$this->view->tagsToAdd = $this->tagModel->getAll();
		//todo add view
		$this->view->appendToLayout('tagsToAdd','tagsToAdd');
		$this->view->appendToLayout('posts','postsView');
		$this->view->display('layouts.viewPost');
	}

	public function view(){
		if ($this->input->hasGet(0)) {
			$post_id = $this->input->get(0);
			$this->view->currentPost = $this->postModel->find($post_id);

			$byUserId = $this->view->currentPost['user_id'];
			if ($byUserId) {
				$addedBy = $this->userModel->find($byUserId);

				if ($addedBy['username']) {
					$this->view->byUsername = $addedBy['username'];
				}
			}

			$this->view->currentPostTags = $this->tagModel->getTagsForPost($post_id);
			//todo add view
			$this->view->appendToLayout('viewPost','viewPost');
			$this->view->display('layouts.viewPost');
		}else{
			$this->redirect('posts');
		}
	}

	public function add(){
		self::authorize();
		if ($_SERVER['REQUEST_METHOD'] == 'GET') {
			$this->view->tagsToAdd = $this->tagModel->getAll();

			$this->view->appendToLayout('addedTags','addedTags');
			$this->view->appendToLayout('tagsToAdd','tagsToAdd');
			$this->view->appendToLayout('addPostForm','addPost');
			$this->view->display('layouts.addPost');

		} else if ($this->input->hasPost('title') && $this->input->hasPost('content')) {
			$title = $this->input->post('title');
			$content = $this->input->post('content');

			//todo add messages if crash
			$insertedPostId = $this->postModel->create($title,$content, $this->app->getSession()->userId);

			if ($insertedPostId) {
				//get tags and add to added post
				if ($this->input->hasPost('tags')) {
					$tags = explode(',',$this->input->post('tags'));
					foreach ($tags as $value) {
						$tag = $this->tagModel->findByName($value);

						if (!$tag) {
							$tagId = $this->tagModel->create($value);
						} else {
							$tagId = intval($tag['id']); 
						}

						if ($tagId > 0) {
							$this->tagModel->addTagToPost($tagId, $insertedPostId);
						}
					}
				}else{
					//no one tags
				}
				
				$this->redirect('posts','view',array($insertedPostId));
			} else {
				//post isnt inserted
			}
			//todo fix this with add mesege and load prevision data
			//$this->redirect('posts','add');
		}	else {
			
			//todo return to form with messege
		}
	}

	public function comment() {

	}

}