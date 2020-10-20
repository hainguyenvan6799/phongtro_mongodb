<?php 
	class Message extends DB
	{

		public function getMessageFromMeToUser($user_id)
		{
			$my_id = $_SESSION['user_id'];
			$this->filter =['$or' => [
				[ '$and' => [ ['from'=>$my_id], ['to'=>(int)$user_id] ] ],
				 ['$and' => [ ['from'=>(int)$user_id], ['to' => $my_id] ]]
			] ];
			$this->query = new MongoDB\Driver\Query($this->filter, $this->options);
			$message = $this->mongoConnection->executeQuery("phongtrodb.message", $this->query);
			// foreach($message as $m)
			// {
			// 	echo $m->message;
			// }

			$bulk = new MongoDB\Driver\BulkWrite;
			$bulk->update(
			    [ 'from' => (int)$user_id, 'to'=> $my_id, 'is_read' => 0],
			    ['$set' => ['is_read' => 1]],
			    ['multi' => true, 'upsert' => false]
			);

			$result = $this->mongoConnection->executeBulkWrite("phongtrodb.message", $bulk);
			
			return $message;
		}

		public function createMessage($from, $to, $message, $is_read){
			$messageCollection = (new MongoDB\Client)->phongtrodb->message;
			$document = [
				"from" => $from,
				"to" => (int)$to,
				"message" => $message,
				"is_read" => $is_read
			];
			$messageCollection->insertOne($document);
		}

		public function countMessageNoRead($from){
			$count = 0;
			$to = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : "";
			$messageCollection = (new MongoDB\Client)->phongtrodb->message;
			$ops = [
				[
					'$lookup' => [
						"from" => "users",
						"localField" => "from",
						"foreignField" => "user_id",
						"as" => "users_doc"
					]
				],
				[
					'$match' => [
						"from" => $from,
						"to" => $to,
						"is_read" => 0
					]
				],
				[
					'$group' => [
						"_id" => null,
						"count" => ['$sum' => 1]
					]
				]


					
			];
			$result = $messageCollection->aggregate($ops);
			foreach($result as $r)
			{
				$count = $r["count"];
			}
			return $count;
		}
	}
 ?>