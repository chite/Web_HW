<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" >
	<title>profile</title>
	<style type="text/css">
		body {
			background-color: rgb(177, 255, 117);
			margin: 0;
	        padding: 0;
	        height: 100%;
		}
		nav {
	        height: 3.5em;
	        background-color: gray;
	        text-align: right;
	        padding-top: 1em;
	    }
	    span>a {
	    	text-decoration: none;
	    	font-size: 1.3em;
	    	margin-right: 1em;
	    	color: white;
    	}
    	span>a:hover {
	    	color: rgba(255, 255, 255, 0.5);
	    }
	    section {
	        padding: 2em;
	        background-color: rgba(205, 205, 205, 0.5);
	        border-radius: 1em;
	        position: absolute;
	        top: 50%;
	        left: 50%;
	        transform: translate(-50%, -50%);
	    }
		section h2 {
			text-align: center;
		}
		article p {
			white-space: nowrap;
		}
	    label {
	        display: block;
	        margin-top: 1em;
	    }

	    input[type="text"], input[type="password"], select {
	    	font-size: 1em;
	        margin-top: 0.5em;
	        display: block;
	        border: none;
	        padding: 0.2em;
	    }
	    form {
	    	display: none;
	    }
	    form p {
	    	color: red;
	    	font-size: 0.7em;
	    	visibility: hidden;
	    }

	    input[type="submit"], button {
	    	display: block;
	    	margin: 0.5em auto;
	        background: #FF8500;
	        border-radius: 0.5em;
	        color: white;
	        font-size: 1em;
	        padding: 0.5em;
	        border: none;
	    }
	    button:disabled {
			background: #B85F00;
			color: rgba(255, 255, 255, 0.3);
	    }
	</style>
</head>
<body>
	<nav>
		<span><a href="board.php">回到看板</a></span>
	</nav>
	<section>
		<article>
			<?php
			session_start();
			$acc = !empty($_SESSION['account'])?$_SESSION['account']: null;
			$pwd = !empty($_SESSION['pwd'])?$_SESSION['pwd']: null;
			if($acc == null || $pwd == null){
				die('您尚未登入，<a href=\'hw6.php\'>請點此</a>進行登入');
			}
			include('connectsql.php');
			$sql = "SELECT name, account, password, id FROM account WHERE account = ? AND password = ?";
			$sth =  $dbh->prepare($sql);
			$sth->execute(array($acc, $pwd));
			$row = $sth->fetch(PDO::FETCH_ASSOC); 

			if($sth->rowCount() != 1){
				die('您尚未登入，<a href=\'hw6.php\'>請點此</a>進行登入');
			}else{
				echo '<h2>'.$row['name'].'</h2><p>帳號：'.$row['account'].'</p><p>密碼：（保密）</p><button id="change">更改資料</button><button id="updateManager" disabled>管理員</button>';
			}
			//修改個資
			if(isset($_POST['name']) || isset($_POST['account']) || isset($_POST['password']) || isset($_POST['password2'])){
				if((empty($_POST['name']) || empty($_POST['account']) || $_POST['password'] !== $_POST['password2'])){
					echo '<script>alert(\'更改資料錯誤\')</script>';
				}else{
					if(empty($_POST['password']) != true){
						$sql = 'SELECT password FROM account WHERE account = ? OR password = ?';
						$sth =  $dbh->prepare($sql);
						$sth->execute(array($_POST['account'], hash('sha256', $_POST['password']))); 
						if($sth->rowCount() >= 2){
							echo '<script>alert(\'帳號或密碼重複，請設置新密碼\')</script>';
							die('<meta http-equiv=REFRESH CONTENT=0;url=profile.php>');
						}
					}
					$pwd2 = empty($_POST['password'])? $row['password']: hash('sha256', $_POST['password']);
					$sql = 'UPDATE account SET name = ?, account = ?, password = ? WHERE id = ?';
					$sth =  $dbh->prepare($sql);
					$sth->execute(array($_POST['name'], $_POST['account'], $pwd2, $row['id']));
					$_SESSION['account'] = $_POST['account'];
					$_SESSION['pwd'] =  $pwd2;
					echo '<script>alert(\'更改資料成功\')</script>';
					echo '<meta http-equiv=REFRESH CONTENT=0;url=profile.php>';
				}
			}
			//更動管理員
			if(isset($_POST['updateManager']) && isset($_POST['newAcc'])){
				if(isset($_SESSION['pwd'])){ 
			    	$sql = 'SELECT manager FROM account WHERE password = ?';
					$sth = $dbh->prepare($sql);
					$sth->execute(array($_SESSION['pwd']));
					$manager = $sth->fetch(PDO::FETCH_ASSOC);
					$manager = $manager['manager'];
					if($manager != '1'){
						die('<meta http-equiv=REFRESH CONTENT=0;url=profile.php>');
					}
				}
				$sql = 'SELECT id FROM account WHERE account = ?';
				$sth = $dbh->prepare($sql);
				$sth->execute(array($_POST['newAcc']));
				$newManager = $sth->fetch(PDO::FETCH_ASSOC);
				if($sth->rowCount() == 1){
					$sql = 'UPDATE account SET manager = ? WHERE id = ?';
					$sth = $dbh->prepare($sql);
					if($_POST['updateManager'] == 'add'){
						$sth->execute(array('1', $newManager['id']));
					}else{
						$sth->execute(array('0', $newManager['id']));
					}
					echo '<script>alert(\'任免管理員成功\')</script>';
					echo '<meta http-equiv=REFRESH CONTENT=0;url=profile.php>';
				}else{
					echo '<script>alert(\'任免管理員失敗\')</script>';
				}
			}
			?>
		</article>
		<form method="post" action="profile.php" id="changeForm">
			<label for="account">更改姓名</label>
	        <input type="text" name="name" id="name">
	        <label for="account">更改帳號</label>
	        <input type="text" name="account" id="account">
	        <label for="password">更改密碼</label>
	        <input type="password" name="password" id="password">
	        <label for="password">確認密碼</label>
	        <input type="password" name="password2" id="password2">
	        <p>*密碼不符合</p>
	        <input type="submit" value="確認">
	    </form>
	    <form method="post" action="profile.php" id="updateForm">
	    	<select name='updateManager'>
	    		<option value="add">新增管理員</option>
	    		<option value="del">刪除管理員</option>
	    	</select>
	    	<label for="newAcc">管理員帳號</label>
	    	<input type="text" name="newAcc" id="newAcc" placeholder="欲新增或刪除的管理員帳號">
	    	<input type="submit" value="確認">
	    </form>

    </section>
    <script type="text/javascript">
    	let change = document.getElementById('change');
    	let change2 = document.getElementById('updateManager');
    	let article = document.querySelector('article');
    	let form = document.querySelector('#changeForm');
    	let form2 = document.querySelector('#updateForm');
    	let changeName = document.querySelector('input[name=\'name\']');
    	let changeAccount = document.querySelector('input[name=\'account\']');
    	let changePassword = document.querySelector('input[name=\'password\']');
    	let changePassword2 = document.getElementById('password2');
    	let remind = document.querySelector('form p');
    	change.onclick = ()=>{
    		article.style.display = 'none';
    		form.style.display = 'block';
    	}
    	change2.onclick = ()=>{
    		article.style.display = 'none';
    		form2.style.display = 'block';
    	}
    	changeName.setAttribute("value", "<?php echo strval($row['name']); ?>");
    	changeAccount.setAttribute("value", "<?php echo strval($row['account']); ?>");
    	changePassword2.onkeyup = ()=>{
    		if(changePassword.value != changePassword2.value){
    			remind.style.visibility = 'visible';
    		}else{
    			remind.style.visibility = 'hidden';
    		}
    	}
    	let isManager =
	    <?php
	    if(isset($_SESSION['pwd'])){ 
	    	$sql = 'SELECT manager FROM account WHERE password = ?';
			$sth = $dbh->prepare($sql);
			$sth->execute(array($_SESSION['pwd']));
			$manager = $sth->fetch(PDO::FETCH_ASSOC);
			echo $manager['manager'];
		}else{
			echo '0';
		}
	    ?>;
	    if(isManager == '1'){
	    	change2.disabled = false; 
	    }
    </script>
</body>
</html>