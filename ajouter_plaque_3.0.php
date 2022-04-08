<?php

require "bdd.php";



if (isset($_GET['plaque'],$_GET['proprietaire']))
{
    $query = "INSERT INTO easyportal.plates (`plateNumber`, `owner`) VALUES (:plate,:owner)";
    $stmt = $bdd->prepare($query);
    $stmt->execute(array('plate'=>$_GET['plaque'],'owner'=>$_GET['proprio']));
    if($stmt->errorCode()=="00000"){
        $rep = array("success" => true);
        $rep += array("message" => "Plaque ajouter");
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
