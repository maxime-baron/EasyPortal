<?php
require "bdd.php";
 if(isset($_GET['username'])){
     $query="SELECT * FROM easyportal.user WHERE username='".$_GET['username']."'";
     if ($res = $con->query($query)) {
         $rslt = $res->fetch_all();
         var_dump($rslt[0][0]);
         if(isset($rslt)){
             isset($_GET['password'])?$password=$_GET['password']:$password=$rslt[0][1];
             isset($_GET['firstname'])?$firstname=$_GET['firstname']:$firstname=$rslt[0][2];
             isset($_GET['lastname'])?$lastname=$_GET['lastname']:$lastname=$rslt[0][3];
             isset($_GET['perm'])?$perm=$_GET['perm']:$perm=$rslt[0][4];
             isset($_GET['newUsername'])?$newUsername=$_GET['newUsername']:$newUsername=$rslt[0][0];
             var_dump($newUsername);
             var_dump($_GET['username']);
             $query="UPDATE `easyportal`.`user` SET username=? and password=? and firstName=? and lastName=? and perm=? WHERE username='".$_GET['username']."'";
             $stmt = $con->prepare($query);
             $stmt->bind_param('ssssss',$newUsername, $password, $firstName, $lastName, $perm,$_GET['username']);
             if ($stmt->execute()) {
                 $rep=array("succes"=>true);
             }else{
                 $rep=array("succes"=>false);
                 $rep+=array("message"=>$stmt->error);
             }
         }
     }
 }else{
     $rep=array("succes"=>false);
 }
 echo json_encode($rep);