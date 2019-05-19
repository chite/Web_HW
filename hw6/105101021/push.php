<?php
	session_start();
	include('connectsql.php');
	$session = empty($_SESSION['account'])? null: $_SESSION['account'];
	if($session === null){
		echo "<script>alert('尚未登入，前往登入畫面')</script>";
       die('<meta http-equiv=REFRESH CONTENT=0;url=hw6.php>');
	}else{
		if(isset($_POST['textarea']) && !empty($_POST['textarea']) && isset($_POST['id'])){
			$sql = "SELECT id FROM topic WHERE id = ?";
			$sth = $dbh->prepare($sql);
			$sth->execute(array($_POST['id']));
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			if($sth->rowCount() != 1){
				echo "<script>alert('主題不存在')</script>";
	        	die('<meta http-equiv=REFRESH CONTENT=0;url=talk.php?id='.$_POST['id'].'>');
			}
			$chatTime = !empty($_SESSION['time'])? $_SESSION['time']: null;
			if($chatTime != null){
				$chatTime2 = time();
				if(($chatTime2 - $chatTime) < 10){
					echo "<script>alert('請於十秒後再繼續留言')</script>";
					die('<script>history.back();</script>');
				}else{
					$_SESSION['time'] = $chatTime2;
					$chatTime = $chatTime2;
				}
			}else{
				$_SESSION['time'] = time();
				$chatTime = $_SESSION['time'];
			}

			$text = htmlspecialchars($_POST['textarea']);
    		$text = str_replace("\n", "<br/>", $text);
			$sth = $dbh->prepare('SELECT name, password FROM account WHERE account = ?');
			$sth->execute(array($_SESSION['account']));
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			if($row['password'] == $_SESSION['pwd']){
				$query = "INSERT INTO message (name, password, content, belong) VALUES (?, ?, ?, ?)";
				$statement = $dbh->prepare($query);
				$statement->execute(array($row['name'], $_SESSION['pwd'], $text, $_POST['id']));
	            echo '<meta http-equiv=REFRESH CONTENT=0;url=talk.php?id='.$_POST['id'].'>';
	        }else{
	        	echo "<script>alert('尚未登入，前往登入畫面')</script>";
	            echo '<meta http-equiv=REFRESH CONTENT=0;url=hw6.php>';
	        }
		}else{
			echo "<script>alert('輸入錯誤')</script>";
	        echo '<meta http-equiv=REFRESH CONTENT=0;url=talk.php?id='.$_POST['id'].'>';
		}
	}
?>