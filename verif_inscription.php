<?php
  session_start();
require('includes/config.php');

if(!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 5 || strlen($_POST['pseudo']) > 35){
  header('location: connexion.php?msg=Pseudo invalide');
  exit;
}

$q = "SELECT id FROM user WHERE pseudo = ?";
$req = $bdd->prepare($q);
$req->execute([$_POST['pseudo']]);
$results = $req->fetchall();
if(count($results) > 0){
	header('location: connexion.php?msg=¨Pseudo déjà pris !!');
	exit;
}

if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	header('location: connexion.php?msg=Email invalide');
	exit;
}

$q = "SELECT id FROM user WHERE email = ?";
$req = $bdd->prepare($q);
$req->execute([$_POST['email']]);
$results = $req->fetchall();
if(count($results) > 0){
	header('location: connexion.php?msg=¨Email déjà pris !!');
	exit;
}

if(!isset($_POST['password']) || strlen($_POST['password']) < 8 || !preg_match("#[a-z]#", $_POST['password'])	|| !preg_match("#[A-Z]#", $_POST['password']) || !preg_match("#[0-9]#", $_POST['password'])){
	header('location: connexion.php?msg=Mot de passe invalide');
	exit;
}

if($_POST['avatar_url'] == ""){
  header('location: connexion.php?msg=Veuillez ajouter une image');
  exit;
}

$imglink = $_POST['avatar_url'];
$pseudo = htmlspecialchars($_POST['pseudo']);
$email = $_POST['email'];
$password = hash('sha256',$_POST['password']);

$q = 'INSERT INTO user (pseudo, email, password,image) VALUES (:val1, :val2, :val3, :val4)';
$req = $bdd->prepare($q);
$req->execute([
	'val1' => $pseudo,
	'val2' => $email,
	'val3' => $password,
	'val4' => $imglink
 ]);

$_SESSION['pseudo'] = $pseudo;
header('location: profil.php');
exit;

?>
