<?php
require "bdd.php";

$query = "DELETE from easyportal.plates WHERE plateNumber =?";
if(isset($_POST["plateNumber"])){
    $plateNumber=$_POST["plateNumber"];
}

else
    $plateNumber="FG-598-NB";

if ($stmt = $con->prepare($query)) {
    $stmt->bind_param('s',$plateNumber);
    if ($stmt->execute())
        $rep = array("success" => true);

    else
        $rep = array("success" => false);
    echo(json_encode($rep));
}
$stmt->close();

$con->close();