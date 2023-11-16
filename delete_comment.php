<?php
	session_start();
	require_once('conn.php');
	require_once('utils.php');
	

	if(empty($_GET['id'])){
		die('Check');
	}
    $id = $_GET['id'];

	$sql = "DELETE from comments WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $id);
	$result = $stmt->execute();

	if($result){
		header('Location: ./index.php');
	}else{
		echo "failed";
	}

?>