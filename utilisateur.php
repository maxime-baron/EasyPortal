<?php

require "bdd.php";
$bdd = pdo();
$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (isset($_GET['username'])) {
    $query = "SELECT * FROM easyportal.plates";
    $res = $bdd->query($query);
    $rslt = $res->fetchAll();

    $query = "SELECT username,firstname,lastname,perm FROM easyportal.user WHERE username=:username";
    $stmt = $bdd->prepare($query);
    $stmt->execute(array('username' => $_GET['username']));

    if ($stmt->errorCode() == "00000") {
        $rep = array("success" => true);
        $rep += array("message" => "Voici l'utilisateur");

        foreach ($stmt->fetchAll() as $key => $val) {
            foreach ($val as $key2 => $value) {
                $rep['result'][$key][$key2] = $value;
            }
            $rep['result'][$key]['plates'] = array();
            foreach ($rslt as $plate) {
                if ($plate['owner'] == $rep['result'][$key]['username']) {
                    $rep['result'][$key]['plates'][] = array("plateNumber" => $plate['plateNumber']);
                }
            }
        }
    } else {
        $rep = array("success" => false);
        $rep += array("message" => $stmt->errorInfo());
    }
} else {
    $rep = array("success" => false);
    $rep += array("message" => "Parametre manquant");
}
echo (json_encode($rep));
