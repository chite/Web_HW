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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="逃出絕命政" >
    <meta property="og:image" content="https://chite.000webhostapp.com/img/photo.png">
    <meta property="og:description" content="👻👻👻" >
    <title>逃出絕命政-個人檔案</title>
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

    article {
        margin: auto;
        width: 100%;
        height: 100%;
        position: relative;
    }
    section {
        background-color: #0B263B;
        min-height: 65%;
        display: block;
        overflow: hidden;
        position: relative;
        padding: 0.5em;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
    }

    .bottom {
        width: 100%;
        position: relative;
        top: 5%;
        min-height: 25%;
        height: auto;
        padding: 0;
    }

    #user-pt {
        width: 100%;
        height: 10em;
        display: block;
        overflow: hidden;
        text-align: center;
        margin: 0.5em auto;
    }

    #user-pt img {
        width: auto;
        height: auto;
        max-height: 100%;
    }
    #user-pt img:hover{
        opacity: 0.8;
    }

    .col-5 {
        width: 70%;
        height: 90%;
        display: inline-block;
        overflow: hidden;
        position: relative;
        vertical-align: top;
    }

    .col-3 {
        width: 25%;
        display: inline-block;
        vertical-align: top;

    }

    .col-3 button {
        outline: none;
        background-color: #666666;
        border: none;
        display: block;
        margin: 0 auto 1em auto;
        font-family: 'Noto Sans TC', sans-serif;
        font-size: 1em;
        border-radius: 0.5em;
        color: white;
        padding: 0.5em;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
    }

    .inner-col {
        width: 100%;
        background-color: #B3B3B3;
        display: inline-block;
        vertical-align: middle;
        border-radius: 16px;
        padding: 1em;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
    }
    form {
        visibility: hidden;
        height: auto;
        opacity: 0;
        -webkit-transition: all 1s 0s;
        -o-transition: all 1s 0s;
        transition: all 1s 0s;
    }
    .visible {
        visibility: visible;
        opacity: 1;
    }
    .inner-col:nth-child(2) {
        background-color: transparent;
    }

    h2 {
        word-break: break-all;
        font-family: 'Noto Sans TC', sans-serif;
        font-size: 1.2em;
    }

    form input {
        background-color: #CCCCCC;
        border: none;
        font-size: 1em;
        font-family: 'Noto Sans TC', sans-serif;
        width: 100%;
        margin-top: 0.5em;
        padding-left: 0.5em;
    }
    form button{
		background-color: #B3B3B3;
		color: white;
		border-radius: 10px;
		border: none;
		padding: 0.5em;
		margin-top: 0.5em;
		font-size: 1em;
        font-family: 'Noto Sans TC', sans-serif;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
    }
	.triangle{
	width: 0;
	height: 0;
	border-top: 100px solid red;
	border-right: 100px solid transparent;
	}
	.logo{
		width: 6em;
		height: auto;
		margin: 0.5em;
	}
    .icons{
        float: right;
    }
    #sign_out{
        margin-left: 0.2em;
    }
    .clear{
        clear: both;
        display: block;
        content: '';
    }
    img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]{
        display:none!important;
    }
    @media only screen and (min-width: 991px) {
        article {
            width: 80%;
        }
        section {
            border-radius: 0.5em;
            padding: 2em;
        }

		.bottom {
			border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
		}
        #user-pt {
            display: inline-block;
            width: 15vw;
            height: 100%;
            margin-left: 0.5em;
        }

        #user-pt img {
            max-width: 90%;
            height: auto;
            max-height: 60%;
        }

        .col-5 {
            height: 100%;
            width: 50%;
            margin-left: 2em;
        }

        .col-3 {
            width: 20%;
        }

        .col-3 button {
            font-size: 1.4em;
        }

        .inner-col {
            height: 50%;
        }
    }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>

<body>
    <!------------spider------------------->
    <img id="menu" src="img/menu.png">
    <img src="img/account.png" class="icon vis" id="account">
    <img src="img/voice.png" class="icon vis" id="voice">
    <img src="img/forum.png" class="icon vis" id="forum">
    <audio autoplay loop></audio>
    <!------------spider------------------->
    <article>
        <div class="icons">
            <i class="fas fa-arrow-alt-circle-left fa-3x" id="back"></i>
            <i class="fas fa-sign-out-alt fa-3x" style="color: black;" title="登出" id="sign_out"></i>
        </div>
        <span class="clear"></span>
        <section>
            <div id="user-pt">
                <!----------------------------------------->
                <?php
                $sth = $dbh->prepare('SELECT password, mail, img, img_name, logo FROM account WHERE name = ?');
                $sth->execute(array($_SESSION['name']));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
                if($row['img'] == 1){
                    echo '<img src="img/photo.png" title="點我更換頭貼">';
                }else{
                    echo '<img src="data:'.$row['img_name'].';base64,'.base64_encode($row['img']).'" title="點我更換頭貼">';
                }
                ?>
                <!----------------------------------------->
            </div>
            <div class="col-5">
                <div class="inner-col">
                    <?php
                        echo 
                        '<h2><i class="fas fa-user" style="color: #E7E7E7; margin-right: 0.5em"></i>'.$_SESSION['name'].'</h2>
                        <h2><i class="fas fa-envelope" style="color: #E7E7E7; margin-right: 0.5em"></i>'.$row['mail'].'</h2>';
                    ?>
                </div>
                <form action="profile_edit.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="new" placeholder="" autocomplete="nope">
                    <input type="password" name="password" placeholder=""  autocomplete="nope">
                    <input type="hidden" name="page" value="">
                    <input type="file" name="img" accept=".jpg, .jpeg, .png*" style="display: none;">
                    <button>送出</button>
                </form>
            </div>
            <div class="col-3">
                <button>修改信箱</button>
                <button>修改名稱</button>
                <button>修改密碼</button>
            </div>
        </section>
        <section class="bottom">
        	<div class="triangle"><i class="fas fa-trophy" style="color: #FFD15C; font-size: 2em; position: absolute; top: 0.4em; left: 0.4em"></i></div>
        	<img src="img/logo1.png" class="logo">
        	<img src="img/logo.png" class="logo">
        </section>
    </article>
    <script type="text/javascript">
    let logo_state = <?php echo json_encode(explode(',',$row['logo'])); ?>;
    let voice = <?php include('voice.php'); ?>; //for spider
    for(let i=0; i<3; i++){ //右方按鈕
        $('.col-3 button').eq(i).on('click', function(e){
        	if(i === 0){ //信箱
        		 $('input[name="new"]').attr({'placeholder': '請輸入新信箱', 'type': 'email'});
        		 $('input[name="password"]').attr('placeholder', '請輸入密碼');
        	}else if(i === 1){ //名稱
        		$('input[name="new"]').attr({'placeholder': '請輸入新名稱', 'type': 'text'});
        		$('input[name="password"]').attr('placeholder', '請輸入密碼');
        	}else{ //密碼
        		$('input[name="new"]').attr({'placeholder': '請輸入新密碼', 'type': 'text'});
        		$('input[name="password"]').attr('placeholder', '請再次輸入新密碼');
        	}
            $('input[type="hidden"]').attr('value', i);
            $('.col-3 button').each(function(){
                $(this).css('background-color', '#666666');
            })
            $(e.target).css('background-color', '#424242');
            if($('form').hasClass('visible')){
                $('form').removeClass('visible');
                setTimeout(function(){
                    $('form').addClass('visible');
                }, 500);
            }else{
               $('form').addClass('visible'); 
            }
            
        })
    }
    logo_state.forEach(function(value,index){
        if(value === '0'){
            $('.logo').eq(index).css({
                '-webkit-filter': 'brightness(0.2)',
                'filter': 'brightness(0.2)'
            });
        }
    })
    $('#back').on('click', function(){
            history.back();
    })
     $('#sign_out').on('click', function(e){
        location.href = 'sign_up.php';
    })
    $('#user-pt img').on('click', function(){
        $('input[type="file"]').click();
        $('input[type="file"]').on('change', function(){
            $('form button').click();
        })
    })
    </script>
    <script type="text/javascript" src="spider/spider.js"></script>
</body>

</html>