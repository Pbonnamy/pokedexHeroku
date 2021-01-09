
<header class="headFoot">
  <a href="index.php"><img src="assets/logo.png" alt="logo" class="logo"></a>
  <nav class="navbar">
    <ul>
      <li class="navItem"><a href="index.php">Accueil</a></li>
      <li class="navItem"><a href="collection.php">Collection</a></li>

      <?php
        if (isset($_SESSION['pseudo'])){
          echo '<li class="navItem"><a href="add_pokemon.php">Ajouter un Pokemon</a></li>';
          echo '<li class="profilheadli"><img class="profilhead" src="'.$_SESSION["image"].'"></li>';
          echo '<li class="navItem"><a href="profil.php">Mon compte</a></li>';
          echo '<li class="navItem"><a href="includes/connexion_check.php">Deconnexion</a></li>';
        }else{
          echo '<li class="navItem"><a href="includes/connexion_check.php">Connexion</a></li>';
        }
      ?>

    </ul>
  </nav>
</header>
