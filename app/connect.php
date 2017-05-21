
<?php
// Config
Define('_MAX_TENTATIVE', 3) ;
$DB_serveur = 'localhost'; // Nom du serveur
$DB_utilisateur = 'root'; // Nom de l'utilisateur de la base
$DB_motdepasse = 'favela12'; // Mot de passe pour accèder à la base
$DB_name = 'LaGammine'; // Nom de la base

try {
    $dbh = new PDO('mysql:host=localhost;dbname=LaGammine', $DB_utilisateur, $DB_motdepasse);
   /* foreach($dbh->query('SELECT * from user') as $row) {
        print_r($row);
    }
    */

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

// Code
if(!isset($_GET['login']) && !isset($_GET['password']))
{
    header('Location: index.html');
    Exit;
}
else
{
  $pass_hache = md5($_GET['password']);
  $login = $_GET['login'];
  $req = $dbh->prepare('SELECT Name FROM user WHERE Name = :pseudo AND Password = :pass');
  $req->execute(array(
      'pseudo' => $login,
      'pass' => $pass_hache));
  $resultat = $req->fetch();

  if (!$resultat)
  {
      echo 'Mauvais identifiant ou mot de passe !';
  }
  else
  {
      session_start();
      $_SESSION['pseudo'] = $login;
      echo 'Vous êtes connecté !';
      header('Location: admin.php');
  }
}
?>
