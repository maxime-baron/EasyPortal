<?php
$host = "localhost";
$port = 3306;
$socket = "";
$user = "root";
$password = "";
$dbname = "easyportal";

$bdd = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

$query = "SELECT username,password,firstName,lastName,perm FROM easyportal.user";

if ($stmt = $bdd->prepare($query)) {

    $stmt->execute();
    $stmt->bind_result($username, $password, $firstName, $lastName,$perm);
    $json=array();

    while ($stmt->fetch()) {$tab=array("username"=>$username,"password"=>$password,"firstName"=>$firstName,"lastName"=>$lastName,"perm"=>$perm);
        array_push($json,$tab);

    }
    echo(json_encode($tab));
    $stmt->close();



}
$bdd->close();