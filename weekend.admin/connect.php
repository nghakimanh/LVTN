<?php
    $conn=new mysqli("localhost","root","1234","shop");
    $conn->set_charset("utf8mb4");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>