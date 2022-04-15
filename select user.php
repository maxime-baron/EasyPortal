<?php

require "bdd.php";


$query = "SELECT username,perm FROM easyportal.user";

if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($username,$perm);
    $json=array();

    while ($stmt->fetch()) {
        $tab=array("username"=>$username,"perm"=>$perm);
        array_push($json,$tab);

        echo json_encode($tab);
    }

    //echo(json_encode($json));
    $stmt->close();
}
?>
