<?php
session_start();
include('connectsql.php');
$session = empty($_SESSION['pwd'])? null: $_SESSION['pwd'];
if($session !== null && isset($_GET['id'])){
	$sth = $dbh->prepare('SELECT manager FROM account WHERE password = ?');
	$sth->execute(array($session));
	$manager = $sth->fetch(PDO::FETCH_ASSOC);

	$sth = $dbh->prepare('SELECT password FROM message WHERE id = ?');
	$sth->execute(array($_GET['id']));
	$messagePwd = $sth->fetch(PDO::FETCH_ASSOC);
	if($manager['manager'] == '1' || $messagePwd['password'] == $session){
		$sql = 'DELETE FROM message WHERE id = ?';
		$sth = $dbh->prepare($sql);
		$sth->execute(array($_GET['id']));
		echo '<script>alert(\'刪除成功\')</script>';
		echo '<script>history.back();</script>';
	}
}

?>