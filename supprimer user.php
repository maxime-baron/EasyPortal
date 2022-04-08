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

    else
        $rep = array("success" => false);
    echo(json_encode($rep));
}
$stmt->close();

$con->close();