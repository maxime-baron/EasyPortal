<?php
$host="localhost";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="easyportal";

$bdd = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

$query = "SELECT username FROM easyportal.users";

if ($stmt = $bdd->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($username,$perm);
    $json=array();

    while ($stmt->fetch()) {
        $tab=array("username"=>$username,"perm"=>$perm);
        array_push($json,$tab);


    }

    echo(json_encode($json));
    $stmt->close();
}
?>