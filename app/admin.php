<?php
session_start();
if ($_SESSION['pseudo'] === 'Marie'):
?>
<!doctype html>
<html lang="Fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>La Gammine</title>

  <!-- Disable tap highlight on IE -->
  <meta name="msapplication-tap-highlight" content="no">

  <!-- Web Application Manifest -->
  <link rel="manifest" href="manifest.json">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <!-- YS: Voir pour le content s'il faut ajouter plus-->
  <meta name="application-name" content="La Gammine Music">
  <link rel="icon" sizes="192x192" href="images/touch/chrome-touch-icon-192x192.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Web Starter Kit">
  <link rel="apple-touch-icon" href="images/touch/apple-touch-icon.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->

  <meta name="msapplication-TileImage" content="images/gammine/gammineIco.jpg">
  <!--YS: 2 thèmes color à voir avec Marie-->
  <meta name="msapplication-TileColor" content="#9ac16e">

  <!-- Color the status bar on mobile devices -->
  <meta name="theme-color" content="#9ac16e">

  <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
  <!--
  <link rel="canonical" href="http://www.example.com/">
  -->

  <!-- Material Design icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


  <!-- Material Design Lite page styles:
  You can choose other color schemes from the CDN, more info here http://www.getmdl.io/customize/index.html
  Format: material.color1-color2.min.css, some examples:
  material.red-teal.min.css
  material.blue-orange.min.css
  material.purple-indigo.min.css
  -->
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue_grey-blue.min.css" />
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.indigo-pink.min.css"> <!-- Default MDL CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">  <!-- MDL Icons -->
  <link rel="stylesheet" href="scripts/modal/material-modal.min.css">
  <!-- Your styles -->
  <link rel="stylesheet" href="styles/main.css">
  <link rel="stylesheet" href="scripts/uploader/dropezone.css">
</head>
<body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base ">
<section class="mdl-layout  mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header mdl-layout__header--scroll">
    <div class="mdl-layout--large-screen-only mdl-layout__header-row">
    </div>
    <div class="mdl-layout--large-screen-only mdl-layout__header-row">
      <div class="mdl-layout__drawer-button"><i class="material-icons">menu</i></div>
      <div class="mdl-layout-title">Menu</div>
    </div>
    <div class="mdl-layout--large-screen-only mdl-layout__header-row">
    </div>

  </header>
  <!--YS: Nav Menu-->
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Menu</span>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" id="admin-accueil"    onclick="changeMenu(this.id)" href="#">Accueil</a>
      <a class="mdl-navigation__link" id="admin-music"      onclick="changeMenu(this.id)" href="#">Musique</a>
      <a class="mdl-navigation__link" id="admin-dates"       onclick="changeMenu(this.id)" href="#">Dates</a>
    </nav>
  </div>
  <!--END Nav Menu-->
  <main class="mdl-layout__content">
    <section class="content-grid mdl-grid section--center section-admin-accueil">
      <div class="mdl-cell mdl-cell--12-col">
        <div class="mdl-layout-title">
          LA GAMMINE MASTER
        </div>

      </div>
    </section>
    <section class="content-grid mdl-grid section--center section-admin-music">
      <div class="mdl-cell mdl-cell--12-col">
        <div class="mdl-layout-title">
          MUSIC
        </div>
        <div class="mdl-cell mdl-cell--3-offset mdl-cell--6-col">
          <input id="file" type="file" style="display:none"/>
          <form action="upload.php"
                class="dropzone"
                id="my-awesome-dropzone"></form>
        </div>
        Le titre du fichier sera le titre affiché dans le player.
      </div>
    </section>
    <section class="content-grid mdl-grid section--center section-admin-dates">
      <div class="mdl-cell mdl-cell--12-col">
        <div class="mdl-layout-title">
          DATES
        </div>
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button mdl-js-button mdl-button--raised
                        mdl-js-ripple-effect mdl-button--colored modal__trigger"
                data-modal="#modal-ajouter">
          Ajouter
        </button>
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button mdl-js-button mdl-button--raised
                        mdl-js-ripple-effect mdl-button--colored modal__trigger"
                data-modal="#modal-supprimer">
          Supprimer
        </button>
        <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
          <thead>
          <tr>
            <th class="mdl-data-table__cell--non-numeric">Lieu</th>
            <th class="mdl-data-table__cell--non-numeric">Description</th>
            <th class="mdl-data-table__cell--non-numeric">Date</th>
          </tr>
          </thead>
          <tbody id="table-date">
          <tr id="0">
          </tr>

        </table>

      </div>
<!--modal part-->
        <div id="modal-ajouter" class="modal modal__bg">
          <div class="modal__dialog">
            <div class="modal__content">
              <div class="modal__header">
                <div class="modal__title">
                  <h2 class="modal__title-text">Ajouter une date</h2>
                </div>
                <span class="mdl-button mdl-button--icon mdl-js-button  material-icons  modal__close"></span>
              </div>
              <div class="modal__text">
                <form action="#" class="form-add-date">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="input-place">
                    <label class="mdl-textfield__label" for="input-place">Text...</label>
                  </div>
                </form>
                <!-- Numeric Textfield with Floating Label -->
                <form action="#" class="form-add-date">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="input-desc">
                    <label class="mdl-textfield__label" for="input-date">Number...</label>
                  </div>
                </form>
                <form action="#" class="form-add-date">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="input-date">
                    <label class="mdl-textfield__label" for="input-date">Number...</label>
                  </div>
                </form>

              </div>
              <div class="modal__footer">
                <div class="mdl-grid">
                  <div class="mdl-layout-spacer"></div>
                  <div class="mdl-cell mdl-cell--4-col">
                    <button onclick="newEntrie()" class="mdl-button mdl-js-button mdl-button--raised modal__close">
                      Ajouter
                    </button>
                  </div>
                  <div class="mdl-layout-spacer"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <div id="modal-supprimer" class="modal modal__bg">
        <div class="modal__dialog">
          <div class="modal__content">
            <div class="modal__header">
              <div class="modal__title">
                <h2 class="modal__title-text">Valider la suppression</h2>
              </div>
              <span class="mdl-button mdl-button--icon mdl-js-button  material-icons  modal__close"></span>
            </div>
            <div class="modal__text">
              <button onclick="deleteRow()" class="mdl-button mdl-js-button mdl-button--raised modal__close">
                Oui
              </button>
              <button class="mdl-button mdl-js-button mdl-button--raised modal__close">
                Non
              </button>
          </div>
        </div>
      </div>
      <script src="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.min.js"></script> <!-- MDL JavaScript -->
      <script src="scripts/modal/material-modal.min.js"></script>
    </section>

  </main>
</section>

<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="scripts/menu.js"></script>
<script src="scripts/uploader/dropzone.js"></script>
<!-- build:js scripts/main.min.js -->
<!--<script src="../scripts/main.js"></script>-->
<script src="scripts/admin-dates.js"></script>

<!-- endbuild -->

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-XXXXX-X', 'auto');
  ga('send', 'pageview');
</script>
<!-- Built with love using Web Starter Kit -->
</body>
</html>
<?php
else :
 header('Location: index.html');
endif;
?>
