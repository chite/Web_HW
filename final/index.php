<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="政大鬼故事" >
    <meta property="og:image" content="https://chite.000webhostapp.com/img/photo.png">
    <meta property="og:description" content="政大鬼故事👻" >
    <link rel="shortcut icon" type="image/png" href="https://chite.000webhostapp.com/img/photo.png">
    <title>Ghost Story</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
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
     /*------------spider-------------------*/
    #menu{
        top: -30em;
        left: 1em;
        position: absolute;
        -webkit-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
        z-index: 4;
    }
    .icon{
        left: 3em;
        position: absolute;
        -webkit-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
        z-index: 5;
    }
    #menu.menuMove {
        -webkit-transform: translate(0, 20em);
            -ms-transform: translate(0, 20em);
                transform: translate(0, 20em);
    }
    .icon.vis {
        -webkit-transform: translate(0, -28em);
            -ms-transform: translate(0, -28em);
                transform: translate(0, -28em);
    }
    /*------------spider-------------------*/

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
   /*------------spider-------------------*/
    #menu {
        -webkit-transform: scale(0.5, 0.5);
            -ms-transform: scale(0.5, 0.5);
                transform: scale(0.5, 0.5);
        top: -25em;
        left: 0em;
        
    }

    #menu.menuMove {
        -webkit-transform: translate(0, 10em) scale(0.5, 0.5);
            -ms-transform: translate(0, 10em) scale(0.5, 0.5);
                transform: translate(0, 10em) scale(0.5, 0.5);
    }

    .icon {
        -webkit-transform: scale(0.5, 0.5);
            -ms-transform: scale(0.5, 0.5);
                transform: scale(0.5, 0.5);
        left: 1.8em;
    }
    /*------------spider-------------------*/
    }
    </style>
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
    doorHover.hover(() => {
        door1.css('left', '45vw');
        door2.css('left', '52vw');
    }, () => {
        door1.css('left', '46.5vw');
        door2.css('left', '50vw');
    });
    doorHover.on('click', () => {
        location.href = "login1.php";
    });
    button.on('click', () => {
        location.href = "login1.php";
    })
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