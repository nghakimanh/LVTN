<?php
    $servername="localhost";
    $username="root";
    $password="1234";
    $databasename="shop";
    $conn=new mysqli($servername,$username,$password,$databasename);
    $conn->set_charset("utf8mb4");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>