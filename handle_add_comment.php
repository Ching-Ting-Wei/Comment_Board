<?php
	require_once('./conn.php');
	require_once('utils.php');
	$user = getUserFromToken($_COOKIE['token']);
	$nickname = $user['nickname'];
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