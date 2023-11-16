<?php
	require_once('./conn.php');
	$username = $_POST['username'];
    $password = $_POST['password'];
	
	if(empty($password) || empty($username)){
		die('Check');
	}

	$sql = sprintf("SELECT * FROM users WHERE username='%s' and password='%s'",$username, $password);
	
	$result = $conn->query($sql);
    
    if($result->num_rows > 0){
        $expire = time() + 3600 * 24;
        setcookie("username", $username, $expire);
        header("Location: index.php");
    }else{
        header('Location: ./login.php?errCode=2');
    }
    

?>