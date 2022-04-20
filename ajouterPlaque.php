<?php

require "bdd.php";
$bdd = pdo();

if (isset($_GET['platenumber']) && isset($_GET['owner'])) {
    $query = "INSERT INTO easyportal.plates (`plateNumber`, `owner`) VALUES (:plate,:owner)";
    $stmt = $bdd->prepare($query);
    $stmt->execute(array('plate' => $_GET['platenumber'], 'owner' => $_GET['owner']));
    if ($stmt->errorCode() == "00000") {
        $rep = array("success" => true);
        $rep += array("message" => "Plaque ajouter");
    } else {
        $rep = array("success" => false);
        $rep += array("message" => $stmt->errorInfo());
    }
} else {
    $rep = array("success" => false);
    $rep += array("message" => "Parametre manquant");
}
echo (json_encode($rep));
