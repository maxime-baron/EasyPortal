<?php
$host = "localhost";
$port = 3306;
$socket = "";
$user = "root";
$password = "";
$dbname = "easyportal";

$bdd = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

if (isset($_POST['pseudo'],$_POST['mdp'],$_POST['prenom'],$_POST['nomDeFamille'],$_POST['perm']))
{
    $username=$_POST['pseudo'];
    $password=$_POST['mdp'];
    $firstName=$_POST['prenom'];
    $lastname=$_POST['nomDeFamille'];
    $perm=$_POST['perm'];
}
else {

    $username = 'test';
    $password='testmdp';
    $firstName='teste';
    $lastname='TEST';
    $perm='tes';
}

$query = "INSERT INTO `easyportal`.`user` (`username`, `password`, `firstName`, `lastname`, `perm`) VALUES (?,?,?,?,?)";

if ($stmt = $bdd->prepare($query)) {
    $stmt->bind_param('sssss',$username, $password,$firstName, $lastname,$perm);

    if ($stmt->execute())
        $rep = array("success" => true);
    else
        $rep = array("success" => false);

    echo(json_encode($rep));
    $stmt->close();
}