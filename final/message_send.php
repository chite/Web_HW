<?php
session_start();
include('connect.php');
if(isset($_POST['id']) && isset($_POST['content']) && !empty($_POST['id']) && !empty($_POST['content'])){
	$sql = 'SELECT id FROM account WHERE name = ?';
	$sth = $dbh->prepare($sql);
	$sth->execute(array($_SESSION['name']));
	$sth1 = $dbh->prepare('SELECT id FROM board WHERE id = ?');
	$sth1->execute(array($_POST['id']));
	if($sth->rowCount() > 0 && $sth1->rowCount() > 0){ //存在此用戶和主題
		ini_set('date.timezone','Asia/Taipei');
		$time = strftime("%Y-%m-%d %X");
		$content = str_replace("\n", "<br/>", htmlspecialchars($_POST['content']));
		$belong = htmlspecialchars($_POST['id']);
		$sql = 'INSERT INTO message (owner_name, content, belong, time) VALUES (?, ?, ?, ?)';
		$sth = $dbh->prepare($sql);
		$sth->execute(array($_SESSION['name'], $content, $belong, $time));
		echo '<meta http-equiv="refresh" content="0; url=message.php?id='.$_POST['id'].'">';
	}else{
		echo "<script>alert('不存在')</script>";
	    die('<meta http-equiv="refresh" content="0; url=message.php?id='.$_POST['id'].'">');
	}
}else{
	    die('<meta http-equiv="refresh" content="0; url=message.php?id='.$_POST['id'].'">');
	}

?>