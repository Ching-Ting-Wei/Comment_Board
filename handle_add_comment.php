<?php
	require_once('./conn.php');
	$nickname = $_POST['nickname'];
	$content = $_POST['content'];
	
	if(empty($nickname) || empty($content)){
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