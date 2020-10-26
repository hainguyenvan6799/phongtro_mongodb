<?php 
	require_once "./mvc/core/vendor/autoload.php";
	session_start();

	$userCollection = (new MongoDB\Client)->phongtrodb->users;

// $userss = $userCollection->findOneAndUpdate(
// 				['relationship' => ['friend_id' => (int)2, 'status' => "p"]],
// 				['$set' => ['relationship.$.status' => "f"] ] 
// 			);
// var_dump($userss);


	// $userUpdate = $userCollection->updateOne(
	// 	['username' => 'qakhudaubuon12@gmail.com'],
	// 	['$set' => [
	// 		"relationship" => [
	// 			[
	// 				'friend_id' => (int)1,
	// 				'status' => "f"
	// 			]
	// 		]
	// 	]
	// ]

	// 	['$push' => ['relationship' => 
	// 	[
	// 		'friend_id' => (int)2,
	// 		'status' => 'p'
	// 	]
	// ]]
	// );
	// var_dump($userUpdate);

	// --------------------------------------------------------------------------------
	// $user = $userCollection->find(
	// 			['$and' => [ ['user_id' => 2], ['relationship.status' => "f" ]]]
	// 		);
	// foreach($user as $u)
	// {
	// 	echo $u->username;
	// }

	//----------------------------------------------------------------------------------

	$users = $userCollection->find(
		['username' => ['$ne' => 'qakhudaubuon12@gmail.com']]
	);
	foreach($users as $u)
	{
		foreach($u->relationship as $r)
		{
			if( ($r->status != "f" || $r->status == '') && $u->user_id != $_SESSION["user_id"])
			{
				echo $r->status . '<br>';
				echo $u->user_id . '<br>';
				echo $u->username . '<br>';
				echo '<button class="add-fr" id="'.$u->user_id.'">Kết bạn</button><br>';
			}
		}
		
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<div id="friend_request">
 		<input type="hidden" name="" id="user_login" value="<?php echo $_SESSION['user_id']; ?>">
 	</div>
 </body>
 <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script type="text/javascript">
 	$(document).ready(function(){
 		var friend_id = '';
 		var user_login = $('#user_login').val();

 		var action = "friend_request";

 		Pusher.logToConsole = true;

        var pusher = new Pusher('ed3cf9bac608e3b56afa', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
        	// alert(JSON.stringify(data));
        	friend_id = data["friend_id"];
        	from = data["from"];
        	// alert(typeof(user_login));
        	// alert(typeof(friend_id));
        	if(user_login == friend_id)
        	{
        		$('#friend_request').append('<h3>You have a friend request</h3><a href="./ChatRealtime/acceptFrRequest/'+from+ '/' + friend_id +'">Accept Now</a>');
        	}

        });
 		$('.add-fr').on('click', function(){
 			// alert($(this).attr('id'));
 				friend_id = $(this).attr('id');
 			$.ajax({
 				type: "post",
 				url: './ChatRealtime/sendFrRequest',
 				data: {friend_id:friend_id, action: action},
 				success: function(){

 				}
 			});
 		});

 		// $('#accept-button').on('click', function(){
 			// $.ajax({
 			// 	type: "post",
 			// 	url: './ChatRealtime/acceptFrRequest',
 			// 	data: {relationship_a: user_login, relationship_b: $('#friend_id_request').val()},
 			// 	success: function(content){
 			// 		alert(content);
 			// 	}
 			// });
 		// 	alert("hello");
 		// });
 	});
 </script>
 </html>