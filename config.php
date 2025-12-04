<?php 
$servername="localhost";
$username="root";
$password="Root@1234";
$dbname="facebook";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("".$conn->connect_error);
}

?>