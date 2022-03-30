<?php
$host = "localhost";
$port = 3306;
$socket = "";
$user = "root";
$password = "";
$dbname = "easyportal";

$bdd = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

if (isset($_POST['plaque'],$_POST['proprio']))
{
    $plateNumber=$_POST['plaque'];
    $owner=$_POST['proprio'];
}
else
{
    $plateNumber='0000AAA';
    $owner='test';

}


$query = "INSERT INTO `easyportal`.`plates` (`plateNumber`, `owner`) VALUES (?,?)";

if ($stmt = $bdd->prepare($query)) {
    $stmt->bind_param('ss',$plateNumber,$owner);

    if ($stmt->execute())
        $rep = array("success" => true);
    else
        $rep = array("success" => false);

    echo(json_encode($rep));
    $stmt->close();
}