<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');
	

	if(empty($_POST['content'])){
		die('Check');
	}
    $username = $_SESSION['username'];
    $id = $_POST['id'];
    $content = $_POST['content'];

	$sql = "UPDATE comments set content=? WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("si", $content, $id);
	$result = $stmt->execute();

	if($result){
		header('Location: ./index.php');
	}else{
		echo "failed";
	}

?>