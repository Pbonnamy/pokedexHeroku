<?php require 'includes/config.php'; ?>
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
      <?php
      $pseudo = $_SESSION['pseudo'];

      $user = 'SELECT * FROM user where pseudo = ?';
      $userData = $bdd->prepare($user);
      $userData->execute([$pseudo]);
      $listUserData = $userData->fetch();

      $idUser = $listUserData['id'];
      $listPoke = 'SELECT * FROM pokemon where id_user = ?';
      $listPokeReq = $bdd->prepare($listPoke);
      $listPokeReq->execute([$idUser]);
      ?>
      <h1 class="mainTitle">Mon compte</h1>
      <h2>Mes infos</h2><br>
      <?php
      echo '<h3 class="profilData">Pseudo : &nbsp</h3><strong>'.$listUserData['pseudo'].'</strong><br>';
      echo '<h3 class="profilData">Email : &nbsp</h3><strong>'.$listUserData['email'].'</strong><br><br>';
      echo '<h3 class="profilData">Image de profil : </h3> <img class="profilPic" src ="'.$listUserData['image'].'">';
      ?>
      <hr>
      <br>
      <h2 class="pokeh2">Mes pokemons</h2>
      <div>

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
            <img class="imgPoke" src="'.$infoPoke['image'] .'">
          </div>
        </div>';

      }

       ?>

     </div>
     <?php include('includes/chatbox.php'); ?>
    </main>

    <script src=https://cdn.pubnub.com/sdk/javascript/pubnub.4.28.2.min.js></script>

    <script>
    function sendnotif() {

            var pubnub = new PubNub({
                publishKey: 'pub-c-d69b49c3-ec63-495b-a31d-c06b2c2ba31a',
                subscribeKey: 'sub-c-66f0521a-52bb-11eb-a73a-1eec528e8f1f'
            });

                channel = 'pokechat';

                pubnub.publish({
                  message: '[SYSTEM] : <?php echo $_SESSION['nompoke']; ?> a été ajouté par <?php echo $_SESSION['pseudo']; ?>',
                  channel: 'pokechat'
                }, (status, response) => {
                  console.log(response);
                });

            pubnub.subscribe({
                channels: [channel]
            });
    };

        <?php
          if(isset($_SESSION['notifbool'])){
            if($_SESSION['notifbool']=="ok"){
              echo 'sendnotif();';
              $_SESSION['notifbool']="ko";
            }
          }
        ?>

      </script>;

    <?php include 'includes/footer.php' ?>

  </body>
</html>
