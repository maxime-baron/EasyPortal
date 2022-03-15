<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=easyportal', 'root','');
}
catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

if( !empty($_GET['plateNumber']) && !empty($_GET['owner']) )
{

	$requete = $pdo->prepare("INSERT INTO `plates` (`plateNumber`, `owner`;");
	$requete->bindParam(':plateNumber', $_GET['plateNumber']);
	$requete->bindParam(':owner', $_GET['owner']);


	if( $requete->execute() ){
		$success = true;
		$msg = 'La plaque a bien été ajouté ';
							}
else {
		$msg = "Une erreur s'est produite";
	 }
} else {
	$msg = "Il manque des informations";
}

reponse_json($success, $data, $msg);

