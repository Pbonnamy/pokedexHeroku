<?php session_start(); ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Pokedex</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php include 'includes/header.php' ?>

    <main>
      <img src="assets/pikachu.png" alt="pikachu" class="mainImg">
      <h1 class="mainTitle">bienvenue sur le pokedex de l'esgi !</h1>

      <?php include('includes/chatbox.php'); ?>

    </main>


    <?php include 'includes/footer.php' ?>
  </body>
</html>
