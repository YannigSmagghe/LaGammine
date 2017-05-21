var titlePromise = $.getJSON('music-title.json');

// when both requests complete
function getMusic(indexMusic) {
  $.when(titlePromise).then(function (jsonComments, status) {
    $.each(jsonComments, function (key, data) {
      if (indexMusic >= Object.keys(jsonComments['Music']).length){
        indexMusic = 0;
      }
      if (indexMusic < 0){
        indexMusic = Object.keys(jsonComments['Music']).length - 1;
      }
        // set music
        srcBaseMusic.setAttribute('src', 'music/' + data[indexMusic].title);
        // set idMusic
        srcBaseMusic.setAttribute('idMusic', indexMusic);
        //
        var title = $.map(data[indexMusic].title.split("."), $.trim);
        titleMusic.empty();
        titleMusic.append(title[0]);

    });
  });
}
var srcBaseMusic = document.getElementById("baseMusic");
var titleMusic = $("#TitleMusic");
var playElement = document.getElementById("play");
var current = srcBaseMusic.getAttribute('idMusic');
var player = document.querySelector('#audio-native');
getMusic(current);

function play() {
  if (player.paused) {
    player.play();
    playElement.classList.remove('fa-play');
    playElement.classList.add('fa-pause');
  } else {
    player.pause();
    playElement.classList.remove('fa-pause');
    playElement.classList.add('fa-play');

  }
}

function resume(idPlayer) {
  var player = document.querySelector('#' + idPlayer);

  player.currentTime = 0;
  player.pause();
}

function nextMusic() {
  var next = parseInt(srcBaseMusic.getAttribute('idMusic')) +1 ;
  getMusic(next);
  player.load();
  if (player.paused) {
    player.play();
    playElement.classList.remove('fa-play');
    playElement.classList.add('fa-pause');
  } else{
    player.play();
  }
}
function previousMusic() {
  var prev = parseInt(srcBaseMusic.getAttribute('idMusic')) -1 ;
  getMusic(prev);
  player.load();
  if (player.paused) {
    player.play();
    playElement.classList.remove('fa-play');
    playElement.classList.add('fa-pause');
  } else{
    player.play();
  }
}
