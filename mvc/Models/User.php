<?php 
	class User extends DB
	{
		public function createNewUser($username, $password){
			$document = array(
				"username" =>  $username,
				"password" => $password
			);
			$result = $this->collectionUser->insertOne($document);
			echo 'Register Successfully';
		}

		public function checkForLogin($username, $password)
		{
			$userCollection = (new MongoDB\Client)->phongtrodb->users;
			// $this->filter =['$and' => [['username'=> $username], ['password'=>$password]]];
			// $this->options = [];
			$result = $userCollection->find(['username'=>$username, 'password'=>$password]);
			if($result)
			{
				$_SESSION["username"] = $username;
				$_SESSION["password"] = $password;
				foreach($result as $r)
				{
					// echo $r->username . '<br>';
					$_SESSION["user_id"] = $r->user_id;
					// echo $r->user_id;
				}
				
			}
			else
			{
				echo '<script>window.location.href="../Login/getFormLogin"</script>';
			}
		}
		public function getAllUserWithoutUserLogin(){
			$my_id = $_SESSION['user_id'];
			$this->filter = ["user_id"=>['$ne'=>$my_id]]; // not equal
			$this->query = new MongoDB\Driver\Query($this->filter, $this->options);
			$users = $this->mongoConnection->executeQuery("phongtrodb.users", $this->query);
			return $users;
		}
	}
 ?>