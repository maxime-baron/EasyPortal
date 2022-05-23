<?php

require "bdd.php";
$bdd = pdo();
$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if (isset($_GET['number']) == false) {
    $query = "SELECT * FROM logs ORDER BY id DESC LIMIT 100";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    if ($stmt->errorCode() == "00000") {
        $rep = array("success" => true);
        $rep += array("message" => "Voici les logs");
        // var_dump($stmt->fetchAll());
        $arr = $stmt->fetchAll();
        $rep['result']['count'] = sizeof($arr);
        foreach ($arr as $key => $val) {
            foreach ($val as $key2 => $value) {
                $rep['result']['results'][$key][$key2] = $value;
            }
        }
    } else {
        $rep = array("success" => false);
        $rep = array("sql" => $query);
        $rep += array("message" => $stmt->errorInfo());
    }
} else {
    $query = "SELECT * FROM logs ORDER BY id DESC LIMIT " . $_GET['number'] . ", 100";
    $stmt = $bdd->prepare($query);
    $stmt->execute();

    if ($stmt->errorCode() == "00000") {
        $rep = array("success" => true);
        $rep += array("message" => "Voici les logs");
        // var_dump($stmt->fetchAll());
        $arr = $stmt->fetchAll();
        $rep['result']['count'] = sizeof($arr);
        foreach ($arr as $key => $val) {
            foreach ($val as $key2 => $value) {
                $rep['result']['results'][$key][$key2] = $value;
            }
        }
    } else {
        $rep = array("success" => false);
        $rep = array("sql" => $query);
        $rep += array("message" => $stmt->errorInfo());
    }
}

echo (json_encode($rep));
