<?php
session_start();
require('connection.php');

if (isset($_GET['logout'])) {
		session_destroy();
		header("location: index.php");
	}

?>