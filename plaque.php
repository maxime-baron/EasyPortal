<?php

require "bdd.php";


if (isset($_GET['platenumber'])) {
    $query = "SELECT plateNumber,owner FROM easyportal.plates WHERE plateNumber='" . $_GET['platenumber'] . "'";
    if ($stmt = $bdd->query($query)) {
        $rslt = $stmt->fetch_all();
        if ($rslt != null) {
            $rep = array("succes" => true);
            $rep += array("message" => "Voici le propriétaire de " . $_GET['platenumber']);
            $rep['result'] = $rslt[0];
        } else {
            $rep = array("succes" => false);
            $rep += array("message" => "L'utilisateur n'éxiste pas");
        }
    } else {
        $rep = array("succes" => false);
        $rep += array("message" => $stmt->error);
    }
} else {
    $rep = array("succes" => false);
    $rep += array("message" => "Veuillez entrer des paramétres");
}
echo json_encode($rep);
