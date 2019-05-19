<?php
	session_start();
	if(isset($_GET['log'])){
		if($_GET['log'] === '1'){
			echo '<meta http-equiv=REFRESH CONTENT=0;url=hw6.php>';
		}else{
			session_destroy();
			echo '<script>history.back();</script>';
		}
	}else{
		 echo '<script>history.back();</script>';
	}
?>