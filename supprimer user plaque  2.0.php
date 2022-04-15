<?php
require "bdd.php";

$query = "DELETE from easyportal.user WHERE username =?";
if(isset($_POST["username"])){
    $username=$_POST["username"];
}

else
    $username="test";

if ($stmt = $con->prepare($query)) {
    $stmt->bind_param('s',$username);
    if ($stmt->execute())
        $rep = array("success" => true);

    $query = "DELETE from easyportal.plates WHERE owner =?";
    if(isset($_POST["owner"])){
        $owner=$_POST["owner"];
    }

    else
        $owner=$username;

    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('s',$owner);
        if ($stmt->execute())
            $rep = array("success" => true);

        else {
            $rep = array("success" => false);
            echo(json_encode($rep));
        }}

    else
        $rep = array("success" => false);
    echo(json_encode($rep));

}
$stmt->close();

$con->close();