<?php
require "bdd.php";

if (isset($_GET['platenumber'])) {
    $query = "DELETE from easyportal.plates WHERE plateNumber ='" . $_GET['platenumber'] . "'";
    if ($stmt = $bdd->query($query)) {
        $rep = array("succes" => true);
        $rep += array("message" => "La plaque " . $_GET['platenumber'] . " à étés supprimé");
    } else {
        $rep = array("succes" => false);
        $rep += array("message" => $stmt->error);
    }
} else {
    $rep = array("succes" => false);
    $rep += array("message" => "Veuillez entrer des paramétres");
}
echo json_encode($rep);
