
<?php
// Config
//Define('_MAX_TENTATIVE', 3) ;
include('dbConfig.php');
include('error.php');


try {
    $dbh = new PDO('mysql:host='.$DB_serveur.';dbname='.$DB_name,$DB_utilisateur, $DB_motdepasse);


} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
var_dump('salut');
// Code
if(!isset($_GET['login']) && !isset($_GET['password']))
{
//    var_dump(header('Location: index.html'));
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

$dbh = null;
?>
