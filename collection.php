<?php require 'includes/config.php'; ?>
<?php session_start(); ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Collection</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php include 'includes/header.php' ?>

    <main>
      <?php
      $listPoke = 'SELECT * FROM pokemon';
      $listPokeReq = $bdd->prepare($listPoke);
      $listPokeReq->execute();
      ?>
      <div class="mainCards">
        <h1 class="mainTitle">Tous les pokemons</h1>

      <?php
      while($infoPoke = $listPokeReq->fetch()){
        echo
        '<div class="card">
          <div class="left">
            <h4>'.$infoPoke['nom'].'</h4><br>
            <p>PV : '.$infoPoke['pv'].'</p>
            <p>Attaque : '.$infoPoke['attaque'].'</p>
            <p>Défense : '.$infoPoke['defense'].'</p>
            <p>Vitesse : '.$infoPoke['vitesse'].'</p>
          </div>
          <div class="right">
            <img class="imgPoke" src="uploads/'.$infoPoke['image'] .'">
          </div>
        </div>';

      }

       ?>

     </div>
    </main>

    <?php include 'includes/footer.php' ?>
  </body>
</html>
