<?php
	require('includes/config.php');

$email = isset($_POST['email'])?htmlspecialchars($_POST['email']):'';
$password = isset($_POST['password']) ? hash('sha256', $_POST['password']): '';

$q = 'SELECT pseudo,image FROM user WHERE email = ? AND password = ?';
$req = $bdd->prepare($q);
$req->execute([$email, $password]);
$pseudo = $req->fetch();

if(empty($pseudo)){
	header('location:connexion.php?msg=Identifiants Incorrects !!');
	exit;

}else{
	session_start();
	$_SESSION['pseudo'] = $pseudo[0];
	$_SESSION['image'] = $pseudo[1];
	header('location:index.php');
	exit;
}

?>
