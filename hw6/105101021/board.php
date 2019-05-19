<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" >
	<title>board</title>
	<style type="text/css">
		body {
	        margin: 0;
	        padding: 0;
	        background-color: #FBFDFA;
	    }
	    nav {
	    	padding-top: 0.8em;
	        height: 2.5em;
	        background-color: gray;
	        text-align: right;
	    }
	    span, span a {
	    	text-decoration: none;
	    	font-size: 1em;
	    	margin-right: 0.5em;
	    	color: white;
	    }
	    span, span a:hover {
	    	color: rgba(255, 255, 255, 0.5);
	    }
	    nav>input, button {
	        margin: 1em 1em 0 0;
	        padding: 0.5em;
	        background-color: rgb(255, 194, 71);
	        border: none;
	        border-radius: 1em;
	    }
	    nav>input:hover, button:hover {
	    	background-color: rgb(255, 173, 10);
	    }
	    form * {
			display: block;
			margin: 0.5em 2em;
		}
		form input {
			border-radius: 1em;
			border:none;
		}
		form button {
			margin-top: 1em;
			margin-left: 3em;
		}
	    h2 {
	    	margin-left: 1.5em;
	    }
		ul {
			list-style: none;
		}
		li > a {
			text-decoration: none;
			font-size: 1.5em;
		}
	</style>
</head>
<body>
	<nav>
    	<span>
    	<?php
    	session_start();
    	include('connectsql.php');
		$session = empty($_SESSION['pwd'])? '尚未登入': $_SESSION['pwd'];
		if($session != '尚未登入'){
			$sth = $dbh->prepare('SELECT name, id FROM account WHERE password = ?');
			$sth->execute(array($session));
			$row = $sth->fetch(PDO::FETCH_ASSOC); 
			echo '<a href=\'profile.php\'>'.$row['name'].'</a>';
		}
    	?>
    	</span>
    	<span>
        <?php
        	$log = $session !== '尚未登入'?'登出':'登入';
        	$islog = $log == '登入'? '1': '0';
        	echo '<a href="logout.php?log='.$islog.'">'.$log.'</a>';
        ?>
    	</span>
    </nav>
    <h2>看板</h2>
	<ul>
	</ul>
	<?php
		if($session != '尚未登入'){ 
			$sth = $dbh->prepare('SELECT manager FROM account WHERE password = ?');
			$sth->execute(array($session));
			$manager = $sth->fetch(PDO::FETCH_ASSOC);
			if($manager['manager'] == '1'){
				echo '
				<form action="board.php" method="post">
				<label for="add_board">開板：</label>
				<input type="text" name="add_board" id="add_board">
				<button>確認</button>
				</form>
				';
			}
			if(isset($_POST['add_board']) && $manager['manager'] == '1'){
				$sql = 'INSERT INTO board (title, host_pwd) VALUES (?, ?)';
				$sth = $dbh->prepare($sql);
				$sth->execute(array($_POST['add_board'], $session));
				echo '<meta http-equiv=REFRESH CONTENT=0;url=board.php>';
			}
		}

		$sql = "SELECT id, title from board";
		$statement = $dbh->prepare($sql);
		$statement->execute();
		$tables = $statement->fetchAll(PDO::FETCH_NUM);
	?> 
<script type="text/javascript">
    let data = <?php echo json_encode($tables); ?>;
    ulTag = document.querySelector('ul');
    for(let i = 0; i < data.length; i ++){
    	let element = document.createElement('li');
    	ulTag.appendChild(element);
    	ulTag.appendChild(document.createElement("br"));
    }
    let liTag =  document.getElementsByTagName('li');
    for(let i=0; i < liTag.length; i ++){
    	let element = document.createElement('a');
    	element.innerHTML = data[i][1];
    	element.setAttribute('href', 'main.php?id=' + data[i][0]);
    	liTag[i].appendChild(element);
    }
</script>
</body>
</html>