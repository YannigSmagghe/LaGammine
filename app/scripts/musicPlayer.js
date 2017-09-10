let titlePromise = $.getJSON('music-title.json');

// when both requests complete
function getMusic(indexMusic) {
    $.when(titlePromise).then(function (jsonComments, status) {

        $.each(jsonComments, function (key, data) {
            let maxTab = Object.keys(jsonComments['Music']).length - 1;
            if (indexMusic > maxTab) {
                indexMusic = 0;
            }
            if (indexMusic < 0) {
                indexMusic = maxTab;
            }
            // set music
            srcBaseMusic.setAttribute('src', 'music/' + data[indexMusic].title);
            // set idMusic
            srcBaseMusic.setAttribute('idMusic', indexMusic);

            let title = $.map(data[indexMusic].title.split("."), $.trim);
            titleMusic.empty();
            titleMusic.append(title[0]);
            player.load();
            if (player.paused) {
                player.play();
                playElement.classList.remove('fa-play');
                playElement.classList.add('fa-pause');
            } else {
                player.play();
            }

        });
    });
}
let srcBaseMusic = document.getElementById("baseMusic");
let titleMusic = $("#TitleMusic");
let playElement = $("#play-button");
let pauseElement = $("#pause-button");
let current = parseInt(srcBaseMusic.getAttribute('idMusic'));
let player = document.querySelector('#audio-native');


getMusic(current);
setTimeout(function () {
    player.play();
}, 1000);


function play() {
    console.log(player);
    if (player.paused) {
        player.play();
        playElement.hide();
        pauseElement.show();
    } else {
        player.pause();
        pauseElement.hide();
        playElement.show();

    }
}
//
// function resume(idPlayer) {
//   var player = document.querySelector('#' + idPlayer);
//
//   player.currentTime = 0;
//   player.pause();
// }

function nextMusic() {
    let current = parseInt(srcBaseMusic.getAttribute('idMusic'));
    let next = current + 1;
    getMusic(next);
}
function previousMusic() {
    let current = parseInt(srcBaseMusic.getAttribute('idMusic'));
    let prev = current - 1;
    getMusic(prev);
}

player.onended = function () {
    nextMusic();
};
