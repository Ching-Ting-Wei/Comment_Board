<?php
    session_start();
	require_once('conn.php');
    require_once('utils.php');
	$username = $_POST['username'];
    $password = $_POST['password'];
	
	if(empty($password) || empty($username)){
		die('Check');
	}

	$sql = sprintf("SELECT * FROM users WHERE username='%s' and password='%s'",$username, $password);
	
	$result = $conn->query($sql);
    
    if($result->num_rows > 0){
        $_SESSION["username"] = $username;
        header("Location: index.php");
    }else{
        header('Location: ./login.php?errCode=2');
    }
    

?>