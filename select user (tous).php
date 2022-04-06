<?php

require "bdd.php";


$query = "SELECT username,password,firstName,lastName,perm FROM easyportal.user";

if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($username,$password,$firstName,$lastName,$perm);
    $json=array();

    while ($stmt->fetch()) {
        $tab=array("username"=>$username,"password"=>$password,"firstName"=>$firstName,"lastName"=>$lastName,"perm"=>$perm);
        array_push($json,$tab);

        echo json_encode($tab);
    }

    //echo(json_encode($json));
    $stmt->close();
}
?>