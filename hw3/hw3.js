let glo = {
    card_arr: [1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8],
    card_status: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
    turn: 0,
    firstNum: 0,
    secondNum: 0,
    firstIndex: 0,
    secondIndex: 0,
    counter: 0,
    finish: 0,
    inter: null
};

//initialize
glo.card_arr.sort(function(){
    return Math.random()-0.5;
});
for(let i = 1; i < 9; i ++){
	let img = new Image();
	img.src = "resources/" + i + ".png";
}
img = null;
$('.bor').hide();
$('section').fadeOut(0);
$(".img-element").each(
    function() {
        $(this).attr("src", "resources/bg_card.png");
    }
);
$(window).on('load', function() {
    $('.start').prop('disabled', false).text("開始");
});

//click card
$(".img-element").on("click", clickCard);

$('.start').on('click', function(e) {
    if ($('.counter').text() == "00 分 00 秒") {
        $('.start').blur().attr('disabled', true);
        glo.inter = setInterval(function() {
            if (!$('.start').hasClass('pauseInterval')) {
                glo.counter++;
            }
            $('.counter').text(('0' + Math.floor(glo.counter / 60)).slice(-2) + " 分 " + ('0' + Math.floor(glo.counter % 60)).slice(-2) + " 秒");
        }, 1000);
        $('.pause').prop('disabled', false);
    } else {
        $('.start').blur().prop('disabled', true).removeClass('pauseInterval');
        $('.pause').attr('disabled', false);
    }

});

$('.pause').on('click', function() {
    $(this).blur().prop('disabled', true);
    $('.start').attr('disabled', false).text('繼續').addClass('pauseInterval');
});

function clickCard() {
    if (glo.turn != 2 && glo.counter != 0 && !$('.pause').is(':disabled')) {
        let elementIndex = $(".img-element").index(this);
        if (glo.card_status[elementIndex] != 1) {
            $(".img-element").eq(elementIndex).addClass('flip');
            setTimeout(() => $(".img-element").eq(elementIndex).attr("src", "resources/" + glo.card_arr[elementIndex] + ".png").removeClass('flip'), 500);
            glo.card_status[elementIndex] = 1;
            if (glo.firstNum == 0) {
                glo.firstNum = glo.card_arr[elementIndex];
                glo.firstIndex = elementIndex;
                glo.turn = 1;
            } else {
                glo.secondNum = glo.card_arr[elementIndex];
                glo.secondIndex = elementIndex;
                glo.turn = 2;
                if (glo.firstNum != glo.secondNum) {
                    setTimeout(function() {
                        $(".img-element").eq(glo.firstIndex).addClass('flip');
                        $(".img-element").eq(glo.secondIndex).addClass('flip');
                        setTimeout(function() {
                            $(".img-element").eq(glo.firstIndex).attr("src", "resources/bg_card.png").removeClass('flip');
                            $(".img-element").eq(glo.secondIndex).attr("src", "resources/bg_card.png").removeClass('flip');
                            glo.card_status[glo.firstIndex] = 0;
                            glo.card_status[glo.secondIndex] = 0;
                            glo.firstNum = 0;
                            glo.secondNum = 0;
                            glo.firstIndex = 0;
                            glo.secondIndex = 0;
                            glo.turn = 0;
                        }, 500);
                    }, 2000);
                } else {
                    $.each(glo.card_status, function(index, val) {
                        if (val == 1) {
                            glo.finish++;
                        }
                    });
                    $("section").eq(glo.firstNum - 1).fadeIn(3000); //跑出文字
                    setTimeout(function() { //轉正面
                        //eyes
                        if (glo.finish != 16 && glo.firstNum == 8) {
                            eyes();
                        }
                        //finish
                        if (glo.finish == 16) { //結束
                            clearInterval(glo.inter);
                            $('.pause').prop('disabled', true);
                            $('.start').prop('disabled', false).text("重新開始").on('click', function() {
                                location.reload();
                            });
                        }
                        glo.firstNum = 0;
                        glo.secondNum = 0;
                        glo.firstIndex = 0;
                        glo.secondIndex = 0;
                        glo.turn = 0;
                        glo.finish = 0;
                    }, 1000);
                }
            }
        }
    }
}

function eyes() {
    $('.bor').show();
    $('.img-element').each(function(i) {
        $(this).css("pointer-events", "none");
        if (glo.card_status[i] == 0) {
            $(this).attr("src", "resources/" + glo.card_arr[i] + ".png").css({ "filter": "blur(2px)" });
        }
    });
    setTimeout(function() {
        $('.img-element').each(function(i) {
            $(this).css("pointer-events", "auto");
            if (glo.card_status[i] == 0) {
                $(this).attr("src", "resources/bg_card.png").css({ "filter": "none" });
            }
        });
        $('.bor').hide();
    }, 5000);
}