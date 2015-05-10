<?php

namespace Controllers;

/**
* 
*/
class Users extends \Controllers\Base{
	/**
	*@var \Models\Posts
	*/
	private $userModel;


	public function __construct(){
		parent::__construct();
		$this->userModel = new \Models\User();
	}

	public function index()	{
		$this->view->posts = $this->postModel->getAll();
		//todo add view
		$this->view->appendToLayout('posts','postsView');
		$this->view->display('layouts.viewPost');
	}

	public function logout(){
		$this->app->getSession()->username = null;
		$this->app->getSession()->userId = null;
		self::authorize();
	}

	public function login()	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
			$username = $this->input->post('username');

			$this->view->previousUsernameReg = $username;

			self::DieWithErrorIfDontExist('username');
			self::DieWithErrorIfDontExist('password');

			$user = $this->userModel->findByName($username);
			if ($user) {
				$password = $this->input->post('password');
				if (password_verify($password, $user['password'])) {
					$this->app->getSession()->username = $username;
					$this->app->getSession()->userId = $user['id'];
					$this->redirect('posts');
				}else{
					$this->view->errorMessage = 'This password is incorrect';
					self::showForms();
				}
			}
		} else {
			self::showForms();
		}
	}

	public function register()	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$username = $this->input->post('username');
			$email = $this->input->post('email');

			$this->view->previousUsernameReg = $username;
			$this->view->previousEmail = $email;

			self::DieWithErrorIfDontExist('username');
			self::DieWithErrorIfDontExist('password');
			self::DieWithErrorIfDontExist('confirmPassword');
			self::DieWithErrorIfDontExist('email');

			$username = $this->input->post('username');
			$user = $this->userModel->find($username);
			if ($user) {
				$this->view->errorMessage = 'This username exist';
				self::showForms();
			}

			$password = $this->input->post('password');
			$confirmPassword = $this->input->post('confirmPassword');
			if ($password !== $confirmPassword) {
				$this->view->errorMessage = 'Passwords don`t match';
				self::showForms();
			}

			$user = $this->userModel->create($username, $password, $email);
			if (!$user) {
				$this->view->errorMessage = 'Registration is NOT successful';
				self::showForms();
			}
			$this->app->getSession()->username = $username;
			$this->app->getSession()->userId = $user;
			$this->redirect('posts');


		} else {
			self::showForms();
		}
	}

	/**
	*Check for post key
	*/
	public function DieWithErrorIfDontExist($field)	{
		if ($field) {
			if (!$this->input->hasPost($field)) {
				$this->view->errorMessage = ucfirst($field).' is required';
				self::showForms();
			}
		}
	}

	public function showForms()	{
		$this->view->appendToLayout('login','login');
		$this->view->appendToLayout('register','register');
		$this->view->display('layouts.logReg');
		die();
	}
}