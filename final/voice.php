<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if(isset($_POST['voice']) && ($_POST['voice'] === '1' || $_POST['voice'] === '0')){
		$_SESSION['voice'] = $_POST['voice'];
		echo $_SESSION['voice'];
}else{
	if(isset($_SESSION['voice'])){
	    echo $_SESSION['voice'];
	}else{
		echo '1';
	}
}
?>