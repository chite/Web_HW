let card_arr = [1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6, 7, 7, 8, 8];
let card_status = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
let turn = 0;
let firstNum = 0;
let secondNum = 0;
let firstIndex = 0;
let secondIndex = 0;
let counter = 0;
let finish = 0;
let inter;

//initialize
change(card_arr);
$('.bor').hide();
$('section').fadeOut(0);
$(".img-element").each(
    function() {
        $(this).attr("src", "resources/bg_card.png");
    }
);
let isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
if (!isChrome) {
    $('#iframeAudio').remove();
} else {
    $('#playAudio').remove();  
}

//click card
$(".img-element").on("click", clickCard);

$('.start').on('click', function(e) {
    if ($('.sec').text() == 0) {
        $('.start').blur();
        $('.start').attr('disabled', true);
        inter = setInterval(function() {
            if (!$('.start').hasClass('pauseInterval')) {
                counter++;
            }
            $('.sec').text(counter);
        }, 1000);
        $('.pause').attr('disabled', false);
    } else {
        $('.start').blur();
        $('.start').attr('disabled', true);
        $('.start').removeClass('pauseInterval');
        $('.pause').attr('disabled', false);
    }

});

$('.pause').on('click', function() {
    $(this).blur();
    $(this).attr('disabled', true);
    $('.start').attr('disabled', false).text('繼續');
    $('.start').addClass('pauseInterval');
});


function change(arr) {
    let i, j, temp;
    for (i = arr.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        temp = arr[i];
        arr[i] = arr[j];
        arr[j] = temp;
    }
    return arr;
}

function clickCard() {
    if (turn != 2 && counter != 0 && !$('.pause').is(':disabled')) {
        let elementIndex = $(".img-element").index(this);
        if (card_status[elementIndex] != 1) {
            $(".img-element").eq(elementIndex).addClass('flip');
            setTimeout(() => $(".img-element").eq(elementIndex).attr("src", "resources/" + card_arr[elementIndex] + ".png").removeClass('flip'), 500);
            card_status[elementIndex] = 1;
            if (firstNum == 0) {
                firstNum = card_arr[elementIndex];
                firstIndex = elementIndex;
                turn = 1;
            } else {
                secondNum = card_arr[elementIndex];
                secondIndex = elementIndex;
                turn = 2;
                if (firstNum != secondNum) {
                    setTimeout(function() {
                        $(".img-element").eq(firstIndex).addClass('flip');
                        $(".img-element").eq(secondIndex).addClass('flip');
                        setTimeout(function() {
                            $(".img-element").eq(firstIndex).attr("src", "resources/bg_card.png").removeClass('flip');
                            $(".img-element").eq(secondIndex).attr("src", "resources/bg_card.png").removeClass('flip');
                            card_status[firstIndex] = 0;
                            card_status[secondIndex] = 0;
                            firstNum = 0;
                            secondNum = 0;
                            firstIndex = 0;
                            secondIndex = 0;
                            turn = 0;
                        }, 500);
                    }, 2000);
                } else {
                    $.each(card_status, function(index, val) {
                        if (val == 1) {
                            finish++;
                        }
                    });
                    $("section").eq(firstNum - 1).fadeIn(3000); //跑出文字
                    setTimeout(function() { //轉正面
                        //eyes
                        if (finish != 16 && firstNum == 8) {
                            eyes();
                        }
                        //finish
                        if (finish == 16) { //結束
                            clearInterval(inter);
                            $('.pause').attr('disabled', true);
                            $('.start').attr('disabled', false).text("重新開始");
                            $('.start').on('click', function() {
                                location.reload();
                            });
                        }
                        firstNum = 0;
                        secondNum = 0;
                        firstIndex = 0;
                        secondIndex = 0;
                        turn = 0;
                        finish = 0;
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
        if (card_status[i] == 0) {
            $(this).attr("src", "resources/" + card_arr[i] + ".png").css({ "filter": "blur(2px)" });
        }
    });
    setTimeout(function() {
        $('.img-element').each(function(i) {
            $(this).css("pointer-events", "auto");
            if (card_status[i] == 0) {
                $(this).attr("src", "resources/bg_card.png").css({ "filter": "none" });
            }
        });
        $('.bor').hide();
    }, 5000);
}