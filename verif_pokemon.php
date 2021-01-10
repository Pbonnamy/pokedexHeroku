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
  && !isset($_POST['vitesse'])
  ) {
    header('location: add_pokemon.php?msg=Tous les champs ne sont pas remplis.');
  }


  if($_POST['avatar_url'] == ""){
    header('location: add_pokemon.php?msg=Veuillez ajouter une image');
    exit;
  }
  //Déclaration

  $imglink = $_POST['avatar_url'];

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


  //Envoie

  $q = 'INSERT INTO pokemon (nom, pv, attaque, defense, vitesse,image, id_user) VALUES (:val1, :val2, :val3, :val4, :val5,:val6, :val7)';
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

  $_SESSION['nompoke']=$nom;
  $_SESSION['notifbool']="ok";
  header('location: profil.php?msg=ok');
  exit;
?>
