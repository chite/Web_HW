<?php
session_start();
if(isset($_POST['id']) && isset($_POST['success_edit']) && !empty($_POST['id']) && !empty($_POST['success_edit'])){	
	if($_SESSION['name'] == 'chite'){//管理員
		include('connect.php');
		$content = str_replace("\n", "<br/>", htmlspecialchars($_POST['success_edit']));
		$sth = $dbh->prepare('UPDATE board SET response = ? WHERE id = ?');
		$sth->execute(array($content, $_POST['id']));
		echo '<meta http-equiv="refresh" content="0; url=message.php?id='.$_POST['id'].'">';
	}else{
		echo '<meta http-equiv="refresh" content="0; url=message.php?id='.$_POST['id'].'">';
	}
}else{
		echo '<meta http-equiv="refresh" content="0; url=message.php?id='.$_POST['id'].'">';
}
?>