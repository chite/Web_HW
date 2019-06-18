let menu = $('#menu');
let icon = $('.icon');
if (screen.width > 991) {

    icon.each(function(index, value) {
        $(value).css('top', 1 + index * 7 + 'em');
    });
} else {
    icon.each(function(index, value) {
        $(value).css('top', 0.5 + index * 3 + 'em');
    });
}
menu.on('click', function() {
    menu.toggleClass('menuMove');
    icon.toggleClass('vis');
});
//voice
if (voice == '0') {
    $('audio').attr('src', '');
    $('#voice').attr('src', 'img/voice_block.png');
} else {
    $('audio').attr('src', 'img/bgm.mp3');
    setTimeout(function() {
        if ($('audio')[0].paused) {
            $('.icon').eq(1).click();
        }
    }, 1000);
}
//button
for (let i = 0; i < 3; i++) {
    $('.icon').eq(i).on('click', function(e) {
        switch (e.target.id) {
            case 'account':
                location.href = 'profile.php';
                break;
            case 'voice':
                let voice_state = null;
                if ($('audio').attr('src')) {
                    $('audio').attr('src', '');
                    $('#voice').attr('src', 'img/voice_block.png');
                    voice_state = '0';
                } else {
                    $('audio').attr('src', 'img/bgm.mp3');
                    $('#voice').attr('src', 'img/voice.png');
                    voice_state = '1';
                }
                let formData = new FormData();
                formData.append('voice', voice_state);
                fetch('voice.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(function(response) {
                        return response.text();
                    })
                    .then(function(response) {
                        console.log(response);
                    })
                    .catch(function(err) {
                        console.log(err);
                    })

                break;
            case 'forum':
                location.href = 'board.php';
                break;
        }
    })
}