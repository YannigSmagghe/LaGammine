document.querySelector('#file').addEventListener('change', function() {
  var fileInput = document.querySelector('#file');

  fileInput.addEventListener('change', function() {

    // upload le fichier, le mettre dans un json et lire les chansons à partir du json
    var XMLHttpRequest = require("xmlhttprequest").XMLHttpRequest;

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'http://localhost:3000/admin/index.html'); // Rappelons qu'il est obligatoire d'utiliser la méthode POST quand on souhaite utiliser un FormData
    console.log('heeh');
    xhr.addEventListener('load', function() {
      alert('Upload terminé !');
    });

  });

});
