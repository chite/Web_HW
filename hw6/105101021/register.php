<?php
	session_start();
	include('connectsql.php');
	if(isset($_POST['name']) && isset($_POST['account']) && isset($_POST['password']) && !empty($_POST['name']) && !empty($_POST['account']) && !empty($_POST['password'])){
		$name = $_POST['name'];
		$acc = $_POST['account'];
		$pwd = hash('sha256', $_POST['password']);

		$sth = $dbh->prepare('SELECT password FROM account WHERE account = ? OR password = ?');
		$sth->execute(array($acc, $pwd));
		if($sth->rowCount() >= 1){
			echo "<script>alert('帳號或密碼重複，請重新輸入')</script>";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=register.php>';
		}else{
			$_SESSION['account'] = $acc;
            $_SESSION['pwd'] = $pwd;
            $sth = $dbh->prepare('INSERT INTO account (name, account, password) VALUES (?, ?, ?)');
            $sth->execute(array($name, $acc, $pwd));
			echo "<script>alert('註冊成功，前往看板')</script>";
			echo '<meta http-equiv=REFRESH CONTENT=0;url=board.php>';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" >
	<title>Register</title>
    <style type="text/css">
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        background: linear-gradient(to top, red, black);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    form {
        padding: 2em;
        background-color: rgba(205, 205, 205, 0.5);
        border-radius: 1em;
    }

    label {
        display: block;
        margin-top: 1em;
    }

    input[type="text"], input[type="password"] {
        margin-top: 0.5em;
        display: block;
    }

    span {
        color: blue;
        font-size: 0.7em;
        margin-left: 0.5em;
        text-decoration: underline;
    }

    input[type="submit"] {
    	margin-top: 1em;
        background: #FF8500;
        border-radius: 0.5em;
        color: white;
        font-size: 1em;
        padding: 0.5em;
        border: none;
    }
    </style>
</head>

<body>
    <form method="post" action="register.php">
        <h4>註冊帳密</h4>
        <label for="name">姓名</label>
        <input type="text" name="name" id="name" required>
        <label for="account">帳號</label>
        <input type="text" name="account" id="account" required>
        <label for="password">密碼</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="確認">
    </form>
</body>
</html>