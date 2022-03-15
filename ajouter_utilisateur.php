<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=easyportal', 'root','');
}
catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

if( !empty($_GET['username']) && !empty($_GET['password']) && !empty($_GET['firstName']) && !empty($_GET['lastName']) && !empty($_GET['perm'])  )
{

	$requete = $pdo->prepare("INSERT INTO `user` (`username`, `password`,`firstName`,`lastName`, `perm`);");
	$requete->bindParam(':username', $_GET['username']);
	$requete->bindParam(':password', $_GET['password']);
	$requete->bindParam(':firstName', $_GET['firstName']);
	$requete->bindParam(':lastName', $_GET['lastName']);
	$requete->bindParam(':perm', $_GET['perm']);


	if( $requete->execute() ){
		$success = true;
		$msg = 'Le compte a bien été ajouté';
							}
else {
		$msg = "Une erreur s'est produite";
	 }
} else {
	$msg = "Il manque des informations";
}

reponse_json($success, $data, $msg);

