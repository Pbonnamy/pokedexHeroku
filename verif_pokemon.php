<?php
session_start();
require('includes/config.php');

  // Vérification si un nom est déjà pris
  $q = "SELECT id FROM pokemon WHERE nom = ?";
  $req = $bdd->prepare($q);
  $req->execute([$_POST['nom']]);
  $results = $req-> fetchall();
  if(count($results) > 0){
    header('location: add_pokemon.php?msg=Nom déjà utilisé.');
    exit;
  }

  // Vérification des champs
  if (!isset($_POST['nom'])
  && !isset($_POST['pv'])
  && !isset($_POST['attaque'])
  && !isset($_POST['defense'])
  && !isset($_POST['vitesse'])) {
    header('location: add_pokemon.php?msg=Tous les champs ne sont pas remplis.');
  }

$imglink = $_GET['imglinkpath'];
/*
  //Upload de l'image
  $acceptable = ['image/jpeg', 'image/png', 'image/jpg'];
  if(!in_array($_FILES['image']['type'], $acceptable)){
    header('location: add_pokemon.php?msg=Ce fichier n\'est pas au bon format ou aucun fichier n\'a été envoyé.');
    exit;
  }

  $path = 'uploads';

  if(!file_exists($path)){
    mkdir($path, '0777');
  }

  $filename = $_FILES['image']['name'];
  $temp = explode('.', $filename);
  $extension = end($temp);
  $timestamp = time();
  $filename = 'image-' . $timestamp . '.' . $extension;


  $chemin_image = $path . '/' . $filename;
  move_uploaded_file($_FILES['image']['tmp_name'], $chemin_image);
*/

  //Déclaration

  $nom = htmlspecialchars($_POST['nom']);
  $pv = $_POST['pv'];
  $attaque = $_POST['attaque'];
  $defense = $_POST['defense'];
  $vitesse = $_POST['vitesse'];

  $pseudo = $_SESSION['pseudo'];

  $user = 'SELECT id FROM user WHERE pseudo = ?';
  $userData = $bdd->prepare($user);
  $userData->execute([$pseudo]);
  $listUserData = $userData->fetch();

  $idUser = $listUserData['id'];
  $listPoke = 'SELECT * FROM pokemon WHERE id_user = ?';
  $ListPokeReq = $bdd->prepare($listPoke);
  $ListPokeReq->execute([$idUser]);

//  if(isset($_POST['pseudo']) && isset($_POST['password'])){
//    $user_id = "SELECT id
//    FROM user
//    WHERE pseudo = '".($_POST['pseudo'])."'
//    AND password = '".($_POST['password'])."'";
//    $result = mysql_query($user_id) or die ('erreur'.$user_id.':' .mysql_error());
//  }

  //Envoie

  $q = 'INSERT INTO pokemon (nom, pv, attaque, defense, vitesse,imglink, id_user) VALUES (:val1, :val2, :val3, :val4, :val5,:val6, :val7)';
  $req = $bdd -> prepare($q);
  $req -> execute([
    'val1' => $nom,
    'val2' => $pv,
    'val3' => $attaque,
    'val4' => $defense,
    'val5' => $vitesse,
    'val6' => $imglink,
    'val7' => $idUser
  ]);

  header('location: profil.php');
  exit;
?>
