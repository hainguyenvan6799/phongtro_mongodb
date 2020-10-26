<?php 
	require_once "mvc/core/vendor/autoload.php";
	class ChatRealtimeController extends BaseController
	{
		public $userModel;
		public $messageModel;
		public function __construct(){
			$this->userModel = $this->model("User");
			$this->messageModel = $this->model("Message");
		}
		public function getChatView(){
			$users = $this->userModel->getAllUserWithoutUserLogin();

			$this->view('ChatRealtime/getChat',
				[
					"users" => $users
				]
			);
		}
		public function chatWith($user_id)
		{
			$message = $this->messageModel->getMessageFromMeToUser($user_id);
			$this->view('ChatRealtime/contentChat', [
				"message" => $message
			]);
		}

		public function sendMessage(){
			$from = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';
			$to = isset($_POST["received_id"]) ? $_POST["received_id"] : '';
			$message = isset($_POST["message"]) ? $_POST["message"] : '';
			$name_user_login = isset($_SESSION["name"]) ? $_SESSION['name'] : '';
			$is_read = 0;
			$this->messageModel->createMessage($from, $to, $message, $is_read);

			$options = array(
		    'cluster' => 'eu',
		    'useTLS' => true
		  );
		  $pusher = new Pusher\Pusher(
		    'ed3cf9bac608e3b56afa',
		    'aac2cefbec89dc1447e9',
		    '1088393',
		    $options
		  );

		$data['from'] = $from;
		$data['to'] = (int)$to;
		$data['message'] = $message;
		$data['is_read'] = $is_read;
		$data['name'] = $name_user_login;
  		$pusher->trigger('my-channel', 'my-event', $data);
		}

		public function sendFrRequest(){
			session_start();
			$from = "qakhudaubuon12@gmail.com";
			$action = isset($_POST["action"]) ? $_POST["action"] : '';
			$friend_id = isset($_POST["friend_id"]) ? $_POST["friend_id"] : '';
			$options = array(
		    'cluster' => 'eu',
		    'useTLS' => true
		  );
		  $pusher = new Pusher\Pusher(
		    'ed3cf9bac608e3b56afa',
		    'aac2cefbec89dc1447e9',
		    '1088393',
		    $options
		  );
		  $data['action'] = $action;
		  $data['friend_id'] = $_POST["friend_id"];
		  $data["from"] = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "";

		  $this->userModel->sendFrRequest($from, $friend_id, $action);
		  $pusher->trigger('my-channel', 'my-event', $data);
		}

		public function acceptFrRequest($from, $to){
			$this->userModel->acceptFrRequest($from, $to);

		}

		public function getChatBox(){
			$user_login = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';
			$getFriends = $this->userModel->getFriendsOfUser($user_login);
			foreach($getFriends as $g)
			$this->view('ChatRealtime/chatbox', [
				'getFriends' => $getFriends
			]);
		}
	}
 ?>