<?php
    session_start();
	require_once('conn.php');
    require_once('utils.php');
	$username = $_POST['username'];
    $password = $_POST['password'];
	
	if(empty($username)){
		die('Check');
	}

	$sql = sprintf("SELECT * FROM users WHERE username='%s'",$username);
	
	$result = $conn->query($sql);
    if($result->num_rows === 0){
        header('Location: ./login.php?errCode=2');
        exit();
    }

    $row = $result->fetch_assoc();
    if(password_verify( $password, $row['password'])){
        $_SESSION["username"] = $username;
        header("Location: index.php");
    }else{
        header('Location: ./login.php?errCode=2');
    }

   
    

?>