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
    <meta property="og:title" content="政大鬼故事" >
    <meta property="og:image" content="https://chite.000webhostapp.com/img/photo.png">
    <meta property="og:description" content="政大鬼故事👻" >
    <title>Board</title>
    <link rel="shortcut icon" type="image/png" href="https://chite.000webhostapp.com/img/photo.png">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
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
        border: none;
        border-radius: 1em;
        outline: none;
        padding-left: 0.5em;
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
        box-sizing: border-box;
    }

    .chat-bg {
        background: #0B263B;
        width: 90%;
        margin: 0.5em auto 0;
        padding: 0.5em;
        border-radius: 0.5em;
        box-sizing: border-box;
    }

    .bottom-nav div {
        display: inline-block;
        background-color: #B3B3B3;
        margin: 1em;
        padding: 0.5em;
        border-radius: 0.5em;
        box-sizing: border-box;
        overflow: hidden;
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
     /*------------spider-------------------*/
    #menu {
        position: absolute;
        transition: all 0.5s ease;
        z-index: 4;
        transform: scale(0.5, 0.5);
        top: -25em;
        left: 0;
    }

    #menu.menuMove {
        transform: translate(0, 10em) scale(0.5, 0.5);
    }

    .icon {
        position: absolute;
        left: 1.8em;
        transition: all 0.5s ease;
        z-index: 5;
        transform: scale(0.5, 0.5);
    }

    .icon.vis {
        transform: translate(0, -28em);
    }
    /*------------spider-------------------*/
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
        /*------------spider-------------------*/
        #menu{
            top: -30em;
            left: 1em;
            transform: scale(1, 1);
        }
        .icon{
            left: 3em;
            transform: scale(1, 1);
        }
        #menu.menuMove {
            transform: translate(0, 20em) scale(1, 1);
        }
        /*------------spider-------------------*/
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
                <form method="post" action="board_send.php" class="post-content">
                    <input type="text" name="title" placeholder="請輸入標題">
                    <textarea name="content" rows="5" placeholder="請輸入內容"></textarea>
                    <select name="belong">
                        <option value="聊天">聊天</option>
                        <option value="問題回報">問題回報</option>
                    </select>
                    <button type="submit">送出</button>
                </form>
                <!----------------------------------------->
                <?php
                if(isset($_GET['search'])){ //如果按搜尋
                    $sql = 'SELECT owner_name, title FROM board';
                    $sth = $dbh->prepare($sql);
                    $sth->execute();
                    $photoArr = [];
                    $titleArr = [];
                    $photos = [];
                    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                        array_push($titleArr, $row['title']); 
                        array_push($photoArr, $row['owner_name']); 
                    }
                    $titleArrNum = count($titleArr);
                    for($i=0; $i<$titleArrNum; $i++){
                        if(stristr($titleArr[$i], $_GET['search']) == FALSE){
                            unset($titleArr[$i]);
                            unset($photoArr[$i]);
                        }
                    }
                    $titleArr = array_values($titleArr); //篩選出的標題陣列
                    $photoArr = array_values($photoArr);
                    for($i=0; $i<count($photoArr); $i++){
                        $sql = 'SELECT img, img_name FROM account WHERE name = ?';
                        $sth = $dbh->prepare($sql);
                        $sth->execute(array($photoArr[$i]));
                        $pt = $sth->fetch(PDO::FETCH_NUM);
                        array_push($photos, $pt[0]); //圖片檔
                        $photoArr[$i] = $pt[1]; //圖片副檔名
                    }

                    for($i=0; $i<count($titleArr); $i++){
                        $sql = 'SELECT id, title, content, owner_name, time, belong FROM board WHERE title = ?';
                        $sth = $dbh->prepare($sql);
                        $sth->execute(array($titleArr[$i]));
                        $row = $sth->fetch(PDO::FETCH_ASSOC);
                        echo 
                        '<article class="message-title">
                            <nav>';
                                if($photos[$i] === '1'){
                                    echo '<img src="img/photo.png">';
                                }else{
                                    echo '<img src="data:'.$photoArr[$i].';base64,'.base64_encode($photos[$i]).'">';
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
                    
                    $sql = 'SELECT owner_name FROM board WHERE belong = ? OR belong = ?';
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array($page1, $page2));
                    $photoArr = [];
                    $photos = [];
                    while($photoRow = $sth->fetch(PDO::FETCH_ASSOC)){
                        array_push($photoArr, $photoRow['owner_name']); 
                    }

                    for($i = 0; $i < count($photoArr); $i++){
                        $sql = 'SELECT img, img_name FROM account WHERE name = ?';
                        $sth = $dbh->prepare($sql);
                        $sth->execute(array($photoArr[$i]));
                        $pt = $sth->fetch(PDO::FETCH_NUM);
                        array_push($photos, $pt[0]); 
                        $photoArr[$i] = $pt[1];
                    }
                    $sql = 'SELECT id, title, content, owner_name, time, belong FROM board WHERE belong = ? OR belong = ?';
                    $sth = $dbh->prepare($sql);
                    $sth->execute(array($page1, $page2));
                    $x = 0;
                    while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                        echo 
                        '<article class="message-title">
                            <nav>';
                        
                                if($photos[$x] == 1){
                                    echo '<img src="img/photo.png">';
                                }else{
                                    echo '<img src="data:'.$photoArr[$x].';base64,'.base64_encode($photos[$x]).'">';
                                }
                                $x++;
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
    	let $edit = $('#edit');
    	let $post_content = $('.post-content');
    	$edit.on('click', e =>{
    		e.preventDefault();
    		$post_content.toggleClass('visible');
    	})
        $('#sign_out').on('click', e =>{
            e.preventDefault();
            location.href = 'sign_up.php';
        })
        $('#back').on('click', ()=>{
            history.back();
        })

        for(let i=0; i<3; i++){
            $('aside button').eq(i).on('click', ()=>{
                location.href = 'board.php?page='+(i+1);
            })
        }
        /*------------spider-------------------*/
        let menu = $('#menu');
        let icon = $('.icon');
        let voice = <?php include('voice.php'); ?>; 
            
        if (screen.width > 991) {

            icon.each((index, value) => {
                $(value).css('top', 1 + index * 7 + 'em');
            });   
        } else {
            icon.each((index, value) => {
                $(value).css('top', 0.5 + index * 3 + 'em');
            });
        }
        menu.on('click', () => {
                menu.toggleClass('menuMove');
                icon.toggleClass('vis');
        });
        //voice
        if(voice == '0'){
            $('audio').attr('src', '');
            $('#voice').attr('src', 'img/voice_block.png');
        }else{
            $('audio').attr('src', 'img/bgm.mp3');
            setTimeout(function(){
                if($('audio')[0].paused){
                        $('.icon').eq(1).click();
                }
            }, 1000);
        }
        //button
        for(let i = 0; i < 3; i ++){
            $('.icon').eq(i).on('click', e=>{
                switch(e.target.id){
                    case 'account':
                        location.href = 'profile.php';
                    break;
                    case 'voice':
                        let voice_state = null;
                        if($('audio').attr('src')){
                            $('audio').attr('src', '');
                            $('#voice').attr('src', 'img/voice_block.png');
                             voice_state = '0';
                        }else{
                            $('audio').attr('src', 'img/bgm.mp3');
                            $('#voice').attr('src', 'img/voice.png');
                            voice_state = '1';
                        }
                        let formData = new FormData();
                        formData.append('voice', voice_state);
                        fetch('voice.php',{
                            method: 'POST',
                            body: formData
                        })
                        .then(response=>
                            response.text())
                        .then(response=>{
                            console.log(response);
                        })
                        .catch(err=>{
                            console.log(err);
                        })

                    break;
                    case 'forum':
                        location.href = 'board.php';
                    break;
                }
            })
        }
        /*------------spider-------------------*/
    </script>
</body>

</html>