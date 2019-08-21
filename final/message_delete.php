<?php
session_start();
include('connect.php');
if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['del']) && !empty($_GET['del'])){
	if(isset($_SESSION['name'])){
        $sth = $dbh->prepare('SELECT owner_name FROM message WHERE owner_name = ? AND id = ?');
        $sth->execute(array($_SESSION['name'], $_GET['del']));
        if($sth->rowCount() != 0){
            $sth = $dbh->prepare('DELETE FROM message WHERE id = ?');
			$sth->execute(array($_GET['del']));
			echo '<meta http-equiv="refresh" content="0; url=message.php?id='.$_GET['id'].'">';
        }else{
        	echo '<meta http-equiv="refresh" content="0; url=message.php?id='.$_GET['id'].'">';
        }
    }else{
    	echo '<script>history.back()</script>';
    }
}else{
	echo '<script>history.back()</script>';
}
?>