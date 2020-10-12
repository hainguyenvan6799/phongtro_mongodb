<?php 
	class LoginController extends BaseController
	{
		protected $userModel;
		public function __construct(){
			$this->userModel = $this->model("User");
		}
		public function getFormLogin(){
			$this->view("Login/loginForm");
		}
		public function postFormLogin(){
			$username = ($_POST["username"]);
			$password = ($_POST["password"]);
			$this->userModel->checkForLogin($username, $password);
		}
	}
 ?>