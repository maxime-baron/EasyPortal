<?php
require "bdd.php";

if (isset($_GET['username'],$_GET['password'])) {
    $query = "SELECT * FROM easyportal.user WHERE username='" . $_GET['username'] . "' and password='".$_GET['password']."'";
    if ($res = $bdd->query($query)) {
        $rslt = $res->fetch_all();
        if($rslt==null){
            $rep = array("succes" => false);
            $rep += array("message" => "Wrong password or username");
        }else{
            $rep = array("succes" => true);
            $rep += array("message" => "Connecting");
            $rep += array("status" => $rslt[0][4]);
        }
    }
} else {
    $rep = array("succes" => false);
    $rep += array("message" => "Veuillez entrer des paramétres");
}
echo json_encode($rep);
