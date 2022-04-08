<?php

require "bdd.php";
$bdd = pdo();

if (isset($_GET['plaque'],$_GET['username']))
{
    $query = "INSERT INTO easyportal.user (`username`, `password`,`firstName`,`lastName`,`perm`) VALUES (:username,:password,:firstName,:lastName,:perm)";
    $stmt = $bdd->prepare($query);
    $stmt->execute(array('username'=>$_GET['username'],'password'=>$_GET['password'],'firstName'=>$_GET['firstName'],'lastName'=>$_GET['lastName'],'perm'=>$_GET['perm']));
    if($stmt->errorCode()=="00000"){
        $rep = array("success" => true);
        $rep += array("message" => "Utilisateur ajouter");
    }else{
        $rep = array("success" => false);
        $rep += array("message" => $stmt->errorInfo());
    }
    echo(json_encode($rep));
}else{
    $rep = array("success" => false);
    $rep += array("message" => "Parametre manquant");
    echo(json_encode($rep));
}?>
