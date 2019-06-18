<?php
    session_start();
    include('connect.php');
    if(isset($_SESSION['name'])){
        $sth = $dbh->prepare('SELECT id FROM account WHERE name = ?');
        $sth->execute(array($_SESSION['name']));
        if($sth->rowCount() == 0){
            die();
        }
    }else{
        die('您尚未登入，請前往<a href="login1.php">登入頁面</a>進行登入');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="逃出絕命政" >
    <meta property="og:image" content="https://chite.000webhostapp.com/img/photo.png">
    <meta property="og:description" content="👻👻👻" >
    <title>逃出絕命政-主題區</title>
    <link rel="shortcut icon" type="image/png" href="https://chite.000webhostapp.com/img/photo.png">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="spider/spider.css">
    <style type="text/css">
    html,
    body {
        margin: 0;
        padding: 0;
        background-color: #CCCCCC;
        height: 100%;
    }

    .top-nav {
        width: 95%;
        height: 8%;
        margin: 1em auto;
        text-align: center;
    }

    .container {
        width: 95%;
        height: 92%;
        margin: 1em auto;
    }

    #back {
        display: none;
    }

    .search-edit {
        display: inline-block;
    }

    .search-edit input {
        background-color: #E6E6E6;
        height: 2em;
        width: 40%;
        border: none;
        border-radius: 1em;
        outline: none;
        padding-left: 0.5em;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
    }

    .search-edit button {
        outline: none;
        background-color: #999999;
        border: none;
        border-radius: 100%;
        padding: 1em 1.2em;
        margin-left: 0.5em;
    }

    aside button {
        background-color: #666666;
        color: white;
        border: none;
        border-radius: 0.5em;
        padding: 0.5em;
        font-size: 1.2em;
        display: block;
        width: 90%;
        margin: 0.5em auto;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
    }

    .chat-bg {
        background: #0B263B;
        width: 90%;
        margin: 0.5em auto 0;
        padding: 0.5em;
        border-radius: 0.5em;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
    }

    .bottom-nav div {
        display: inline-block;
        background-color: #B3B3B3;
        margin: 1em;
        padding: 0.5em;
        border-radius: 0.5em;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
        overflow: hidden;
        -o-text-overflow: ellipsis;
           text-overflow: ellipsis;

    }

    .bottom-nav img {
        width: 5em;
        height: 5em;
        margin: auto;
        vertical-align: middle;
        display: block;
    }

    .bottom-nav h2 {
        display: block;
        margin: 0 auto;
        text-align: center;
        word-break: break-all;
    }

    .post-content {
        background: #E6E6E6;
        border-radius: 0.5em;
        /*轉場特效*/
        visibility: hidden;
        height: 0;
        overflow: hidden;
        opacity: 0;
        -webkit-transition: all 1s 0s;
        -o-transition: all 1s 0s;
        transition: all 1s 0s;
    }
    .visible {
    	margin: 0 1em;
    	padding: 0.5em;
    	visibility: visible;
        height: auto;
        opacity: 1;
    }

    .post-content input,
    textarea {
        display: block;
        width: 100%;
        margin: 0.5em auto;
        padding: 0.5em;
        border: none;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
        font-family: 'Noto Sans TC', sans-serif;
    }

    .post-content select {
        background-color: #666666;
        font-family: 'Noto Sans TC', sans-serif;
        color: white;
        outline: none;
        border-radius: 0.5em;
        margin: 0.5em 0;
        padding: 0.3em;
        font-size: 1em;
    }

    .post-content button {
        background-color: #666666;
        font-family: 'Noto Sans TC', sans-serif;
        color: white;
        outline: none;
        border: none;
        border-radius: 0.5em;
        margin: 0.5em 0;
        padding: 0.3em;
        font-size: 1em;
        float: right;
    }
    .message-title{
        margin: 1em;
        padding: 0.5em;
        background-color: #E6E6E6;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
        border-radius: 0.5em;
    }
    .message-title nav {
        height: 20%;
    }
    .message-title img {
        height: 2em;
        width: 2em;
        vertical-align: bottom;
        border-radius: 100%;
    }
    .message-title span{
        font-size: 1.5em;
    }
    .message-title span:nth-child(3){
        color: #B3B3B3;
    }
    .message-title span:nth-child(4){
        font-size: 1.2em;
        background-color:#666666;
        color: white;
        border-radius: 0.5em;
        padding: 0.3em;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
        float: right;
    }
    .message-title a {
        text-decoration: none;
        color: black;
    }
    .message-title p {
        word-break: break-all;
    }
    img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]{
        display:none!important;
    }
    @media only screen and (min-width : 992px) {
        #back {
            display: inline-block;
        }

        .container {
            width: 90%;
            text-align: left;
        }
        .top-nav {
            width: 75%;
            text-align: left;
            margin: 1em 5% 1em auto;
        }
        .search-edit {
            float: right;
        }

        aside {
            width: 15%;
            float: left;
        }

        aside button {
            width: 5em;
            left: 100%;
        }

        .chat-bg {
            width: 85%;
            float: left;
        }

        .container::after {
            content: '';
            display: block;
            clear: both;
        }

        .bottom-nav h2 {
            display: inline-block;
            margin: 0 1em;
        }

        .bottom-nav img {
            display: inline-block;
        }
        .message-title span:nth-child(3){
            margin-left: 1em;
        }
    }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
</head>

<body>
    <!------------spider------------------->
    <img id="menu" src="img/menu.png">
    <img src="img/account.png" class="icon vis" id="account">
    <img src="img/voice.png" class="icon vis" id="voice">
    <img src="img/forum.png" class="icon vis" id="forum">
    <audio autoplay loop></audio>
    <!------------spider------------------->
    <nav class="top-nav">
        <i class="fas fa-arrow-alt-circle-left fa-3x" id="back"></i>
        <form class="search-edit" method="GET" action="board.php">
            <input type="text" name="search">
            <button type="submit"><i class="fas fa-search" style="color: white;"></i></button>
            <button type="submit" id="edit"><i class="fas fa-pencil-alt" style="color: white;"></i></button>
            <button title="登出" id="sign_out"><i class="fas fa-sign-out-alt" style="color: white;"></i></button>
        </form>
    </nav>
    <div class="container">
        <aside>
            <button>全部</button>
            <button>聊天</button>
            <button>問題回報</button>
        </aside>
        <section class="chat-bg">
            <nav class="bottom-nav">
                <div>
                    <!----------------------------------------->
                    <?php
                    $sql = 'SELECT img, img_name FROM account WHERE name = ?';
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array($_SESSION['name']));
                    $row = $sth->fetch(PDO::FETCH_ASSOC);
                    if($row['img'] == 1){
                        echo '<img src="img/photo.png">';
                    }else{
                        echo '<img src="data:'.$row['img_name'].';base64,'.base64_encode($row['img']).'">';
                    }
                    echo '<h2>'.$_SESSION['name'].'</h2>';
                    ?>
                    <!----------------------------------------->
                </div>
            </nav>
            <section class="chat-content">
                <form method="post" action="boardDeal.php" class="post-content">
                    <input type="text" name="title" placeholder="請輸入標題" required>
                    <textarea name="content" rows="5" placeholder="請輸入內容" required></textarea>
                    <select name="belong">
                        <option value="聊天">聊天</option>
                        <option value="問題回報">問題回報</option>
                    </select>
                    <button type="submit">送出</button>
                </form>
                <!----------------------------------------->
                <?php
                if(isset($_GET['search']) && !empty(($_GET['search']))){ //如果按搜尋
                    $titleId = [];//檢索完主題id
                    $titleName = [];//檢索完主題發文人
                    $titleStr = []; //圖片sql用
                    $extension = [];//圖片副檔名
                    $photos = [];//圖片檔
                	$sth = $dbh->prepare('SELECT id, owner_name FROM board WHERE title LIKE ? ORDER BY id ASC');
                	$sth->execute(array('%'.$_GET['search'].'%'));
                	while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                		array_push($titleName, $row['owner_name']); //主題發文人
                	}
                	foreach ($titleName as $key => $value) { //查詢時字串處理
                		$titleStr[$key] = '\''.$value.'\'';
                	}
                	$titleStr = join(',', array_unique($titleStr));//排除重複內容轉字串
                	if(!empty($titleStr)){//搜索內容存在
                		$sth = $dbh->prepare("SELECT name, img, img_name FROM account WHERE name IN ($titleStr) ORDER BY id ASC");
	                    $sth->execute();
	                    while ($pt = $sth->fetch(PDO::FETCH_NUM)) {
	                    	$photos[$pt[0]] = $pt[1]; //圖片檔
	                    	$extension[$pt[0]] = $pt[2];//圖片副檔名
	                    }

	                    $sth = $dbh->prepare('SELECT id, title, content, owner_name, time, belong FROM board WHERE title LIKE ? ORDER BY id ASC');
	                    $sth->execute(array('%'.$_GET['search'].'%'));
	                    while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
	                        echo 
	                        '<article class="message-title">
	                            <nav>';
	                                if($photos[$row['owner_name']] === '1'){
	                                    echo '<img src="img/photo.png">';
	                                }else{
	                                    echo '<img src="data:'.$extension[$row['owner_name']].';base64,'.base64_encode($photos[$row['owner_name']]).'">';
	                                }
	                        echo
	                                
	                                '<span>'.$row['owner_name'].'</span>
	                                <span>'.$row['time'].'</span>
	                                <span>'.$row['belong'].'</span>
	                            </nav>
	                            <a href="message.php?id='.$row['id'].'">
	                                <h2>'.$row['title'].'</h2>
	                                <p>'.$row['content'].'</p>
	                            </a>
	                        </article>';
	                    }
                	}   
                }else{
                    if(isset($_GET['page'])){ //判斷左方按鈕按下哪個或沒按
                        if($_GET['page'] == 2){
                            $page1 = '聊天';
                            $page2 = '聊天';
                        }elseif($_GET['page'] == 3){
                            $page1 = '問題回報';
                            $page2 = '問題回報';
                        }else{
                           $page1 = '聊天'; 
                           $page2 = '問題回報';
                        }
                         
                    }else{
                        $page1 = '聊天'; 
                        $page2 = '問題回報';
                    }
                    
                    $sql = 'SELECT owner_name FROM board WHERE belong = ? OR belong = ? ORDER BY id ASC';
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array($page1, $page2));
                    $photoArr = []; //主題發文人
                    $titleStr = []; //Sql查詢用
                    $extension = [];//圖片副檔名
                    $photos = [];//圖片檔
                    while($photoRow = $sth->fetch(PDO::FETCH_ASSOC)){
                        array_push($photoArr, $photoRow['owner_name']); //主題發文人
                    }
                	foreach ($photoArr as $key => $value) { //查詢時字串處理
                		$titleStr[$key] = '\''.$value.'\'';
                	}
                	$titleStr = join(',', array_unique($titleStr));//排除重複內容轉字串
                    $sth = $dbh->prepare("SELECT name, img, img_name FROM account WHERE name IN ($titleStr) ORDER BY id ASC");
                    $sth->execute();
                    while ($pt = $sth->fetch(PDO::FETCH_NUM)) {
                    	$photos[$pt[0]] = $pt[1]; //圖片檔
                    	$extension[$pt[0]] = $pt[2];//圖片副檔名
                    }

                    $sql = 'SELECT id, title, content, owner_name, time, belong FROM board WHERE belong = ? OR belong = ? ORDER BY id ASC';
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array($page1, $page2));
                    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                        echo 
                        '<article class="message-title">
                            <nav>';
                        
                                if($photos[$row['owner_name']] == 1){
                                    echo '<img src="img/photo.png">';
                                }else{
                                    echo '<img src="data:'.$extension[$row['owner_name']].';base64,'.base64_encode($photos[$row['owner_name']]).'">';
                                }
                        echo
                                
                                '<span>'.$row['owner_name'].'</span>
                                <span>'.$row['time'].'</span>
                                <span>'.$row['belong'].'</span>
                            </nav>
                            <a href="message.php?id='.$row['id'].'">
                                <h2>'.$row['title'].'</h2>
                                <p>'.$row['content'].'</p>
                            </a>
                        </article>';
                    };
                }    
                ?>
                <!----------------------------------------->
            </section>
        </section>
    </div>
    <script type="text/javascript">
        let voice = <?php include('voice.php'); ?>; //for spider
    	let $edit = $('#edit');
    	let $post_content = $('.post-content');
    	$edit.on('click', function(e){
    		e.preventDefault();
    		$post_content.toggleClass('visible');
    	})
        $('#sign_out').on('click',  function(e){
            e.preventDefault();
            location.href = 'sign_up.php';
        })
        $('#back').on('click',  function(){
            history.back();
        })

        for(let i=0; i<3; i++){
            $('aside button').eq(i).on('click',  function(){
                location.href = 'board.php?page='+(i+1);
            })
        }
    </script>
    <script type="text/javascript" src="spider/spider.js"></script>
</body>

</html>