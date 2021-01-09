<?php
  session_start();
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ajout de Pokémon</title>
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body>
    <?php include("includes/header.php");?>
    <main>
      <?php
        if(isset($_GET['msg'])){
          echo '<center><h2 class="erreur">' .htmlspecialchars($_GET['msg']) . '</h2></center>';
        }
      ?>
    <br><br>
    <strong><h1 class="formulaire_ajout">AJOUTER UN POKEMON</h1></strong>
    <br><br>
    <form class = "formulaire_ajout" method="POST" action="verif_pokemon.php" enctype="multipart/form-data">
      <input class="input_add" type="text" name="nom" required="required" placeholder="Nom"><br><br>
      <input class="input_add" type="number" name="pv" required="required" placeholder="PV"><br><br>
      <input class="input_add" type="number" name="attaque" required="required" placeholder="Attaque"><br><br>
      <input class="input_add" type="number" name="defense" required="required" placeholder="Defense"><br><br>
      <input class="input_add" type="number" name="vitesse" required="required" placeholder="Vitesse"><br><br>
      <strong class="image_strong">Image : </strong><input class="input_file" type="file" name="image"><br>
      <input class="formulaire_ajout_submit" type="submit" name="submit" value="Ajouter">
    </form>
    </main>

    <?php include("includes/footer.php");?>
  </body>
</html>
