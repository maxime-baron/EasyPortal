<?php
require "bdd.php";
$bdd = pdo();

if (isset($_GET['username'], $_GET['perm'])) {
    $query = "SELECT plateNumber, owner) FROM easyportal.plates)";
    if($stmt = $bdd->prepare($query)){
        if ($stmt->errorCode() == "00000") {
            $rep = array("success" => true);
            $rep += array("message" => "Plaque ajouter");
        } else {
            $rep = array("success" => false);
            $rep += array("message" => $stmt->errorInfo());
        }
        echo(json_encode($rep));
    }

}
else {
    $rep = array("success" => false);
    $rep += array("message" => "Parametre manquant");
    echo(json_encode($rep));
}


?>