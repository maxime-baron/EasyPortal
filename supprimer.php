<?php

$type = $_GET['type']; //type action Update ou delete  
$username = $_GET['username'];

$try {
    $bdd = new PDO('mysql:host=localhost;dbname=easyportal', 'root','');
}
catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}



if((['username']!='')&&(['password']!='')&&(['firstName']!='')&&(['lastName']!='')&&(['perm']!=''))
{

$sql =  ; //sup

if($type == "update")
{
    $sth = $dbh->prepare('UPDATE user SET password="" WHERE username=:username');  //sup une case de la bdd
    $sth = execute(array($username));
    $sth = $dbh->prepare('UPDATE user SET username="" WHERE username=:username');  
    $sth = execute(array($username));
    $sth = $dbh->prepare('UPDATE user SET firstName="" WHERE username=:username');  
    $sth = execute(array($username));
    $sth = $dbh->prepare('UPDATE user SET lastName="" WHERE username=:username');  
    $sth = execute(array($username));
    $sth = $dbh->prepare('UPDATE user SET perm="" WHERE username=:username');  
    $sth = execute(array($username));
}


if($type == "delete")
{
$sth = $dbh->prepare('DELETE FROM user WHERE username=:username');   //sup la ligne
$sth = execute(array($username));
}

