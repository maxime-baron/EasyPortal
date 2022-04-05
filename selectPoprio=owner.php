<?php
$host="localhost";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="easyportal";

$bdd = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

$query = "SELECT owner=\"test\" FROM easyportal.plates";


if ($stmt = $bdd->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($owner);
    while ($stmt->fetch());



}
else {
        $rep = array("success" => false);
        $rep += array("message" => "Parametre manquant");
        echo(json_encode($rep));
    }
{
        $stmt->close();
}
}
?>