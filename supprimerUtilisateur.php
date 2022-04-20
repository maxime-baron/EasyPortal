<?php
require "bdd.php";

if (isset($_GET['username'])) {
    $query = "DELETE from easyportal.user WHERE username ='" . $_GET['username'] . "'";
    if ($stmt = $bdd->query($query)) {
        $query = "DELETE from easyportal.plates WHERE owner=?";
        $stmt = $bdd->prepare($query);
        $stmt->bind_param('s', $_GET['username']);
        if ($stmt->execute()) {
            $rep = array("succes" => true);
            $rep += array("message" => "L'utilisateur " . $_GET['username'] . " à étés supprimé");
        } else {
            $rep = array("succes" => false);
            $rep += array("message" => $stmt->error);
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