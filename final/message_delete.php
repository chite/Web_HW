<?php
session_start();
include('connect.php');
if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['del']) && !empty($_GET['del'])){
	//DELETE FROM songrank WHERE this_rank > 100
	$sth = $dbh->prepare('DELETE FROM message WHERE id = ?');
	$sth->execute(array($_GET['del']));
	echo '<meta http-equiv="refresh" content="0; url=message.php?id='.$_GET['id'].'">';
}
?>