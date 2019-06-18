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
    <meta property="og:title" content="逃出絕命政">
    <meta property="og:image" content="https://chite.000webhostapp.com/img/photo.png">
    <meta property="og:description" content="👻👻👻" >
    <title>逃出絕命政-綜合院館</title>
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

    .girl {
        width: 10vw;
        height: auto;
        position: absolute;
        z-index: 99;
        margin: 0 auto;
        left: 0;
        right: 0;
    }

    h2 {
        font-family: 'Noto Sans TC', sans-serif;
    }

    .group {
        margin: 1.5em auto;
    }

    .group button,
    .group input {
        background-color: gray;
        border: none;
        border-radius: 0.5em;
        padding: 0.5em;
        font-size: 1.5em;
        color: white;
        font-family: 'Noto Sans TC', sans-serif;
        display: inline-block;
        width: 5em;
        outline: none;
    }

    .group input {
        border-radius: 0;
        background-color: white;
        color: black;
        margin: 1em 0;
    }

    button:hover, #back:hover, #sign_out:hover {
        opacity: 0.8;
    }

    #end h2 {
        text-align: left;
        line-height: 2em;
        font-size: 1em;
    }
    #back {
        position: fixed;
        right: 0.5em;
        bottom: 0.5em;
        color: white;
        font-size: 2.5em;
    }
    #sign_out{
        position: fixed;
        right: 0.5em;
        bottom: 2em;
        font-size: 2.5em;
    }
    .wrapper{
    	position: relative;
    }
    img[src="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]{
        display:none!important;
    }

    @media only screen and (min-width: 991px) {
        .group, h2  {
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
        if($logo[0] !== '1'){
            $logo[0] = '1';
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
        <img src="img/room1/綜院大廳(解析度低).jpg" class="bg">
        <h2>???：「葛葛（姐結），可以幫我一個忙嗎？」</h2>
        <div class="wrong">
            <h2>（太壞了吧．．．）</h2>
        </div>
        <div class="group">
            <button value="ok">好</button>
            <button value="no">不好</button>
        </div>
        <!-- 1 -->
        <section>
    		<img src="img/room1/綜院大廳(解析度低).jpg" class="bg">
    		<div class="wrapper">
            	<img src="img/room1/資產 31.png" class="girl">
        	</div>
            <h2>小女孩：「媽媽跟我約在270415教室，但我一直找不到」</h2>
            <img src="img/room1/綜院415(小)-15.jpg" class="bg">
            <?php
                echo '<h2> 小女孩：「'.$_SESSION['name'].'，我口好渴喔」</h2>';
            ?>
            <img src="img/room1/販賣機（無標價）-13.jpg" class="bg">
            <div class="wrapper">
            	<img src="img/room1/資產 31.png" class="girl">
        	</div>
            <h2> 小女孩：「可以幫我買蘋果紅茶嗎？」</h2>
            <div class="wrong">
                <h2> 投入的硬幣價格不對．．．</h2>
                <h2> 小女孩：「嗚嗚，還沒買好嗎？」</h2>
            </div>
            <div class="group">
                <input type="text" placeholder="輸入價格" id="price">
                <button>確認</button>
            </div>
        </section>
        <!-- 2 -->
        <section>
            <img src="img/room1/綜院電梯前(小).jpg" class="bg">
            <h2> 小女孩消失了</h2>
            <img src="img/room1/電梯內（關門）（小）-15.jpg" class="bg">
            <h2> 離開這鬼地方吧</h2>
            <h2> 去幾樓?</h2>
            <div class="group">
                <input type="number" min="1" max="16" step="1" class="floor">
                <button>確認</button>
            </div>
        </section>
        <!-- 3 開門無人-->
        <div class="no_one">
        </div>
        <!-- 4 小女孩-->
        <section id="success">
            <img src="img/room1/inside.jpg" class="bg">
            <div class="wrapper">
            	<img src="img/room1/資產 31.png" class="girl">
            </div>
            <h2> 小女孩：「我在這裡迷路了好久了，謝謝你」</h2>
            <section id="end">
                <br>
                <br>
                <h2>
                    據傳某次校慶連假時有個男大生，半夜在綜院尾隨一名女同學，趁著四下無人之時，將女學生強行拉進一間教室當中。
                    <br>
                    男大生當晚強姦了女學生，隨後迅速逃離現場，留下孤單無助的女孩在教室中跪地啜泣。
                    <br>
                    多年過後，男大生再度回到了政大成為了博士生，但他並不知道當時那個女孩懷上了自己的身孕，無法承擔迎接新生命所帶來的後果，帶著即將出生的嬰兒一起自殺。推算起來，如果當時女學生生下了嬰兒，現在大概已經在讀小學了。
                    <br>
                    博士生開學後，天天在綜院上課、做研究，但他總是感覺到一股說不出所以來的怪異感受。有時他會在綜院當中走著走著就繞回到原點、搭電梯的途中每層樓都停卻都沒有人進來、明明上一秒自己還在一樓走路，下一秒突然發現已經莫名其妙來到了四樓。他也注意到，有一個綁馬尾小女孩常常會在晚上的綜院裡出沒，他推測大概是某個教職員的小孩。
                    <br>
                    就這樣過了快一年，又到了一年一度的校慶，但博士生卻失蹤了。
                    <br>
                    <span style="color: red">校園裡流傳著一件事：「有一個博士生在綜院跳樓，他手上抓著一個女孩的髮圈」。<span>
                </h2>
                <img src="img/room1/封鎖線_工作區域 1.jpg" class="bg">
            </section>
        </section>
    </article>
    
    <script type="text/javascript">
    window.onload = function(){
        let voice = <?php include('voice.php'); ?>; //for spider
        let $girl = $('.girl');   
        let girl_height = $girl.height();
        let eleCount = 0
        $('section').fadeOut(0); //隱藏下方內容
        $('.wrong').fadeOut(0);
        $('article').on('click', 'button', function(e){ //第一個點擊事件
            if (e.target.value == 'ok') {
                if ($('.wrong').eq(0).css('display') !== 'none') {
                    $('.wrong').eq(0).fadeOut(0);
                }
                $('section').eq(0).fadeIn(2000);
            } else if(e.target.value == 'no'){
                if ($('.wrong').eq(0).css('display') !== 'none') {
                    $('.wrong').eq(0).fadeOut(0).fadeIn(1000);
                } else {
                    $('.wrong').eq(0).fadeIn(1000);
                }
            }
            if ($('#price').val() === '25') { //第二個點擊事件
                $('section').eq(1).fadeIn(2000);
                if ($('.wrong').last().css('display') !== 'none') {
                    $('.wrong').last().fadeOut(0);
                }
            } else if($('#price').val() !== '' && $('#price').val() !== '25'){
                if ($('.wrong').last().css('display') !== 'none') {
                    $('.wrong').last().fadeOut(0).fadeIn(1000);
                } else {
                    $('.wrong').last().fadeIn(1000);
                }
            }

            if ($('.floor').last().val() === '1') { //第三個點擊事件，如果到一樓
                $('#success').fadeIn(2000);
            } else if ($('.floor').last().val() !== '1' && $('.floor').last().val() !== '' && $('.floor').last().val() < 17) { //如果到其他樓
                $('.no_one').append('<section style="opacity: 0" class="no_one_section"><img src="img/room1/電梯內（關門）（小）-15.jpg" class="bg"><h2>．．．．．．</h2><img src="img/room1/inside.jpg" class="bg"><h2> 這裡不是出口...去幾樓?</h2><div class="group"><input type="number" min="1" max="16" step="1" class="floor"> <button>確認</button></div></section>');
                $('.no_one').find('.no_one_section').last().animate({ 'opacity': '1' }, 1500);
            }
            girl();
        })
        function girl() {
            $girl.each(function() { //確定小女孩位置
                if ($(this).css('transform') === 'none') {
                    let girl_top = $(this).css("top").toString();
                    girl_top = Number(girl_top.replace(/px/, ""));
                    $(this).css({
                        "opacity": 0,
                        "-webkit-transform": "translateY(-" + girl_height + "px)",
                        "-ms-transform": "translateY(-" + girl_height + "px)",
                        "transform": "translateY(-" + girl_height + "px)"
                    });
                }
            });
        }

        $(window).on('scroll', function() {
            let bottom_of_window = $(window).scrollTop() + $(window).height(); //視埠的底部(上方加高)
            let $end = $('#end');
            let end = $end.offset().top; //結尾元素位置
            $('.girl').each(function() {
                let bottom_of_object = $(this).offset().top + $(this).outerHeight(); //小女孩元素底部位置
                if (bottom_of_window > bottom_of_object && $(this).parent().parent().css('display') !== 'none') {
                    $(this).animate({ 'opacity': '1' }, 1000);
                }
            });
            if (bottom_of_window > end && $end.parent().css('display') !== 'none') {
                $end.fadeIn(4000);
            }
        });
        $('#back').on('click', function(){
                history.back();
        })
        $('#sign_out').on('click', function(e){
            location.href = 'sign_up.php';
        })
    }
    </script>
    <script type="text/javascript" src="spider/spider.js"></script>
</body>

</html>