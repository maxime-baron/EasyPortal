<?php

//    $hote = '51.210.151.13:3306';
//    $nom_bdd = 'easyportal';  //mettre nom bdd
//    $utilisateur = 'easyportal';
//    $mot_de_passe ='easyportal';
//
//    try {
//        $bdd = new PDO("mysql:host={$hote};dbname={$nom_bdd}","{$utilisateur}","{$mot_de_passe}");  // test connexion
//        echo "creusii";
//    } catch(Exception $e) {
//        die('Erreur :' . $e->getMessage());
//    }

$host="51.210.151.13";
$port=3306;
$socket="";
$user="easyportal";
$password="easyportal";
$dbname="easyportal";

$bdd = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();
