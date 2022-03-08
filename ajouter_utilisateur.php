<?php
include('template.php');

if( !empty($_GET['identifiant']) && !empty($_GET['mot_de_passe']) && !empty($_GET['Type']) )
{ 

	$requete = $pdo->prepare("INSERT INTO `Utilisateur` (`id`, `identifiant`, `mot_de_passe`, `Type`);");
	$requete->bindParam(':identifiant', $_GET['identifiant']);
	$requete->bindParam(':mot_de_passe', $_GET['mot_de_passe']);
	$requete->bindParam(':Type', $_GET['Type']);


	if( $requete->execute() ){
		$success = true;
		$msg = 'Le compte a été ajouté';
							}
else {
		$msg = "Une erreur s'est produite";
	 }
} else {
	$msg = "Il manque des informations";
}

reponse_json($success, $data, $msg);

