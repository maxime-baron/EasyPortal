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
        if($username="test")
        {
            echo "yes";
        }

        echo json_encode($tab);
    }

    //echo(json_encode($json));
    $stmt->close();
}


$query = "UPDATE `easyportal`.`users` SET `username` = ? WHERE (`perm` = ?)";
if(isset($_POST["username"],$_POST["perm"])){
    $username = $_POST["username"];
    $perm=$_POST["perm"];
}
else
    $username = "test";
    $perm= "oui";



if ($stmt = $bdd->prepare($query)) {
    $stmt->bind_param('is', $username,$perm);
    if($stmt->execute())
        $rep=array("success"=>true);

    else
        $rep=array("success"=>false);
    echo(json_encode($rep));
    $stmt->close();
}
$bdd->close();
