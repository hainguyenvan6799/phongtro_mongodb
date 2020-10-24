<?php 
	require_once "./mvc/core/vendor/autoload.php";

	$userCollection = (new MongoDB\Client)->phongtrodb->users;

	$userUpdate = $userCollection->updateOne(
		['username' => 'qakhudaubuon12@gmail.com'],
	// 	['$set' => [
	// 		"relationship" => [
	// 			[
	// 				'friend_id' => (int)1,
	// 				'status' => "f"
	// 			]
	// 		]
	// 	]
	// ]

		['$push' => ['relationship' => 
		[
			'friend_id' => (int)2,
			'status' => 'p'
		]
	]]
	);
	var_dump($userUpdate);
 ?>