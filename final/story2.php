<?php
    session_start();
    include('connect.php');
    if(isset($_SESSION['name'])){
        $sth = $dbh->prepare('SELECT logo FROM account WHERE name = ?');
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
    <title>逃出絕命政-研究大樓</title>
    <link rel="shortcut icon" type="image/png" href="https://chite.000webhostapp.com/img/photo.png">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="spider/spider.css">
    <style type="text/css">
    html,
    body {
        margin: 0;
        padding: 0;
        background-color: black;
    }

    article {
        width: 80%;
        height: 100%;
        margin: auto;
        color: white;
    }

    .bg {
        width: 100%;
        height: auto;
        margin-top: 10em;
    }

    h2 {
        font-family: 'Noto Sans TC', sans-serif;
        position: relative;
    }
    #text {
    	white-space: pre;
    }

    #end h2 {
        text-align: left;
        line-height: 2em;
        font-size: 1em;
    }

    .keyword {
        z-index: 101;
    }

    #button_out {
        position: absolute;
        width: 3vw;
        height: 2vw;
        background-color: #F8EA8A;
        border: gray 0.2px solid;
    }

    #button_in {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 1vw;
        height: 1vw;
        background-color: #EEE9D6;
    }

    #button2_out {
        position: absolute;
        width: 3vw;
        height: 2vw;
        opacity: 0;
        z-index: 101;
    }

    #button2_out:hover {
        background-color: rgba(191, 191, 191, 0.3);
    }

    #hair {
        position: absolute;
        width: 2vw;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        background-color: black;
        -webkit-transition: height 2s 0s;
        -o-transition: height 2s 0s;
        transition: height 2s 0s;
    }

    #hair:hover {
        opacity: 0.7;
    }

    #back:hover,
    #sign_out:hover {
        opacity: 0.8;
    }

    #back {
        position: fixed;
        right: 0.5em;
        bottom: 0.5em;
        color: white;
        font-size: 2.5em;
    }

    #sign_out {
        position: fixed;
        right: 0.5em;
        bottom: 2em;
        font-size: 2.5em;
    }

    .first_section {
        opacity: 0;
    }

    .searchlight {
        visibility: hidden;
        position: absolute;
        z-index: 10;
        border-width: 100vh 100vw;
        border-style: solid;
        border-color: #000;
        top: -100vh;
        left: -100vw;
        background: #000;
        -moz-box-sizing: content-box;
        -webkit-box-sizing: content-box;
        -ms-box-sizing: content-box;
        box-sizing: content-box;
    }

    .searchlight.on {
        background: -moz-radial-gradient(center, ellipse cover, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 50%, #000000 60%, #000000 100%);
        background: -webkit-radial-gradient(center, ellipse cover, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 50%, #000000 60%, #000000 100%);
        background: -o-radial-gradient(center, ellipse cover, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 50%, #000000 60%, #000000 100%);
        background: -ms-radial-gradient(center, ellipse cover, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 50%, #000000 60%, #000000 100%);
        background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 50%, #000000 60%, #000000 100%);
    }
    img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]{
        display:none!important;
    }

    @media only screen and (min-width: 991px) {
        .group,
        h2 {
            text-align: center;
        }

        #end h2 {
            line-height: 1.5em;
            font-size: 1.5em;
        }
    }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
</head>

<body>
    <?php
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        $logo = explode(',', $row['logo']);
        if($logo[1] !== '1'){
            $logo[1] = '1';
            $logo = implode(',',$logo);
            $sth = $dbh->prepare('UPDATE account SET logo = ? WHERE name = ?');
            $sth->execute(array($logo, $_SESSION['name']));
        }
    ?>
    <!------------spider------------------->
    <img id="menu" src="img/menu.png">
    <img src="img/account.png" class="icon vis" id="account">
    <img src="img/voice.png" class="icon vis" id="voice">
    <img src="img/forum.png" class="icon vis" id="forum">
    <audio autoplay loop></audio>
    <!------------spider------------------->
    <i class="fas fa-arrow-alt-circle-left" id="back"></i>
    <i class="fas fa-sign-out-alt" style="color: white;" title="登出" id="sign_out"></i>
    <article>
        <img src="img/room2/main.jpg" class="bg first_section">
        <h2 class="first_section">這裡是研究大樓，唯一一座養著金魚的教學大樓。<br>(&nbsp;雖然最近似乎沒養了&nbsp;)</h2>
        <img src="img/room2/classroom.jpg" class="bg first_section">
        <h2 class="first_section">（上課中<span id="text"></span>）</h2>
        <h2 class="first_section">肚子好痛！趕快去廁所吧 ．．．</h2>
        <img src="img/room2/tol_outside.jpg" class="bg first_section">
        <img src="img/room2/tol_in1.jpg" class="bg first_section" id="tol_in1">
        <div id="button2_out" class="button first_section"></div>
        <div id="button_out" class="first_section">
            <div id="button_in" class="first_section"></div>
        </div>
        <h2 class="first_section keyword">啊！怎麼停電了</h2>
        <h2 class="first_section keyword">快找找看開關在哪</h2>
        <section>
            <img src="img/room2/tol_in2.jpg" class="bg">
            <h2>總算可以好好上廁所</h2>
            <img src="img/room2/tol_in2.jpg" class="bg" id="bathroom">
            <div id="hair"></div>
            <h2>上完廁所沖個水</h2>
        </section>
        <section>
            <img src="img/room2/pull.jpg" class="bg">
            <h2>咦？這裡有沖水閥，那我拉的是．．．</h2>
            <img src="img/room2/ghost.jpg" class="bg">
            <section id="end">
                <br>
                <br>
                <h2>
                    不見陽春煙景，也無大塊文章，夕陽西下，是誰在紅磚道上淚灑楓葉荻花？校園內鐘聲響徹雲霄，她心中悲鳴蕩氣迴腸。大樓邊人群匆匆，但她眼眶裡容不下多一個人影，目光只牢牢鎖死在對街那男女身上。縱使世界再喧囂，他那熟悉的聲音仍然穿梭人潮，進入她耳裡。再熟悉不過的歡笑，如今是與陌生人分享；再接近不過的距離，如今成為了最遙遠的彼方。冷風颯颯，卻有股火辣的電流從她的胸口衝上頭頂，她下定決心，要為這由謊言編織而成的一切拉下帷幕……
                    <br>
                    晚間九點半，一名男學生忍著肚子疼痛跑進研究大樓。進了廁所，才剛關上門就聽到急促的腳步聲跟了過來，緊接著是隔壁廁所的門「碰」一聲的關上。他本來不怎麼在意，但伴隨著隔壁傳來的啜泣聲，他拉鍊拉到一半的手停了下來。這時，塑膠隔牆開始震動，他嚇的趕緊穿好褲子，盯著牆壁看。沒過多久，隔壁間就安靜了下來，讓他鬆了一大口氣。他轉過身來，突然肩頭一癢，伸手一抓竟然抓到一束頭髮。
                    <br>
                    男學生嚇的罵了聲髒話，抬頭才看到一個女生上半身從隔間上探出來，而那個人正是他前女友。突然一個重物直朝腦門飛來，讓他差點暈了過去。男生見她眼神空洞，意識到前女友現在只想置自己於死地……。兩人扭打了好一陣子，男生逮到機會奮力將她按在牆上，但女生仍然死命掙扎，男生隨著憤怒逐漸喪失了理智。他掐住了女生的脖子，女生的尖叫聲越來越微弱、慢慢變成了斷斷續續的咯咯聲，但男生還是不肯放手，直到她雙眼一翻，身體瞬間癱軟、垂吊在隔間上。
                    <br>
                    從那之後，校園內開始流傳，在研究大樓上男廁絕對不能抬頭、要牢記廁所是用腳踏沖水而不是沖水拉環。否則會看到隔間上出現垂吊的屍體、手會抓到來路不明的一束頭髮……
                </h2>
                <img src="img/room2/ghost1.jpg" class="bg">
            </section>
        </section>
    </article>
    <div class="searchlight"></div>
    <script type="text/javascript">
    window.onload = function(){
        let voice = <?php include('voice.php'); ?>; //for spider
    	$('section').fadeOut(0); //初始化
	    //宣告
	    let $bg = $('.bg');
	    let buttonHeight = $bg.height() / 2;
	    let buttonWidth = $bg.width() / 2;
	    let hairX = $bg.width();
	    $('#button_out, #button2_out').css({
	        '-webkit-transform': 'translate(' + buttonWidth + 'px, -' + buttonHeight + 'px)',
	        '-moz-transform': 'translate(' + buttonWidth + 'px, -' + buttonHeight + 'px)',
	        '-ms-transform': 'translate(' + buttonWidth + 'px, -' + buttonHeight + 'px)',
	        '-o-transform': 'translate(' + buttonWidth + 'px, -' + buttonHeight + 'px)',
	        'transform': 'translate(' + buttonWidth + 'px, -' + buttonHeight + 'px)'
	    });

	    //偵測按鈕點擊
	    $('.button').on('click', function(){
	        $('section').eq(0).fadeIn(3000);
	        $('#hair').css({
	            'top': $('#bathroom').offset().top,
	            'height': buttonHeight,
	            'left': hairX
	        });
	        $('.searchlight').fadeOut(0); //手電筒消失
	    })
	    //偵測頭髮點擊
	    $('#hair').on('click', function(){
	        $('section').eq(1).fadeIn(3000);
	        $('#hair').css('height', 8 / 5 * buttonHeight);
	    })

	    $('#back').on('click', function(){ //返回鍵
	        history.back();
	    })
	    $('#sign_out').on('click', function(e){ //登出鍵
	        location.href = 'sign_up.php';
	    })
	    searchlightTop = $('.searchlight').offset().top + $('#tol_in1').offset().top;
	    $('.searchlight').css("top", searchlightTop); //設定手電筒位置

	    $(window).on('scroll', function() { //圖片滑入動畫
	        bottom_of_window = $(window).scrollTop() + $(window).height(); //視埠的底部(上方加高)
	        let $end = $('#end');
	        let end = $end.offset().top; //結尾元素位置
	        $('.first_section').each(function() {
	            let bottom_of_object = $(this).offset().top; //圖片元素位置
	            if (bottom_of_window > bottom_of_object) {
	                $(this).animate({ 'opacity': '1' }, 1000);
	            }
	        });
	        if (bottom_of_window > end && $end.parent().css('display') !== 'none') {
	            $end.fadeIn(4000);
	        }

	        if (bottom_of_window > $('#tol_in1').offset().top + $('#tol_in1').height()) {
	            $('.searchlight').css({
	                "visibility": "visible",
	                "height": "200px",
	                "width": "200px"
	                }); //手電筒出現
	        }

	    })
	    //打字效果
	    let $text = $('#text');
	    let text = '．';
	    let count = 0;
	    (function printText(){
	    	let blank = '　　';
	    	blank = blank.substr(0, 2 - count);
	    	if(count < 4){
		    	$text.text($text.text().replace(/\s/g,'') + text + blank);
		    	count ++;
		    }
		    if(count > 3){
		    	$text.text('　　　');
		    	count = 0;
		    }
		    setTimeout(printText, 1000);
	    })()
	    
	    //spotlight
	    $('.searchlight, #button2_out').on('mousemove', function(event) {
	        let $searchlight = $('.searchlight');
	        if (!$searchlight.hasClass('on')) {
	            $searchlight.addClass('on');
	        } else {
	            $searchlight.css({
	                'margin-left': event.pageX - $('.searchlight').width() / 2,
	                'margin-top': event.pageY - $('#tol_in1').offset().top - $('.searchlight').height() / 2
	            });
	        }
	    })
    }
    </script>
    <script type="text/javascript" src="spider/spider.js"></script>
</body>

</html>