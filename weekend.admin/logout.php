<?php
		session_start();
        $conn=new mysqli("localhost","root","1234","shop");

          if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
		session_destroy();
		header("location:login.php");
?>