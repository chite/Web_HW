<?php
    session_start();
    include('connect.php');
    if(isset($_SESSION['name'])){
        $sth = $dbh->prepare('SELECT id FROM account WHERE name = ?');
        $sth->execute(array($_SESSION['name']));
        if($sth->rowCount() == 0){
            die();
        }
        if(isset($_GET['id'])){
            $sth = $dbh->prepare('SELECT id FROM board WHERE id = ?');
            $sth->execute(array($_GET['id']));
            if($sth->rowCount() == 0){
                die();
            }
        }else{
            die();
        }
    }else{
    die();
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
    <title>逃出絕命政-留言區</title>
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
    h2, p, input, button, textarea, span{
        font-family: 'Noto Sans TC', sans-serif;
    }

    .top-nav {
        width: 95%;
        height: 8%;
        margin: 1em auto;
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
        float: right;
    }

    .search-edit button {
        outline: none;
        background-color: #999999;
        border: none;
        border-radius: 100%;
        padding: 1em 1.2em;
        margin-left: 1em;
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
    .bottom-nav div{
        display: block;
        background-color: #B3B3B3;
        margin: 1em;
        padding: 0.5em;
        border-radius: 0.5em;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
        min-height: 2em;
    }
    .bottom-nav div+div, #chat-icon {
        background-color: #666666;
        color: white;
        display: -webkit-box;
        display: -ms-flexbox;
        vertical-align: middle;
        -webkit-box-align: center;
            -ms-flex-align: center;
                align-items: center;
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
    hr {
        border:1.5px;
        border-style: dashed;
        color: black;
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
        #chat-icon, .bottom-nav div{
            display: inline-block;
            vertical-align: middle;
        }
        .bottom-nav{
            position: relative;
        }
        .bottom-nav div+div{
            float: right;
            min-height: 4em;
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
        <form class="search-edit">
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
                    echo '<h2>'.$_SESSION['name'].'</h2>    
                </div>
                <div>';
                    $sth = $dbh->prepare('SELECT belong FROM board WHERE id = ?');
                    $sth->execute(array($_GET['id']));
                    $row = $sth->fetch(PDO::FETCH_ASSOC);
                    echo '<h2>'.$row['belong'].'</h2>
                </div>
                <div>
                    <i class="fas fa-comment-dots fa-3x" id="chat-icon"></i>';
                    $sth = $dbh->prepare('SELECT COUNT(id) AS \'SUM\' FROM message WHERE belong = ?');
                    $sth->execute(array($_GET['id']));
                    $row = $sth->fetch(PDO::FETCH_ASSOC);
                    echo '<h2>'.$row['SUM'].'</h2>';
                    ?>
                    <!----------------------------------------->
                </div>
            </nav>
            <section class="chat-content">
                <!----------------------------------------->
                <?php
                $sth = $dbh->prepare('SELECT title, content, owner_name, time, response FROM board WHERE id = ?');
                $sth->execute(array($_GET['id']));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
                $sth1 = $dbh->prepare('SELECT img, img_name FROM account WHERE name = ?');
                $sth1->execute(array($row['owner_name']));
                $row1 = $sth1->fetch(PDO::FETCH_ASSOC);
                echo 
                '<article class="message-title">
                    <nav>';
                if($row1['img'] == 1){
                    echo '<img src="img/photo.png">';
                }else{
                    echo '<img src="data:'.$row1['img_name'].';base64,'.base64_encode($row1['img']).'">';
                }
                echo 
                        '<span>'.$row['owner_name'].'</span>
                        <span>'.$row['time'].'</span>
                    </nav>
                    <h2>'.$row['title'].'</h2>
                    <p>'.$row['content'].'</p>
                    <hr/>
                    <p id="manager_edit1">管理員回覆：</p>';
                if(empty($row['response'])){
                    echo '<p id="manager_edit2">尚無回應</p>';
                }else{
                    echo '<p id="manager_edit2">'.$row['response'].'</p>';
                }
                echo
                '</article>';

                //存取留言照片
                $img = [];
                $img_name = [];
                $sth = $dbh->prepare('SELECT owner_name FROM message WHERE belong = ?');
                $sth->execute(array($_GET['id']));
                while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                    $sth1 = $dbh->prepare('SELECT img, img_name FROM account WHERE name = ?');
                    $sth1->execute(array($row['owner_name']));
                    $row1 = $sth1->fetch(PDO::FETCH_ASSOC);
                    array_push($img, $row1['img']);
                    array_push($img_name, $row1['img_name']);
                }
                //存取留言
                $sth = $dbh->prepare('SELECT id, owner_name, content, time FROM message WHERE belong = ?');
                $sth->execute(array($_GET['id']));
                $x = 0;
                while($row = $sth->fetch(PDO::FETCH_ASSOC)){
                    echo
                    '<article class="message-title">
                        <nav>';
                        if($img[$x] == 1){
                            echo '<img src="img/photo.png">';
                        }else{
                            echo '<img src="data:'.$img_name[$x].';base64,'.base64_encode($img[$x]).'">';
                        }
                        $x++;
                    echo 
                        '<span>'.$row['owner_name'].'</span>
                        <span>'.$row['time'].'</span>';
                    if($_SESSION['name'] == $row['owner_name'] || 'chite' == $_SESSION['name']){
                        echo '<span><a href="message_delete.php?id='.$_GET['id'].'&del='.$row['id'].'">X</a></span>';
                    }
                    echo
                        '</nav>
                        <p>'.$row['content'].'</p>
                    </article>';
                }
                ?>
                <!----------------------------------------->
                <form method="POST" action="message_send.php" class="post-content">
                    <input type="hidden" name="id" value="11">
                    <textarea name="content" rows="5" placeholder="請輸入文字發表留言" required></textarea>
                    <button type="submit">送出</button>
                </form>
            </section>
        </section>
    </div>
    <script type="text/javascript">
        let voice = <?php include('voice.php'); ?>; //for spider
    	let $edit = $('#edit');
    	let $post_content = $('.post-content');
        let url = location.href.slice(location.href.indexOf('=')+1);
        let val = null;
    	$edit.on('click', function(e){
    		e.preventDefault();
    		$post_content.toggleClass('visible');
    	})
        $('#sign_out').on('click', function(e){
            e.preventDefault();
            location.href = 'sign_up.php';
        })
        $('#back').on('click', function(){
            history.back();
        })

        for(let i=0; i<3; i++){
            $('aside button').eq(i).on('click', function(){
                location.href = 'board.php?page='+(i+1);
            })
        }
        $('input[type="hidden"]').attr('value', url);

        $('#manager_edit1').on('dblclick', function(e){
            if(val === null){
                val = $('#manager_edit2').text();
            }
            if($('#manager_edit2').find('input').length){
                $('#manager_edit2').text(val);
            }else{
                $('#manager_edit2').text('').append($(
                '<form method="POST" action="edit.php" class="edit_p"><input type="text" name="success_edit"><input type="hidden" name="id"><button type="submit">確認</button><button type="reset">取消</button></form>'
                ));
                $('input[type="hidden"]').attr('value', url);
            }     
        });
    </script>
    <script type="text/javascript" src="spider/spider.js"></script>
</body>

</html>