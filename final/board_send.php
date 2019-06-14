<?php
session_start();
include('connect.php');
if(isset($_POST['title']) && isset($_POST['content']) && isset($_POST['belong']) && !empty($_POST['title']) && !empty($_POST['content'])){
	$sql = 'SELECT id FROM account WHERE name = ?';
	$sth = $dbh->prepare($sql);
	$sth->execute(array($_SESSION['name']));
	if($sth->rowCount() > 0){ //存在此用戶
		$title = htmlspecialchars($_POST['title']);
		$content = str_replace("\n", "<br/>", htmlspecialchars($_POST['content']));
		$belong = htmlspecialchars($_POST['belong']);
		$sql = 'INSERT INTO board (title, content, owner_name, belong) VALUES (?, ?, ?, ?)';
		$sth = $dbh->prepare($sql);
		$sth->execute(array($title, $content, $_SESSION['name'], $belong));
		echo '<meta http-equiv="refresh" content="0; url=board.php">';
	}else{
		echo "<script>alert('不存在')</script>";
	    die('<meta http-equiv="refresh" content="0; url=board.php">');
	}
}
?>