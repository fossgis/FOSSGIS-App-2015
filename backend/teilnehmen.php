<?php

	ini_set('display_errors', '1');
	error_reporting(E_ALL | E_STRICT);

	require_once('config.php');
	
	$title = (string)$_GET['title'];
	
	//$title = utf8_encode($title);
	//echo $title;
	
	$sql1 = "SELECT participants FROM Speech WHERE title LIKE '%".$title."%'";
	
	$participants = mysqli_query($connection, $sql1);
	
	while ($row = mysqli_fetch_array($participants)){
		$part = (int)$row[0];
		$part = $part+1;
		$sql = "UPDATE Speech SET participants = '".$part."' WHERE title LIKE '%".$title."%'";
		$result = mysqli_query($connection, $sql);
	}
	//$part = (int)$participants + 1;
	
	//$sql = "UPDATE Speech SET participants = '".$part."' WHERE title LIKE '%".$title."%'";
	
	//$result = mysqli_query($connection, $sql);
	
	setcookie('title', $title, strtotime("+1 month"));
	
	$cookie = (string)$_COOKIE['title'];
	$list = $cookie.','.$title;
    $_COOKIE['title'] = $list;
	
	header("Location: ../frontend/index.html");
	exit();
	
	
	//----------
	//UPDATE Speech SET participants = '0' WHERE title LIKE 'ErÃ¶ffnung%';
	//SELECT participants FROM Speech WHERE title LIKE 'ErÃ¶ffnung%';
	
?>

	

	
