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
  		$pusher->trigger('my-channel', 'my-event', $data);
		}
	}
 ?>