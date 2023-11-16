<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');
	

	if(empty($_POST['nickname'])){
		die('Check');
	}
    $username = $_SESSION['username'];
	$nickname = $_POST['nickname'];

	$sql = "UPDATE users set nickname=? WHERE username=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $nickname, $username);
	$result = $stmt->execute();

	if($result){
		header('Location: ./index.php');
	}else{
		echo "failed";
	}

?>