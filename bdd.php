<?php
$hote = 'localhost';
$nom_bdd = 'easyportal';  //mettre nom bdd
$utilisateur = 'root'; 
$mot_de_passe ='';

try {
    $pdo = new PDO('mysql:host='.$hote.';port='.$nom_bdd, $utilisateur, $mot_de_passe);  // test connexion

} catch(Exception $e) {
	reponse_json($success, $data, 'Echec de la connexion à la base de données '); // connexion non établie
    exit();

}
