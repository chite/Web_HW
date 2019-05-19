<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" >
    <title>talk</title>
    <style type="text/css">
    html{
    	height: 100%;
    }
    body {
        margin: 0;
        padding: 0;
        height: 100%;
        background-color: rgba(255, 61, 51, 0.5);
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

    #container {
        width: 576px;
        margin: auto;
        padding-bottom: 2em;
        background-color: white;
    }
	#chatPlace {
		padding: 1em 3em;
		
	}
    nav>input {
        margin: 1em 1em 0 0;
        padding: 0.5em;
        background-color: rgb(255, 194, 71);
        border: none;
        border-radius: 1em;
    }
    nav>input:hover {
    	background-color: rgb(255, 173, 10);
    }
    article{
    	margin-left: 0.5em;
    }
    article p {
    	margin: 2em 0 4em 0;
    	word-wrap: break-word;
    }
    article img {
    	width: 100%;
    	margin-bottom: 2em;
		height: auto;
    }
	ul {
		list-style: none;
		margin: 0;
		padding: 0;
	}
	.deletes {	
		text-align: right;
		margin-right: 1em;
	}
	.deletes a {
		text-decoration: none;
		color: black;
	}
	.deletes a:hover {
		color: gray;
	}
    .name {
    	font-size: 1.3em;
    	margin-bottom: 0.5em;
    	padding: 0.4em;
    	background-color: rgba(255, 61, 51, 0.5);
    	border-radius: 1em;
    	display: inline-block;
    }
    .content {
    	font-size: 1.2em;
    	margin: 0 0 0.5em 0.6em;
    }
	.number {
		text-align: right;
		margin-right: 1em;
	}
	form {
		margin-left: 2em;
	}

	form button {
		margin: 0 0 2.5em 0.5em;
        padding: 0.7em;
        background-color: rgba(67, 143, 214, 0.5);
        border: none;
        border-radius: 4em;
	}
	form button:hover {
		background-color: rgba(67, 143, 214, 0.8);
	}
	#textarea, #number {
		display: block;
		margin: 1em 0 ;
	}
	@media screen and (max-width: 576px){
		#container {
        width: 100%;
    	}
	}
    </style>
</head>

<body>
	<?php
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		include('connectsql.php');
		$sql = "SELECT id, belong FROM topic WHERE id = ?";
		$sth =  $dbh->prepare($sql);
		$sth->execute(array((int)$id));
		if($sth->rowCount() != 1){
			die('不存在此主題');
		}else {
			$content = $sth->fetch(PDO::FETCH_ASSOC);
			$topicId = $content['id'];
			$content = $content['belong'];
			
		}
	}else{
		die('無法顯示畫面');
	}
	?>
    <nav>
    	<span>
    	<?php
		session_start();
		$session = empty($_SESSION['pwd'])? '尚未登入': $_SESSION['pwd'];
		if($session != '尚未登入'){
			$sth = $dbh->prepare('SELECT name, id FROM account WHERE password = ?');
			$sth->execute(array($session));
			$row = $sth->fetch(PDO::FETCH_ASSOC); 
			echo '<a href=\'profile.php\'>'.$row['name'].'</a>';
		}
    	?>
    	</span>
    	<span><a href=<?php echo 'main.php?id='.$content ?>>回上一頁</a></span>
        <span>
        <?php
        	$log = $session !== '尚未登入'?'登出':'登入';
        	$islog = $log == '登入'? '1': '0';
        	echo '<a href="logout.php?log='.$islog.'">'.$log.'</a>';
        ?>
    	</span>
    </nav>
    <div id="container">
    	<div id="chatPlace">
    		<article>
				<?php
				$sql = "SELECT title, content, pt_source, pt_name FROM topic WHERE id = $id";
				$sth =  $dbh->prepare($sql);
				$sth->execute();
				$contents = $sth->fetch(PDO::FETCH_ASSOC);
				if($contents['pt_name'] != '0' && $contents['pt_name'] != ''){
					$extension = explode(".", $contents['pt_name']);
					$extension = end($extension);
					$pt_loader = '<img src="data:image/'.$extension.';base64,'.base64_encode($contents['pt_source']).'">';
				}else{
					$pt_loader = '<br/>';
				}
				echo '<h1>'.$contents['title'].'</h1><p>'.$contents['content'].'</p>'.$pt_loader;
				?>
    		</article>
	        <ul>
	        </ul>
        </div>
        <form action="push.php" method="post">
            <label for="textarea">請留言</label>
            <textarea id="textarea" name="textarea"></textarea>
            <input type="hidden" name="id" value="<?php echo $topicId; ?>">
            <button type="submit">送出</button>
        </form>
    </div>
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
	    let data = 
	    <?php
		$sql = 'SELECT content, name, id, password FROM message WHERE belong = ?';
		$sth = $dbh->prepare($sql);
		$sth->execute(array($_GET['id']));
		$content = $sth->fetchAll(PDO::FETCH_NUM);
		$content = json_encode($content);
		echo $content;
	    ?>;
	    let ul = document.querySelector('ul');
		let session = <?php 
		$session = !empty($_SESSION['pwd'])? $_SESSION['pwd']: null;
		echo "'".$session."'"; 
		?>;
        for (let i = 0; i < data.length; i++) {
        	let li0 = document.createElement('li');
            let li1 = document.createElement('li');
            let li2 = document.createElement('li');
            let li3 = document.createElement('li');
            let deletes = document.createElement('a');
            if(deleteDisable != '0' || session == data[i][3]){
            	deletes.setAttribute('href', 'delete.php?id='+data[i][2]);
            }
            deletes.className = 'deletesA';
            li0.className = 'deletes';
            li1.className = 'name';
            li2.className = 'content';
            li3.className = 'number';
            deletes.innerHTML = '✖';
            li1.innerHTML = data[i][1];
            li2.innerHTML = data[i][0];
            li3.innerHTML = '第' + (i + 1) + '樓';
            ul.appendChild(li0);
            li0.appendChild(deletes);
            ul.appendChild(li1);
            ul.appendChild(li2);
            ul.appendChild(li3);
            ul.appendChild(document.createElement('hr'));
            ul.appendChild(document.createElement('br'));
        }
    </script>
</body>

</html>