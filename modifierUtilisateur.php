<?php
require "bdd.php";
if (isset($_GET['username'])) {
    $query = "SELECT * FROM easyportal.user WHERE username='" . $_GET['username'] . "'";
    if ($res = $bdd->query($query)) {
        $rslt = $res->fetch_all();
        if ($rslt != null) {
            isset($_GET['password']) ? $password = $_GET['password'] : $password = $rslt[0][1];
            isset($_GET['firstname']) ? $firstname = $_GET['firstname'] : $firstname = $rslt[0][2];
            isset($_GET['lastname']) ? $lastname = $_GET['lastname'] : $lastname = $rslt[0][3];
            isset($_GET['perm']) ? $perm = $_GET['perm'] : $perm = $rslt[0][4];
            isset($_GET['newUsername']) ? $newUsername = $_GET['newUsername'] : $newUsername = $rslt[0][0];

            $query = "UPDATE easyportal.user SET username=?, password=?, firstName=?, lastName=?, perm=? WHERE username='" . $_GET['username'] . "'";
            $stmt = $bdd->prepare($query);
            $stmt->bind_param('sssss', $newUsername, $password, $firstname, $lastname, $perm);
            if ($stmt->execute()) {
                $query = "UPDATE easyportal.plates SET owner=? WHERE owner='" . $_GET['username'] . "'";
                $stmt = $bdd->prepare($query);
                $stmt->bind_param('s', $newUsername);
                if ($stmt->execute()) {
                    $rep = array("succes" => true);
                    $rep += array("message" => "Utilisateur mis a jour");
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
            $rep += array("message" => "L'utilisateur n'éxiste pas");
        }
    }
} else {
    $rep = array("succes" => false);
    $rep += array("message" => "Veuillez entrer des paramétres");
}
echo json_encode($rep);
