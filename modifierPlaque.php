<?php
require "bdd.php";
if (isset($_GET['platenumber'],$_GET['newplatenumber'])) {
    $query = "SELECT * FROM easyportal.plates WHERE plateNumber='" . $_GET['platenumber'] . "'";
    if ($res = $bdd->query($query)) {
        $rslt = $res->fetch_all();
        if ($rslt != null) {
            isset($_GET['plateNumber']) ? $plateNumber = $_GET['plateNumber'] : $plateNumber = $rslt[0][0];
            isset($_GET['newplatenumber']) ? $newplateNumber = $_GET['newplatenumber'] : $newplateNumber = $rslt[0][0];

            $query = "UPDATE easyportal.plates SET plateNumber=? WHERE plateNumber='" . $plateNumber . "'";
            $stmt = $bdd->prepare($query);
            $stmt->bind_param('s', $newplateNumber);
            if ($stmt->execute()) {
                $rep = array("succes" => true);
                $rep += array("message" => "Plaque mis a jour");
            } else {
                $rep = array("succes" => false);
                $rep += array("message" => $stmt->error);
            }
        } else {
            $rep = array("succes" => false);
            $rep += array("message" => "La plaque n'existe pas");
        }
    }else {
        $rep = array("succes" => false);
        $rep += array("message" => "La plaque n'existe pas");
    }
} else {
    $rep = array("succes" => false);
    $rep += array("message" => "Veuillez entrer des parametres");
}
echo json_encode($rep);


//http://51.210.151.13/btssnir/projets2022/easyportal/api/modifierPlaque.php?platenumber=OOAAOO&newplatenumber=AZ-365-JH