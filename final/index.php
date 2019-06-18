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
    <title>逃出絕命政</title>
    <link rel="shortcut icon" type="image/png" href="https://chite.000webhostapp.com/img/photo.png">
    <link rel="stylesheet" type="text/css" href="spider/spider.css">
    <style type="text/css">
    body,
    html {
        margin: 0;
        padding: 0;
        background: url('img/bg.png');
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;
        overflow: hidden;
    }

    #elevator {
        position: relative;
        width: 100%;
        height: auto;
        z-index: 3;
    }
    #door1,
    #door2 {
        position: absolute;
        background-color: #E6E6E6;
        border: 1px solid gray;
        z-index: 2;
    }

    #door-hidden {
        position: absolute;
        background: gray;
        opacity: 0.5;
        width: 7vw;
        height: 12.5vw;
        left: 46vw;
        top: 26.3vw;
        z-index: 1;
    }

    #doorHover {
        z-index: 99;
    }

    button {
        display: none;
    }
    img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]{
        display:none!important;
    }

    @media only screen and (max-width: 991px) {

        body {
            background-image: url('img/bg1.jpg');
            text-align: center;
        }

        #elevator {
            display: none;
        }

        div {
            display: none;
        }

        button {
            display: inline-block;
            position: relative;
            top: 47.5vh;
            vertical-align: middle;
            height: 22vh;
            width: 20%;
            background-color: #B8B8B8;
            color: white;
            border: none;
        }
    }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>

<body>
    <div id="door1"></div>
    <div id="door2"></div>
    <div id="door-hidden"></div>
    <img id="elevator" src="img/elevator.png">
    <div id="doorHover"></div>
    <!------------spider------------------->
    <img id="menu" src="img/menu.png">
    <img src="img/account.png" class="icon vis" id="account">
    <img src="img/voice.png" class="icon vis" id="voice">
    <img src="img/forum.png" class="icon vis" id="forum">
    <audio autoplay="autoplay" loop></audio>
    <!------------spider------------------->
    <button>開始遊戲</button>
    <script type="text/javascript">
    let voice = <?php include('voice.php'); ?>; //for spider
    let doors = $('#door1, #door2');
    let door1 = $('#door1');
    let door2 = $('#door2');
    let doorHover = $('#doorHover');
    let elevator = $('#elevator');
    let button = $('button');
    doorHover.css({
        'position': 'absolute',
        'width': '7vw',
        'height': '12.5vw',
        'top': '26.3vw',
        'left': '46.3vw',
    });
    doors.css({
        'width': '3.3vw',
        'height': '12.5vw',
        'top': '26.3vw',
    });
    door1.css({
        'left': '46.5vw',

    });
    door2.css({
        'left': '50vw',
    });
    doorHover.hover(function(){
        door1.css('left', '45vw');
        door2.css('left', '52vw');
    }, function(){
        door1.css('left', '46.5vw');
        door2.css('left', '50vw');
    });
    doorHover.on('click', function(){
        location.href = "login1.php";
    });
    button.on('click', function(){
        location.href = "login1.php";
    })
    </script>
    <script type="text/javascript" src="spider/spider.js"></script>
</body>

</html>