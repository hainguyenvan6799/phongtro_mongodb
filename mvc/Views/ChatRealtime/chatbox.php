<?php 
	if(isset($_SESSION["username"]) != '')
	{

	}

	else
	{
		echo '<script>window.location.href="Login/getFormLogin";</script>';
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<base href="http://localhost:88/QuanLyPhongTro/">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="public/css/chatbox.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

	<!-- <script type="text/javascript" src="public/js/chatbox.js"></script> -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/css/app.css">
	 <style type="text/css">
        ul
        {
            margin: 0;
            padding: 0;
        }
        li
        {
            list-style: none;
        }
        .user-wrapper, .message-wrapper{
            /*border: 1px solid #dddddd;*/

        }
        .user-wrapper{
            height: 600px;

        }
        .user
        {
            cursor: pointer;
            padding: 5px 0;
            position: relative;
        }
        .user:hover
        {
            background: #eeeeee;
        }
        .user:last-child
        {
            margin-bottom: 0;
        }
        .pending
        {
            position: absolute;
            top: 5px;
            left: 13px;
            background: #b600ff;
            margin: 0;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            line-height: 18px;
            padding-left: 5px;
            color: #ffffff;
            font-size: 12px;

        }
        .media-left
        {
            margin: 0 10px;
        }
        .media-left img
        {
            width: 64px;
            border-radius: 64px;

        }
        .media-body p
        {
            padding: 10px;
            margin: 6px 0;
        }
        .message-wrapper
        {
            padding: 10px;
            /*background: #eeeeee;*/
            height: auto;
        }
        .messages .message:last-child
        {
            margin-bottom: 10px;
        }
        .received, .sent
        {
            width: 45%;
            padding: 3px 10px;
            border-radius: 10px;

        }
        .received
        {
            background: #ffffff;

        }
        .sent
        {
            background: #3bebff;
            float: right;
            text-align: right;
        }
        .message p
        {
            margin: 5px 0;
        }
        .date 
        {
            background: #eeeeee;
            color: #777777;
            font-size: 12px;

        }
        .active {
            background: #eeeeee;

        }
        input[type=text]
        {
            width: 100%;
            padding: 12px 20px;
            margin: 15px 0 0 0;
            display: inline-block;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            border: 1px solid  #eeeeee;

        }
        input[type=text]:focus
        {
            border: 1px solid #aaaaaa;
        }
        .nhanvao{
        	font-size: 19px;
        	border: none;
        }
        #friends_table
        {
        	border: 1px solid black;
        	margin-top: 100px;
        	border-collapse: collapse;
        	width: 400px;
        	height: auto;
        	text-align: center;
        	font-size: 20px;
        }
        #friends_table th{
        	font-weight: bold;
        	font-size: 23px;
        }
        #friends_table tr,th,td
        {
        	border: 1px solid black;
        	padding: 7px;
        }
    </style>
	<!------ Include the above in your HEAD tag ---------->
</head>
<body>
	<div class="container text-center">
	<div class="row">
        <div class="round hollow text-center" style="position: absolute; right: 50px; top: 100px;">
        <a id="addClass" data-userId="1"><span class="glyphicon glyphicon-comment addClass"></span> Open in chat </a>
        </div>
        
        <hr>
        
        
         
	</div>
</div>

<div id="user_login_status">
	
</div>

<div class="popup-box chat-popup" id="qnimate" style="border: 3px solid black;">
    		  <div class="popup-head">
    		  	
				<div class="popup-head-left pull-left">
				</div>
			
					  <div class="popup-head-right pull-right">
						<div class="btn-group">
    								  <button class="chat-header-button" data-toggle="dropdown" type="button" aria-expanded="false">
									   <i class="glyphicon glyphicon-cog"></i> </button>
									  <ul role="menu" class="dropdown-menu pull-right">
										<li><a href="#">Media</a></li>
										<li><a href="#">Block</a></li>
										<li><a href="#">Clear Chat</a></li>
										<li><a href="#">Email Chat</a></li>
									  </ul>
						</div>
						
						<button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"><i class="glyphicon glyphicon-off"></i></button>
                      </div>
			  </div>
			<div class="popup-messages" style="overflow: auto">
    		
			<input type="hidden" name="my_id" id="my_id" value="<?php echo $_SESSION['user_id']; ?>"> 
			<div class="col-md-12" id="messages" style="margin-top: 5px; margin-bottom: 15px;">
		            <div class="message-wrapper">
		                <ul class="messages">
		                    <!-- <li class="message clearfix">
		                        <div class="sent">
		                            <p>Lorem ispum</p>
		                            <p class="date">1 sep 2020</p>
		                        </div>
		                    </li>

		                    <li class="message clearfix">
		                        <div class="received">
		                            <p>Lorem ispum</p>
		                            <p class="date">1 sep 2020</p>
		                        </div>
		                    </li> -->
		                </ul>
		            </div>

		            

		        </div>
			
			
			
			
			
			
			
			
			
			
			
			</div>
			<div class="popup-messages-footer">
			<!-- <textarea id="status_message" placeholder="Type a message..." rows="10" cols="40" name="message"></textarea> -->
			
		                <!-- <input type="submit" name="submit" value="Gửi"> -->
		            
			<div class="btn-footer">
				<div class="input-text col-md-12">
		                <input type="text" name="message" class="submit col-md-9" style="border: 3px solid black;">
		                <input type="submit" name="submit" value="Gửi" class="col-md-2 btn btn-primary" style="margin-left: 10px; margin-top: 9px; width: 100%; height: 100%;">
		        </div>
			<button class="bg_none"><i class="glyphicon glyphicon-film"></i> </button>
			<button class="bg_none"><i class="glyphicon glyphicon-camera"></i> </button>
            <button class="bg_none"><i class="glyphicon glyphicon-paperclip"></i> </button>
			<button class="bg_none pull-right"><i class="glyphicon glyphicon-thumbs-up"></i> </button>
			</div>
			</div>
	  </div>
</body>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	let my_id = $('#my_id').val();
	let user_id = 0;
	let friend_id = 0;
	let chutro_id = 0;
	let friendClass;
	let name = '';
	function openMiniBoxChat(chatWith_id){
		    	$('#qnimate').addClass('popup-box-on');
		    	if(chatWith_id == 1)
		    	{
		    		$('.popup-head-left').html("Chủ trọ");
		    	}
		    	else
		    	{
		    		$('.popup-head-left').html(name);	
		    	}
		    	$.get("ChatRealtime/chatWith/" + chatWith_id, function(data){
		    		$(".messages").html(data);
                	scrollToBottomFunc();
		    	});
	}
	function scrollToBottomFunc() 
	{
		        $('.popup-messages').animate({
		            scrollTop: $('.popup-messages').get(0).scrollHeight
		        }, 100);
	}
	$(document).ready(function(){
		test();
		fetch_user_login_data();

		Pusher.logToConsole = true;

        var pusher = new Pusher('ed3cf9bac608e3b56afa', {
          cluster: 'eu'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
          // alert(JSON.stringify(data));
          // alert(typeof(data["from"]) + data["from"]);
          // alert(typeof(my_id) + my_id);
          if(data["from"] == my_id)
          {
          	if(chutro_id == 1)
          	{
          		$('#addClass').click();	
          	}
          	else
          	{
          		// friendClass.click();
          		$('#' + friend_id).click();
          	}
            
          }
          else if(my_id == data["to"])
          {
            // alert(user_id); // 1
            // alert(my_id);
            if(data["from"] == friend_id)
            {
                $('#' + friend_id).click();
            }
            else
            {
            	if(data["name"] == "qakhudaubuon")
            	{
            		alert("Bạn có tin nhắn mới từ Chủ phòng trọ.");	
            	}
            	else
            	{
            		alert("Bạn có tin nhắn mới từ " + data["name"] + '. Bạn có muốn đi đến trang trò chuyện.');	
            	}
            	
            }
            // else
            // {
            //     var pending = parseInt($("#" + data["from"]).find(".pending").html());
            //     alert(pending);
            //     if(pending)
            //     {
            //         $("#" + data["from"]).find(".pending").html(pending + 1);
            //     }
            //     else
            //     {
            //         $("#" + data["from"]).append('<span class="pending">1</span>');
            //     }
            // }
          }
        });



		// $("#addClass").on('click', function () {
  //         $('#qnimate').addClass('popup-box-on');
  //         $('.popup-head-left').html("Chủ trọ");
  //         user_id = $(this).attr("data-userId");
  //         $.get("ChatRealtime/chatWith/" + 1, function(data){
		// 		$(".messages").html(data);
  //               scrollToBottomFunc();
		// 	});
  //           });
          
            
        

            $(document).on("keyup", ".input-text input", function(e){
		        let message = $(this).val();
		        if(e.keyCode == 13)
		        {
		        	if(chutro_id == 1)
		        	{
		        		enterToSendMessage(message, 1);
		        	}
		        	else
		        	{
		        		enterToSendMessage(message, friend_id);
		        	}
		            
		        }
		    });

		    $('#addClass').on('click', function(){
		    	chutro_id = 1;
		    	openMiniBoxChat(1);
		    });

		    $("#removeClass").click(function () {
          		$('#qnimate').removeClass('popup-box-on');
            });

		    

		    function enterToSendMessage(message, sendto_id){
		    	if(message != '' && sendto_id != '')
		    	{
		    		var dataStr = "received_id=" + sendto_id + "&message=" + message;
			    	$.ajax({
			                        type: "post",
			                        url: "ChatRealtime/sendMessage",
			                        data: dataStr,
			                        cache: false,
			                        success: function(data)
			                        {

			                        },
			                        error: function(jqXHR, status, err)
			                        {

			                        },
			                        complete: function(){
			                            
			                        }
			        });
		    	}
		    	
		    }

		    

		    

		    //update thời gian online
		    function test(){
 			var action = "update_time";
 			var date = new Date().toLocaleString();
 			$.ajax({
 				url: "testAction.php",
 				method: "POST",
 				data: {action: action},
 				success: function(data){
				
 				}
 			});
 			// console.log(date);
 			}

	 		function fetch_user_login_data()
	 		{
	 			var action = "fetch_data";
	 			$.ajax({
	 				url: "testAction.php",
	 				method: "POST",
	 				data: {action: action},
	 				success: function(data){
	 					$('#user_login_status').html(data);
	 				}
	 			});
	 		}

 				setInterval(function(){
 					test();
 				}, 3000);

 				setInterval(function(){
 					fetch_user_login_data();
 				}, 3000);

 				

	});
</script>
</html>




	  