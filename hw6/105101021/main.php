<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" >
	<title>Main</title>
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
	    input[type="submit"], button {
	        margin: 1em 1em 0 0;
	        padding: 0.5em;
	        background-color: rgb(255, 194, 71);
	        border: none;
	        border-radius: 1em;
	    }
	    input[type="submit"]:hover, button:hover {
	    	background-color: rgb(255, 173, 10);
	    }
	    #title {
	    	margin-left: 1.5em;
	    }
		form * {
			display: block;
			margin: 0.5em 2em;
		}
		form input, textarea {
			border-radius: 1em;
			border:none;
		}
		button {
			margin-top: 1em;
			margin-left: 3em;

		}
		ul {
			list-style: none;
		}
		li > a {
			text-decoration: none;
			font-size: 1.5em;
		}
		.del {
			margin-left: 1em;
			font-size: 0.7em;
			text-decoration: none;
			color: black;
		}
		.del:hover {
			color: gray;
		}
		#add_pt {
			border: none;
			border-radius: 0.5em;
			background-color: #5BC0DE;
			display: inline-block;
			padding: 0.5em;
			color: white;
			
		}
		#add_pt:hover{
			background-color: #289FC3;
		}
	</style>
</head>
<body>
	<?php
		session_start();
		include('connectsql.php');
		if(isset($_GET['del']) && isset($_SESSION['pwd'])){
			$sql = 'SELECT manager FROM account WHERE password = ?';
			$sth = $dbh->prepare($sql);
			$sth->execute(array($_SESSION['pwd']));
			$manager = $sth->fetch(PDO::FETCH_ASSOC);
			if($manager['manager'] == '1'){
				$sql = 'DELETE FROM topic WHERE id = ?';
				$sth = $dbh->prepare($sql);
				$sth->execute(array($_GET['del']));
				$sql = 'DELETE FROM message WHERE belong = ?';
				$sth = $dbh->prepare($sql);
				$sth->execute(array($_GET['del']));
				echo '<script>alert(\'刪除成功\')</script>';
				echo '<script>history.back();</script>';
			}
		}
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$sql = "SELECT id FROM board WHERE id = ?";
			$sth =  $dbh->prepare($sql);
			$sth->execute(array((int)$id));
    		if($sth->rowCount() != 1){
    			die('不存在此看板');
    		}
		}else{
			die('無法顯示畫面');
		}
		if(isset($_POST['add_topic']) && isset($_POST['add_content']) && isset($_SESSION['account'])){
			$add_topic = htmlspecialchars($_POST['add_topic']);
    		$add_content = htmlspecialchars($_POST['add_content']);
    		$add_content = str_replace("\n", "<br/>", $add_content);
    		if(isset($_FILES['add_pt'])){
    			$extension = explode(".", $_FILES["add_pt"]["name"]);
				$extension =  strtolower(end($extension));
    			if( in_array($extension, array('jpeg', 'jpg', 'png'))){
    				$add_pt = file_get_contents($_FILES["add_pt"]["tmp_name"]); // 把整个文件读入一个字符串
    			}else{
    				$add_pt = 0;
    			}
    		}else{
    			$add_pt = 0;
    		}
    		$add_pt_name = ($add_pt == "0")? 0: strval($id.time().".".$extension);
    		echo $add_pt_name;
			$query = "INSERT INTO topic (title, owner_pass, content, pt_source, pt_name, belong) VALUES (?, ?, ?, ?, ?, ?)";
			$sth = $dbh->prepare($query);
			$sth->execute(array($add_topic, $_SESSION['pwd'], $add_content, $add_pt, $add_pt_name, $_GET['id']));
			echo '<meta http-equiv=REFRESH CONTENT=0;url=main.php?id='.$_GET['id'].'>';
		}
	?>
	<nav>
    	<span>
    	<?php
		$session = empty($_SESSION['pwd'])? '尚未登入': $_SESSION['pwd'];
		if($session != '尚未登入'){
			$sth = $dbh->prepare('SELECT name, id FROM account WHERE password = ?');
			$sth->execute(array($session));
			$row = $sth->fetch(PDO::FETCH_ASSOC); 
			echo '<a href=\'profile.php\'>'.$row['name'].'</a>';
		}
    	?>
    	</span>
    	<span><a href="board.php">回上一頁</a></span>
        <span>
        <?php
        	$log = $session !== '尚未登入'?'登出':'登入';
        	$islog = $log == '登入'? '1': '0';
        	echo '<a href="logout.php?log='.$islog.'">'.$log.'</a>';
        ?>
    	</span>
    </nav>
    <h2 id='title'>
    	<?php
    		$sql = 'SELECT title FROM board WHERE id = ?';
    		$sth = $dbh->prepare($sql);
    		$sth->execute(array($_GET['id']));
    		$row = $sth->fetch(PDO::FETCH_ASSOC); 
    		echo $row['title'];
    	?>
    </h2>
	<ul>
	</ul>
	<?php
		$sql = "SELECT title, id, belong FROM topic WHERE belong = ?";
		$sth = $dbh->prepare($sql);
		$sth->execute(array($id));
		$tables = $sth->fetchAll(PDO::FETCH_NUM);

		if(isset($_SESSION['account'])){
			echo '
			<form action="main.php?id='.$_GET['id'].'" method="post"  enctype="multipart/form-data">
			<label for="add_topic">新增主題：</label>
			<input type="text" name="add_topic" id="add_topic" required>
			<label for="add_content">內文：</label>
			<textarea name="add_content" id="add_content" required></textarea>
			<label id="add_pt"><input type="file" name="add_pt" accept=".jpg, .jpeg, .png*" style="display:none">附上圖片</label>
			<button>確認</button>
			</form>
			';
		}
	?>
<script type="text/javascript">
	let deleteDisable =
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
    	let deletes = document.createElement('a');
    	element.innerHTML = data[i][0];
    	if(deleteDisable != '0'){
    		deletes.className = 'del';
    		deletes.innerHTML = '✖';
    		deletes.setAttribute('href', 'main.php?del='+data[i][1]);
    	}
    	element.setAttribute('href', 'talk.php?id=' + data[i][1]);
    	liTag[i].appendChild(element);
    	element.appendChild(deletes);
    }
</script>
</body>
</html>