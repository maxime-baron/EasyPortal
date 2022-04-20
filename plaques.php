<?php

require "bdd.php";


if (isset($_GET['owner'])) {
    $query = "SELECT plateNumber,owner FROM easyportal.plates WHERE owner='" . $_GET['owner'] . "'";
    if ($stmt = $bdd->query($query)) {
        $rslt = $stmt->fetch_all();
        if ($rslt != null) {
            $rep = array("succes" => true);
            $rep += array("message" => "Voici les plaques de " . $_GET['owner']);
            $rep['result'] = $rslt;
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
