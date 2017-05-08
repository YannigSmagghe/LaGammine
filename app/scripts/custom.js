
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



//Load Dates
$.getJSON("dates.json", function (json) {
  $.each(json, function (key, data) {
    $.each(data, function (index, data) {
      console.log(data.place);
      generateListDate(data.place, data.desc, data.date, false);
    })
  })
});

function generateListDate(place,desc,date) {
  // ajout de la rangée dans le tableau
  var lastId = $('.list-date li:last').attr('id');
  if (lastId) {
    $('#0').hide();
    lastId = parseInt(lastId) + 1;
    var appendItem = '<li id="' + lastId + '" class="mdl-list__item mdl-list__item--three-line">';
    appendItem += '<span class="mdl-list__item-primary-content"><span>'+ place +'</span>';
    if (desc){
      appendItem += '<span class="mdl-list__item-text-body">'+desc+'</span>';
    }
    appendItem += '</span><span class="mdl-list__item-secondary-content">'+date+'</span></li>';
    $('.list-date li:last').after(appendItem);
  }
}
