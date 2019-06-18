<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="逃出絕命政" >
    <meta property="og:image" content="https://chite.000webhostapp.com/img/photo.png">
    <meta property="og:description" content="👻👻👻" >
    <title>逃出絕命政-登入</title>
    <link rel="shortcut icon" type="image/png" href="https://chite.000webhostapp.com/img/photo.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="spider/spider.css">
    <style type="text/css">
    html,
    body {
        height: 100%;
        background: #333333;
    }

    * {
        padding: 0;
        margin: 0;
    }

    #pancel {
        display: inline-block;
        vertical-align: middle;
        background: #0B263A;
        border-radius: 20px;
        width: 90%;
        height: 90%;
    }

    #photo { 
    	width: auto;
    	height: auto;
    	max-width: 40%;
        max-height: 40%;
        display: block;
        margin: 2em auto;
    }

    .pancel-box {
        display: block;
        font-size: 0;

    }

    .pancel-box i {
        font-size: 30px;
        color: #E6E6E6;
    }

    .pancel-box input {
        width: 70%;
        border: #B3B3B3 solid 0.1em;
        font-family: 'Noto Sans TC', sans-serif;
        border-radius: 10px;
        font-size: 1.5rem;
        margin: 0 0 1em 0.5em;
    }

    input::-webkit-input-placeholder {
        text-align: center;
    }

    input:-moz-placeholder {
        text-align: center;
    }

    input::-moz-placeholder {
        text-align: center;
    }

    input:-ms-input-placeholder {
        text-align: center;
    }

    span {
        margin-top: 0.5rem;
        color: white;
        font-size: 1rem;
        font-family: 'Noto Sans TC', sans-serif;
    }

    span:hover {
        opacity: 0.5;
        cursor: pointer;
    }

    button,
    label {
        margin: 0 0.5rem;
        background-color: #B3B3B3;
        border: none;
        font-family: 'Noto Sans TC', sans-serif;
        font-size: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 10px;
    }

    button:hover {
        opacity: 0.8;
    }

    #eleBor {
        width: 10%;
        position: relative;
        top: 50%;
        right: 5%;
        -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
                transform: translateY(-50%);
        height: auto;
        float: right;

    }

    .box-one {
        visibility: visible;
        opacity: 1;
        -webkit-transition: opacity 2s 0s;
        -o-transition: opacity 2s 0s;
        transition: opacity 2s 0s;
    }

    .box-two, .box-three {
        visibility: hidden;
        height: 0;
        opacity: 0;
        overflow: hidden;
        -webkit-transition: opacity 2s 0s;
        -o-transition: opacity 2s 0s;
        transition: opacity 2s 0s;
    }
    img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]{
        display:none!important;
    }

    @media only screen and (min-width : 992px) {
        #door {
            width: 60%;
            height: 100%;
            background: #666666;
            border-left: #1A1A1A solid 30px;
            border-right: #1A1A1A solid 30px;
            margin: 0 auto;
            -webkit-box-sizing: border-box;
                    box-sizing: border-box;
            text-align: center;
        }

        #door::before {
            content: '';
            display: inline-block;
            vertical-align: middle;
            height: 100%;
        }
    }

    @media only screen and (max-width: 991px) {

        #door,
        #pancel {
            width: 100%;
            height: 100%;
            text-align: center;
        }

        #photo {
            width: 50%;
            height: auto;

        }

        #eleBor {
            display: none;
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
    <img id="eleBor" src="img/elevatorUI.png">
    <div id="door">
        <div id="pancel">
            <img src="img/photo.png" id="photo">
            <div class="pancel-box box-one">
                <form action="login.php" method="post">
                    <i class="fas fa-user"></i><input type="text" name="name" placeholder="使用者名稱" required>
                    <br>
                    <i class="fas fa-lock"></i><input type="password" name="password" placeholder="使用者密碼" required>
                    <br>
                    <span>註冊帳號</span>
                    <button type="submit">登入</button>
                    <span>忘記密碼</span>
                </form>
            </div>
            <div class="pancel-box box-two">
                <form action="login.php" method="post" enctype="multipart/form-data">
                    <i class="fas fa-user"></i><input type="text" name="reg_name" placeholder="使用者名稱" required>
                    <br>
                    <i class="fas fa-envelope"></i><input type="email" name="reg_mail" placeholder="使用者信箱" required>
                    <br>
                    <i class="fas fa-lock"></i><input type="password" name="reg_password" placeholder="使用者密碼" required>
                    <br>
                    <i class="fas fa-lock"></i><input type="password" name="reg_password2" placeholder="確認使用者密碼" required>
                    <br>
                    <span id="remind"></span>
                    <label><input type="file" name="reg_file" accept=".jpg, .jpeg, .png*" style="display:none">上傳頭貼</label>
                    <button type="submit">註冊</button>
                </form>
            </div>
            <div class="pancel-box box-three">
                <form action="login.php" method="post">
                    <i class="fas fa-user"></i><input type="text" name="forget_name" placeholder="使用者名稱" required>
                    <br>
                    <i class="fas fa-envelope"></i><input type="email" name="forget_mail" placeholder="使用者信箱" required>
                    <br>
                    <i class="fas fa-key"></i><input type="password" name="forget_password" placeholder="設定新密碼" required>
                    <br>
                    <button type="submit">回上一頁</button>
                    <button type="submit">修改密碼</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    let voice = <?php include('voice.php'); ?>; //for spider
    let span = $('span');
    let pancelBox = $('.pancel-box');
    let uploadPT = $("input[type='file']");
    let toPreviosPage = $('.box-three button');
    uploadPT.on('change', function(){
        if(this.files[0]){
            if(this.files[0].size / 1024 > 100){
                alert('檔案過大，請更換至100KB以下的圖片');
            }else{
                let reader = new FileReader();
                reader.readAsDataURL(this.files[0]);
                reader.onload = function(e){
                    $('#photo').attr('src', e.target.result);
                }
            }
        }
    })
    span.eq(0).on('click', function(){
        $('.box-one').css({
            'visibility': 'hidden',
            'height': 0,
            'overflow': 'hidden',
            'opacity': 0
        });
        $('.box-two').css({
            'visibility': 'visible',
            'height': 'auto',
            'opacity': 1
        })
    })
    span.eq(1).on('click', function(){
        $('.box-one').css({
            'visibility': 'hidden',
            'height': 0,
            'overflow': 'hidden',
            'opacity': 0
        });
        $('.box-three').css({
            'visibility': 'visible',
            'height': 'auto',
            'opacity': 1
        })
    })
    toPreviosPage.eq(0).on('click', function(e){
        e.preventDefault();
        $('.box-one').css({
            'visibility': 'visible',
            'height': 'auto',
            'opacity': 1,
        });
        $('.box-three').css({
            'visibility': 'hidden',
            'height': 0,
            'overflow': 'hidden',
            'opacity': 0
        })
    })
    $('input[name="reg_password2"]').on('keyup keydown', function(){
    	if($('input[name="reg_password2"]').val() !== $('input[name="reg_password"]').val()){
    		$('#remind').text('密碼驗證不一致');
    	}else{
    		$('#remind').text('');
    	}
    })
    </script>
    <script type="text/javascript" src="spider/spider.js"></script>
</body>

</html>