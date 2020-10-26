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