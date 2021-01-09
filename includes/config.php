<?php
	try{
		$bdd = new PDO('mysql:host=eu-cdbr-west-03.cleardb.net;dbname=heroku_72998cb6f9ce79f', 'b00da32204c12c', '9ac6a23b', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	}catch(Exception $e){
		die('Erreur : ' . $e->getMessage());
	}
?>
