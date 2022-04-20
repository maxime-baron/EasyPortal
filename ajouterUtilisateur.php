<?php

require "bdd.php";
$bdd = pdo();

if (isset($_GET['firstname'], $_GET['username'], $_GET['lastname'], $_GET['perm'], $_GET['password'])) {
    $query = "SELECT * FROM easyportal.user WHERE username='" . $_GET['username'] . "'";
    if ($res = $bdd->query($query)) {
        $rslt = $res->fetchAll();
        if ($rslt == null) {
            $query = "INSERT INTO easyportal.user (`username`, `password`,`firstName`,`lastName`,`perm`) VALUES (:username,:password,:firstname,:lastname,:perm)";
            $stmt = $bdd->prepare($query);
            $stmt->execute(array('username' => $_GET['username'], 'password' => $_GET['password'], 'firstname' => $_GET['firstname'], 'lastname' => $_GET['lastname'], 'perm' => $_GET['perm']));
            if ($stmt->errorCode() == "00000") {
                $rep = array("success" => true);
                $rep += array("message" => "Utilisateur ajouter");
            } else {
                $rep = array("success" => false);
                $rep += array("message" => $stmt->errorInfo());
            }
        } else {
            $rep = array("succes" => false);
            $rep += array("message" => "L'utilisateur éxiste déja");
        }
    }
} else {
    $rep = array("success" => false);
    $rep += array("message" => "Parametre manquant");
}
echo (json_encode($rep));
