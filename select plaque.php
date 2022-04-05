<?php
$host = "localhost";
$port = 3306;
$socket = "";
$user = "root";
$password = "";
$dbname = "easyportal";

$bdd = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

$query = "SELECT * FROM easyportal.plates";

if ($stmt = $bdd->prepare($query)) {

    $stmt->execute();
    $stmt->bind_result($plateNumber, $owner);
    $json=array();

    while ($stmt->fetch()) {$tab=array("plateNumber"=>$plateNumber,"owner"=>$owner);
        array_push($json,$tab);

    }
    echo(json_encode($tab));
    $stmt->close();

}
$bdd->close();
?>


