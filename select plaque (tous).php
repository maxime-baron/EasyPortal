<?php

require "bdd.php";


$query = "SELECT plateNumber,owner FROM easyportal.plates";

if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($plateNumber,$owner);
    $json=array();

    while ($stmt->fetch()) {
        $tab=array("plateNumber"=>$plateNumber,"owner"=>$owner);
        array_push($json,$tab);

        echo json_encode($tab);
    }

    //echo(json_encode($json));
    $stmt->close();
}
?>