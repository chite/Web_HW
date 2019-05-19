<?php
	session_start();
	include('connectsql.php');
	if(isset($_POST['account']) && isset($_POST['password']) && !empty($_POST['account']) && !empty($_POST['password'])){
		$acc = $_POST['account'];
		$pwd = hash('sha256', $_POST['password']);
		$sth = $dbh->prepare('SELECT account, password FROM account WHERE account = ?');
		$sth->execute(array($acc));
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		if($row['password'] == $pwd){
			$_SESSION['account'] = $row['account'];
            $_SESSION['pwd'] = $row['password'];
            echo "<script>alert('登入成功，前往看板')</script>";
            die('<meta http-equiv=REFRESH CONTENT=0;url=board.php>');
		}else{
			echo "<script>alert('登入失敗')</script>";
			echo '<meta http-equiv=REFRESH CONTENT=0;url=hw6.php>';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" >
    <title>Log in</title>
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
        border: none;
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
    <form method="post" action="hw6.php">
        <h4>請輸入帳密</h4>
        <label for="account">帳號</label>
        <input type="text" name="account" id="account" required>
        <label for="password">密碼</label>
        <input type="password" name="password" id="password" >
        <input type="submit" value="確認">
        <span><a href="register.php">註冊帳密</a></span>
        <span><a href="board.php">直接前往看板</a></span>
    </form>
</body>

</html>