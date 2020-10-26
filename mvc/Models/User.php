<?php 
	class User extends DB
	{
		public function createNewUser($username, $password){
			$document = array(
				"username" =>  $username,
				"password" => $password
			);
			$result = $this->userCollection->insertOne($document);
			echo 'Register Successfully';
		}

		public function checkForLogin($username, $password)
		{
			// $userCollection = (new MongoDB\Client)->phongtrodb->users;
			// $this->filter =['$and' => [['username'=> $username], ['password'=>$password]]];
			// $this->options = [];
			$result = $this->userCollection->find(['username'=>$username, 'password'=>$password]);
			if($result)
			{
				$_SESSION["username"] = $username;
				$_SESSION["password"] = $password;
				$_SESSION["user_type"] = "user";
				echo $_SESSION["username"];
				foreach($result as $r)
				{
					// echo $r->username . '<br>';
					$_SESSION["user_id"] = $r->user_id;
					$_SESSION["name"] = $r->name;
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

		public function sendFrRequest($from, $friend_id, $action){
			if($action == "friend_request")
			{
				$this->userCollection->updateOne(
					['user_id' => $_SESSION["user_id"]],
					['$push' => ['relationship' => 
					[
						'friend_id' => (int)$friend_id,
						'status' => "p" //pending friend request
					]
				]]

				);

				$this->userCollection->updateOne(
					['user_id' => (int)$friend_id],
					['$push' => ['relationship' => 
					[
						'friend_id' => $_SESSION["user_id"],
						'status' => "p" //pending friend request
					]
				]]

				);
			}
		}

		public function acceptFrRequest($from, $to){
			$update = $this->userCollection->findOneAndUpdate(
				['$and' =>[ ['user_id' => (int)$from], ['relationship' => ['friend_id' => (int)$to, 'status' => "p"]] ]],
				['$set' => ['relationship.$.status' => "f"] ] 
			);

			$update2 = $this->userCollection->findOneAndUpdate(
				['$and' =>[ ['user_id' => (int)$to], ['relationship' => ['friend_id' => (int)$from, 'status' => "p"]] ]],
				['$set' => ['relationship.$.status' => "f"] ] 
			);
		}

		public function getFriendsOfUser($user_login)
		{
			$user = $this->userCollection->find(
				['$and' => [ ['user_id' => $user_login], ['relationship.status' => "f" ] ]]
			);
			return $user;
		}
	}
 ?>