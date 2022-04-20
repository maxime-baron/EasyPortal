<?php

require "bdd.php";
$bdd = pdo();
$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = "SELECT * FROM easyportal.plates";
$res = $bdd->query($query);
$rslt = $res->fetchAll();
$param = "";
foreach ($_GET as $key => $data) {
    $param = $param . " and " . $key . "='" . $data . "' ";
}

$query = "SELECT username,firstname,lastname,perm FROM easyportal.user WHERE true" . $param;
$stmt = $bdd->prepare($query);
$stmt->execute();

if ($stmt->errorCode() == "00000") {
    $rep = array("success" => true);
    $rep += array("message" => "Voici les utilisateur");

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
    $rep = array("sql" => $query);
    $rep += array("message" => $stmt->errorInfo());
}
echo (json_encode($rep));
