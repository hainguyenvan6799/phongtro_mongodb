<?php 
require_once "mvc/core/vendor/autoload.php";
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
				"from" => 2,
				"to" => 1,
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
	// print_r($result);
	echo '<br>';
	// $count = count($result);
	foreach($result as $r)
	{
		echo $r["count"];
	}
 ?>