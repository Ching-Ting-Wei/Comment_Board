<?php
	require_once('./conn.php');
	
	$username = $_COOKIE['username'];
	$user_sql = sprintf('SELECT nickname FROM users WHERE username="%s"', $username);
	$user_result = $conn->query($user_sql);
	$row = $user_result->fetch_assoc();

	$nickname = $row['nickname'];
	$content = $_POST['content'];

	if(empty($content)){
		die('Check');
	}

	$sql = sprintf("INSERT INTO comments(nickname, content) VALUES('%s', '%s')", $nickname, $content);
	$result = $conn->query($sql);

	if($result){
		header('Location: ./index.php');
	}else{
		echo "failed";
	}

?>