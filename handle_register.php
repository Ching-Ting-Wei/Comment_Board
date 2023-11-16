<?php
	require_once('./conn.php');
	$nickname = $_POST['nickname'];
	$username = $_POST['username'];
    $password = $_POST['password'];
	
	if(empty($nickname) || empty($password) || empty($username)){
		die('Check');
	}

	$sql = sprintf("INSERT INTO users(nickname, username, password) VALUES('%s', '%s', '%s')", $nickname, $username, $password);
	
	$result = $conn->query($sql);
    
	if(!$result){
        $code = $conn->errno;
        if($code == 1062){
		    header('Location: register.php?errCode=2');
        }
	}else{
		echo "failed";
	}
    header('Location: ./index.php');

?>