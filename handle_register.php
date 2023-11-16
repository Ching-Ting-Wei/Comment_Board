<?php
	session_start();
	require_once('./conn.php');
	$nickname = $_POST['nickname'];
	$username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	
	if(empty($nickname) || empty($password) || empty($username)){
		die('Check');
	}

	$sql = "INSERT INTO users(nickname, username, password) VALUES(?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sss", $nickname, $username, $password);
	$result = $stmt->execute();
    
	if(!$result){
        $code = $conn->errno;
        if($code == 1062){
		    header('Location: register.php?errCode=2');
        }
	}else{
		echo "failed";
	}
	$_SESSION['username'] = $username;
    header('Location: ./index.php');

?>