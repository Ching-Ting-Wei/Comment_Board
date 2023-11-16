<?php
	session_start();
	require_once('./conn.php');
	require_once('utils.php');
	$user = getUserFromUsername($_SESSION['username']);
	$nickname = $user['nickname'];
	$content = $_POST['content'];

	if(empty($content)){
		die('Check');
	}

	$sql = "INSERT INTO comments(nickname, content) VALUES(?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $nickname, $content);
	$result = $stmt->execute();

	if($result){
		header('Location: ./index.php');
	}else{
		echo "failed";
	}

?>