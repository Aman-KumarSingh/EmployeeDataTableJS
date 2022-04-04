<?php
include_once "./db_config.php";
session_start();
$username=$_SESSION['username'];
$work=$_GET['work'];
if($work=="add"){
    if(mysqli_query($conn,"insert into ".$username."  values(NULL,'".$_GET['name']."','".$_GET['email']."','".$_GET['phone']."')")){
        $result=mysqli_query($conn,"select id from ".$username." where name='".$_GET['name']."' AND email='".$_GET['email']."' AND contact='".$_GET['phone']."'");
        $row=mysqli_fetch_assoc($result);
        $id=$row['id'];
    echo $id;
}
else{
    echo mysqli_error($conn);
}
}
else if($work=='update'){
    $id=$_GET['id'];
   if( mysqli_query($conn,"update ".$username." set name='".$_GET['name']."',email='".$_GET['email']."' , contact ='".$_GET['phone']."' where id='".$id."'")){
       echo "1";
   }
   else{
       echo mysqli_error($conn);
   }


 }else if($work=="remove"){
    $id=$_GET['id'];
    if( mysqli_query($conn,"delete from ".$username." where id='".$id."' ")){
        echo "1";
    }
    else{
        echo mysqli_error($conn);
    }
 }

 ?>