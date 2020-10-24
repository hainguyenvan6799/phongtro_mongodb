<?php 
	require_once "./mvc/core/vendor/autoload.php";
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$timestamp = strtotime(date("Y-m-d H:i:s"));
	$time = $timestamp - 5;
	$datetime = date("Y-m-d H:i:s", $time);


	$userCollection = (new MongoDB\Client)->phongtrodb->users;
	function time_elapsed_B($secs){
    $bit = array(
        ' năm'        => $secs / 31556926 % 12,
        ' tuần'        => $secs / 604800 % 52,
        ' ngày'        => $secs / 86400 % 7,
        ' giờ'        => $secs / 3600 % 24,
        ' phút'    => $secs / 60 % 60,
        ' giây'    => $secs % 60
        );
       
    foreach($bit as $k => $v){
        if($v > 1)$ret[] = $v . $k ;
        if($v == 1)$ret[] = $v . $k;
        }
    array_splice($ret, count($ret)-1, 0, 'and');
    $ret[] = 'trước.';
   
    return join(' ', $ret);
    }
	if($_POST["action"] == "update_time")
	{
		$userCollection->updateOne(
			['username' => $_SESSION["username"]],
			['$set' => ["last_login" => date("Y-m-d H:i:s")]]
		);
	}

	if($_POST["action"] == "fetch_data")
	{
		$users = $userCollection->find(
			// ["last_login" => ['$gt' => $time]]
		);
		foreach($users as $u)
		{
			if(strtotime($u->last_login) > $time)
			{
				// echo $u->last_login . '--' . $datetime . '<br>';
				echo $u->username . 'đang online';
				echo '<br>';
				echo '---------';
			}
			else
			{
				$distance = $timestamp - strtotime($u->last_login);
				echo $timestamp . '<br>';
				echo $time . '<br>';
				echo $distance . '<br>';
				echo $u->username . ' đã hoạt động ' . time_elapsed_B($timestamp - strtotime($u->last_login)) . '<br>';
			}
			
		}

	}
 ?>