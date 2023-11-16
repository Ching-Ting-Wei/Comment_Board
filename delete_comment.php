<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');
	

	if(empty($_GET['id'])){
		die('Check');
	}
    $id = $_GET['id'];
    $username = $_SESSION['username'];
	$sql = "DELETE from comments WHERE id=? and username=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("is", $id, $username);
	$result = $stmt->execute();

	if($result){
		header('Location: ./index.php');
	}else{
		echo "failed";
	}

?>