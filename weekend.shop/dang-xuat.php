<?php
		session_start();
		include('connect.php');
		unset($_SESSION['makh']);
		header("location:index.php");
?>
