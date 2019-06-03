<?php
	if(isset($_POST['position'])){
		$position = explode(',', $_POST['position']);
		if ($position[0] > 24.987710 && $position[0] < 24.988657 && $position[1] > 121.576736 && $position[1] < 121.577608){
			echo '莊外';
		}else{
			echo '這裡目前很乾淨，沒有冤魂存在，至少現在是這樣，晚點再回來看看吧';
		}
	}else{
		echo 'No';
	}
?>