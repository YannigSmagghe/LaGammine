
var playElement = document.getElementById("play");

function play(idPlayer, control) {
  var player = document.querySelector('#' + idPlayer);

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

}

var srcBaseMusic = document.getElementById("baseMusic");
var fileTitle = "titre1";
var arrayTitle=[];


srcBaseMusic.setAttribute('src','music/'+fileTitle+'.mp3');



//Animation Titre
