<?php
$hote = 'localhost';
//$port = "3306";
$nom_bdd = 'api';  //mettre nom bdd
$utilisateur = 'user'; 
$mot_de_passe ='password';

try {
    $pdo = new PDO('mysql:host='.$hote.';port='.$nom_bdd, $utilisateur, $mot_de_passe);  // test connexion

} catch(Exception $e) {
	reponse_json($success, $data, 'Echec de la connexion à la base de données'); // connexion non établie
    exit();

}