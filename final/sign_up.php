<?php
session_start();
if(isset($_SESSION['name']) && isset($_SESSION['password']) && !empty($_SESSION['name']) && !empty($_SESSION['password'])){
	unset($_SESSION['name'], $_SESSION['password']);
	echo '<meta http-equiv="refresh" content="0; url=login1.php">';
}
?>