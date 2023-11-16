<?php
	session_start();
	require_once('./conn.php');
	require_once('utils.php');
	$username = $_SESSION['username'];
	$content = $_POST['content'];

	if(empty($content)){
		die('Check');
	}

	$sql = "INSERT INTO comments(username, content) VALUES(?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $username, $content);
	$result = $stmt->execute();

	if($result){
		header('Location: ./index.php');
	}else{
		echo "failed";
	}

?>