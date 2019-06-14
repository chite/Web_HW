<?php
session_start();
include('connect.php');
//-------登入-------------
if(isset($_POST['name']) && isset($_POST['password']) && $_POST['name'] !== '' && $_POST['password'] !== ''){ 
	$name = preg_replace("/\s+/", '',  htmlspecialchars($_POST['name']));
	$password = preg_replace("/[^A-Za-z0-9]/", '', $_POST['password']);
	if($name !== '' && $password !== ''){
		$password = hash('sha256', $password);//加密
		$sth = $dbh->prepare('SELECT id FROM account WHERE name = ? AND password = ?');
        $sth->execute(array($name, $password));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if($sth->rowCount() >= 1){ //有帳密
        	$_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            echo '<script>alert(\'輸入成功，前往遊戲\')</script>';
			die('<meta http-equiv="refresh" content="0; url=map1.php">');
        }else{
        	echo '<script>alert(\'輸入錯誤\')</script>';
			die('<meta http-equiv="refresh" content="0; url=login1.php">');
        }
	}else{
		echo '<script>alert(\'輸入錯誤\')</script>';
		die('<meta http-equiv="refresh" content="0; url=login1.php">');
	}
//----------註冊----------
}elseif(isset($_POST['reg_name']) && isset($_POST['reg_password']) && isset($_POST['reg_password2']) && isset($_POST['reg_mail']) && $_POST['reg_name'] !== '' && $_POST['reg_password'] !== '' && $_POST['reg_password2'] !== '' && $_POST['reg_mail'] !== ''){ 
	$name = preg_replace("/[^A-Za-z0-9]/", '', $_POST['reg_name']);
	$mail =  htmlspecialchars($_POST['reg_mail']);
	$password = preg_replace("/[^A-Za-z0-9]/", '', $_POST['reg_password']);
	$password2 = preg_replace("/[^A-Za-z0-9]/", '', $_POST['reg_password2']);
	if($password !== $password2){ //密碼驗證錯誤
		echo '<script>alert(\'密碼認證不正確\')</script>';
		die('<meta http-equiv="refresh" content="0; url=login1.php">');
	}	
	if(isset($_FILES['reg_file'])){	//如果上傳頭貼
		$extension = explode(".", $_FILES["reg_file"]["name"]);
		$extension =  strtolower(end($extension));
		if(in_array($extension, array('jpeg', 'jpg', 'png'))){
			$reg_file = file_get_contents($_FILES["reg_file"]["tmp_name"]); // 把整个文件读入一个字符串
		}else{
			$reg_file = 1;
    	}
	}else{
		$reg_file = 1;
	}
	
	if($name !== '' && $password !== ''){
		$password = hash('sha256', $password);//加密

		$sth = $dbh->prepare('SELECT id FROM account WHERE name = ? OR password = ?');
        $sth->execute(array($name, $password));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if($sth->rowCount() >= 1){ //密碼重複
			echo '<script>alert(\'用戶名稱或密碼與他人重複，請重新輸入\')</script>';
            die('<meta http-equiv="refresh" content="0; url=login1.php">') ;
		}else{
			$_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $sth = $dbh->prepare('INSERT INTO account (name, password, mail, img, img_name) VALUES (?, ?, ?, ?, ?)');
            $sth->execute(array($name, $password, $mail, $reg_file, $extension));
			echo "<script>alert('註冊成功，前往遊戲')</script>";
			echo '<meta http-equiv="refresh" content="0; url=map1.php">';
		}
	}
//------------忘記密碼---------------------
}elseif(isset($_POST['forget_name']) && $_POST['forget_name'] !== '' && isset($_POST['forget_password']) && $_POST['forget_password'] !== '' && isset($_POST['forget_mail']) && $_POST['forget_mail'] !== ''){ 
	$name = preg_replace("/[^A-Za-z0-9]/", '', $_POST['forget_name']);
	$password = preg_replace("/[^A-Za-z0-9]/", '', $_POST['forget_password']);
	$mail =  htmlspecialchars($_POST['forget_mail']);
	
	if($name !== '' && $password !== ''){
		$password = hash('sha256', $password);//加密
		$sth = $dbh->prepare('SELECT id FROM account WHERE name = ? AND mail = ?');
		$sth->execute(array($name, $mail));
	    $row = $sth->fetch(PDO::FETCH_NUM);
	    if($sth->rowCount() >= 1){
	    	$sth = $dbh->prepare('UPDATE account SET password = ? WHERE id = ?');
	    	$sth->execute(array($password, $row[0]));
	    	echo '<script>alert(\'密碼修改成功，請重新登入以進入遊戲\')</script>';
	        die('<meta http-equiv="refresh" content="0; url=login1.php">') ;
	    }else{
	    	echo '<script>alert(\'此用戶不存在，請重新輸入\')</script>';
	        die('<meta http-equiv="refresh" content="0; url=login1.php">') ;
	    }
	}
	

//------------輸入錯誤---------------------
}else{
	echo '<script>alert(\'輸入錯誤\')</script>';
	echo '<meta http-equiv="refresh" content="0; url=login1.php">';
}

?>