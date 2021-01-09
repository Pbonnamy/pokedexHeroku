<?php session_start() ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Connexion/Inscription</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
    <body>
    <?php
    require "includes/header.php";
     ?>
    <body>
      <main>
        <?php
          if(isset($_GET['msg'])){
            echo '<center><h2 class="erreur">' .htmlspecialchars($_GET['msg']) . '</h2></center>';
          }
        ?>
              <div class="aligntop connexion">
                <center>
                  <h1>CONNEXION</h1>
                  <form class="" action="verif_connexion.php" method="post">
                    <input type="email" name="email" class="inputConnexion" required="required" placeholder="Votre email ...">
                    <input type="password" name="password" class="inputConnexion" required="required" placeholder="Votre mot de passe ...">
                    <input type="submit" name="connexion" class="submit inputConnexion" value="Connexion">
                  </form>
              </center>
              </div>

              <div class="inscription">
                <center>
                  <h1>INSCRIPTION</h1>
                  <form class="" action="verif_inscription.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="pseudo" class="inputConnexion" required="required" placeholder="pseudo">
                    <input type="email" name="email" class="inputConnexion" required="required" placeholder="email">
                    <input type="password" name="password" class="inputConnexion" required="required" placeholder="mot de passe">
                </center>
                    <label class="labelImage">Image:
                    <input type="file" name="image" class="inputImage" required="required">
                    </label>
                      <center>
                    <input type="submit" name="inscription" class="inputConnexion submit" value="Inscription">
                  </form>
                </center>
              </div>
          </main>
    <?php include "includes/footer.php" ?>
  </body>
</html>
