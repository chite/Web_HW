<?php
session_start();
include('connect.php');
if(isset($_SESSION['name'])){ //確認有此帳戶存在
	$sth = $dbh->prepare('SELECT id FROM account WHERE name = ?');
	$sth->execute(array($_SESSION['name']));
	$row = $sth->fetch(PDO::FETCH_ASSOC);
    if($sth->rowCount() == 0){
    	die('<meta http-equiv="refresh" content="0; url=profile.php">') ;
    } 
}else{
	die('<meta http-equiv="refresh" content="0; url=profile.php">') ;
}

//上傳頭貼
if(isset($_FILES['img']) && $_FILES['img']['size'] != 0){
	if($_FILES["img"]["size"]/1024 > 100){
		echo '<script>alert(\'檔案過大，請上傳小於100KB的頭貼\')</script>';
		die('<meta http-equiv="refresh" content="0; url=profile.php">');
	}
	$extension = explode(".", $_FILES["img"]["name"]);
	$extension =  strtolower(end($extension));
	if(in_array($extension, array('jpeg', 'jpg', 'png'))){
		$img = file_get_contents($_FILES["img"]["tmp_name"]); // 把整个文件读入一个字符串

		$sth = $dbh->prepare('UPDATE account SET img = ?, img_name = ? WHERE name = ?');
        $sth->execute(array($img, $extension, $_SESSION['name']));
        echo '<script>alert(\'更換頭貼成功\')</script>';
	    die('<meta http-equiv="refresh" content="0; url=profile.php">') ;
	}else{
		echo '<script>alert(\'更換頭貼錯誤\')</script>';
	    die('<meta http-equiv="refresh" content="0; url=profile.php">') ;
	}
}


if(isset($_POST['new']) && isset($_POST['password']) && isset($_POST['page']) && !empty($_POST['new']) && !empty($_POST['password']) && ($_POST['page'] === '0' || $_POST['page'] === '1' || $_POST['page'] === '2')){
	$new = preg_replace("/\s+/", '',  htmlspecialchars($_POST['new']));
	$password = preg_replace("/[^A-Za-z0-9]/", '', $_POST['password']);
	if($_POST['page'] == 2){ //修改密碼
		if($new === $password){
			$password = hash('sha256', $password);
			$sth = $dbh->prepare('SELECT id FROM account WHERE password = ?');
	        $sth->execute(array($password));
	        if($sth->rowCount() >= 1){ //密碼重複
				echo '<script>alert(\'密碼與他人重複，請重新輸入\')</script>';
	            die('<meta http-equiv="refresh" content="0; url=profile.php">') ;
			}else{ //修改密碼成功
				$sth = $dbh->prepare('UPDATE account SET password = ? WHERE name = ?');
				$sth->execute(array($password, $_SESSION['name']));
				$_SESSION['password'] = $password;
				echo '<script>alert(\'修改密碼成功\')</script>';
	            die('<meta http-equiv="refresh" content="0; url=profile.php">') ;
			}
		}else{
			echo '<script>alert(\'密碼驗證錯誤\')</script>';
            die('<meta http-equiv="refresh" content="0; url=profile.php">') ;
		}
	}elseif($_POST['page'] == 0){ //修改信箱
		$sth = $dbh->prepare('UPDATE account SET mail = ? WHERE name = ?');
		$sth->execute(array($new, $_SESSION['name']));
		echo '<script>alert(\'修改信箱成功\')</script>';
        die('<meta http-equiv="refresh" content="0; url=profile.php">') ;
	}elseif($_POST['page'] == 1){	//修改名稱
		$sth = $dbh->prepare('SELECT id FROM account WHERE name = ?');
        $sth->execute(array($new));
        if($sth->rowCount() >= 1){ //名稱重複
        	echo '<script>alert(\'用戶名稱與他人重複，請重新輸入\')</script>';
	        die('<meta http-equiv="refresh" content="0; url=profile.php">') ;
        }else{
        	$old_name = $_SESSION['name'];
        	$sth = $dbh->prepare('UPDATE account SET name = ? WHERE name = ?');
			$sth->execute(array($new, $old_name));
			$_SESSION['name'] = $new;
			echo '<script>alert(\'修改名稱成功\')</script>';
	        die('<meta http-equiv="refresh" content="0; url=profile.php">') ;
        }	
	}else{
		echo '<script>alert(\'錯誤\')</script>';
	    die('<meta http-equiv="refresh" content="0; url=profile.php">') ;
	}
}else{
	echo '<script>alert(\'修改錯誤\')</script>';
	die('<meta http-equiv="refresh" content="0; url=profile.php">') ;
}
?>