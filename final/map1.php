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
die();
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
    <title>Map</title>
    <link rel="shortcut icon" type="image/png" href="https://chite.000webhostapp.com/img/photo.png">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="" />
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <style type="text/css">
    html,
    body {
        margin: 0;
        padding: 0;
        background-color: #0B0A2C;
        overflow: hidden;
    }

    h2 {
        color: white;
        position: absolute;
        width: 80%;
        top: 99%;
        left: 50%;
        transform: translate(-50%, -100%);
        margin: 0 auto;
        z-index: 3;
        font-family: 'Noto Sans TC', sans-serif;
        text-align: center;
        font-size: 1em;
    }

    #mapid {
        width: 100%;
        height: 70vh;
        margin: 0.5em auto 0;
        z-index: 1;
    }

    #gossip {
        width: 10em;
        height: auto;
        position: absolute;
        margin: auto;
        top: 70vh;
        left: 0;
        right: 0;
        z-index: 2;
        transform: rotate(360deg);
        transition: transform 3s 0s;
    }

    #gossip:hover {
        filter: brightness(0.8);
    }

    section {
        position: absolute;
        width: 60vw;
        /*height: 22vh;*/
        visibility: hidden;
        height: 0;
        overflow: hidden;
        opacity: 0;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        background-color: rgba(179, 179, 179, 0.8);
        z-index: 2;
        border-radius: 0.8em;
        padding: 0.5em;
        box-sizing: border-box;
        transition: all 1.5s 0s;
    }

    section p {
        color: white;
        margin: 0;
        font-size: 1.3em;
        font-family: 'Noto Sans TC', sans-serif;
        position: relative;
        text-align: center;
        top: 50%;
        transform: translateY(-50%);
    }
    .top-icons {
        float: right;
        margin: 0.2em 0;
    }
    .clear{
        clear: both;
        display: block;
        content: '';
    }
    #sign_out{
        margin-left: 0.5em;
        margin-right: 0.1em;
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
        #mapid {
            width: 90%;
        }
        #sign_out{
            margin-right: 5vw;
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
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
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
    <div class="top-icons">
        <i class="fas fa-arrow-alt-circle-left fa-2x" id="back" style="color: white;"></i>
        <i class="fas fa-sign-out-alt fa-2x" style="color: white;" title="登出" id="sign_out"></i>
    </div>
    <span class="clear"></span>
    <div id="mapid"></div>
    <h2>Waiting...</h2>
    <img id="gossip" src="img/gossip.png" alt="gossip">
    <section>
        <p></p>
    </section>
    <script type="text/javascript">
    let $h2 = $('h2');
    let $gossip = $('#gossip');
    let mymap = L.map('mapid');
    let marker, inter, remindInter;
    let playPos = 0;
    let $pop = $('section');
    let $popContent = $('section p');
    //初始化
    mymap.setView([24.986172, 121.576440], 18);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '<a href="https://www.openstreetmap.org/">OSM</a>',
        maxZoom: 18,
    }).addTo(mymap);
    marker = L.marker([24.986172, 121.576440]).addTo(mymap);
    remind();
    //map測試裝置
    if ("geolocation" in navigator) {
        inter = setInterval(() => {
            getLocation();
        }, 5000);
    } else {
        $h2.text('抱歉，您的裝置不支援部分功能');
    }

    function getLocation() {
        let options = {
            enableHighAccuracy: true,
            maximumAge: 10000,
            timeout: 5000
        };

        function success(pos) {
            clearInterval(remindInter);
            console.log(pos.coords.longitude + ", " + pos.coords.latitude);
            playPos = [pos.coords.latitude, pos.coords.longitude];
            mymap.setView([pos.coords.latitude, pos.coords.longitude], 18, { animation: true });
            marker.setLatLng([pos.coords.latitude, pos.coords.longitude]).update();
            remind();
        }

        function error(err) {
            clearInterval(remindInter);
            if (err.code == 1) {
                $h2.text('抱歉，遊戲無法取得您裝置的地理位置權限，請開啟GPS或至瀏覽器\"設定\"開啟權限');
            } else if (err.code == 2) {
                $h2.text('抱歉，資料回傳失敗，系統將再進行嘗試');
            } else if (err.code == 3) {
                $h2.text('連線逾時，系統將再進行嘗試');
            } else {
                $h2.text('發生錯誤，系統將再進行嘗試');
            }
        }
        navigator.geolocation.getCurrentPosition(success, error, options);
    }

    function remind() {
        let count = 5;
        remindInter = setInterval(() => {
            $h2.text(count + " 秒後重新鎖定位置");
            count--;
            if (count < 0) {
                count = 5;
                clearInterval(remindInter);
            }
        }, 1000);
    }
    //點擊八卦圖
    console.log()
    $gossip.on('click', () => {
        let values = $gossip.css('transform').split('(')[1].split(')')[0].split(',');
        let formData = new FormData();
        formData.append('position', playPos);
        if (values[1] == 0 && values[2] == 0) {
            $gossip.css('transform', 'rotate(360deg)');
        } else {
            $gossip.css('transform', 'rotate(0deg)');
        }
        if (playPos[0] > 24.987710 && playPos[0] < 24.988657 && playPos[1] > 121.576736 && playPos[1] < 121.577608) {
            popContent('莊外');
        } else if(playPos[0] > 24.98709 && playPos[0] < 24.98746 && playPos[1] > 121.576247 && playPos[1] < 121.57671){
            popContent('研究大樓');
             setTimeout(()=>{
                location.href = 'story2.php';
            }, 5000);
        } else if(playPos[0] > 24.985674 && playPos[0] < 24.986664 && playPos[1] > 121.573192 && playPos[1] < 121.574){
            popContent('綜合院館');
             setTimeout(()=>{
                location.href = 'story1.php';
            }, 5000);
        } else {
            popContent('這裡目前很乾淨，沒有冤魂存在，至少現在是這樣，晚點再回來看看吧');
           
        }
    })

    function popContent(content) {
        $popContent.text(content);
        $pop.css({
            'visibility': 'visible',
            'height': '22vh',
            'opacity': '1'
        })
        setTimeout(() => {
            $pop.css({
                'visibility': 'hidden',
                'height': '0',
                'opacity': '0'
            })
        }, 3000);

    }
    $('#back').on('click', ()=>{
            history.back();
    })
     $('#sign_out').on('click', e =>{
        location.href = 'sign_up.php';
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