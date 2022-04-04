<?php
$servername = 'localhost';
$username = 'root';
$dbname= 'crm';
$password = '';
$conn = mysqli_connect($servername,$username,$password,$dbname);
if(mysqli_connect_errno()){
  echo "Failed to connect".mysqli_connect_errno();
}
?>