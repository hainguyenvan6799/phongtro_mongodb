<?php 
	class RegisterController extends BaseController
	{
		public $userModel;
		public function __construct(){
			$this->userModel = $this->model("User");
		}
		public function getFormRegister(){
			$this->view("Register/registerForm");
		}
		public function postFormRegister(){
			$userName = mysql_real_escape_string($_POST["username"]);
			$password = mysql_real_escape_string($_POST["password"]);
			$this->userModel->createNewUser($userName, $password);
		}
	}
 ?>