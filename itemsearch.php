<?php require 'includes/config.php'; ?>
<?php
session_start();

$search = $_GET['search'];

$sql = "SELECT * FROM pokemon WHERE nom LIKE :search";
$prepareReq = $bdd->prepare($sql);

$prepareReq->execute([":search"=>'%'.$search.'%']);

while($infoPoke= $prepareReq->fetch()){
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
  </div>'
  ;
}
?>
