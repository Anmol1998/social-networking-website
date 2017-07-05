<?php

	session_start();
	
	if (isset($_GET['logout'])) {
		unset($_SESSION['userName']);
		session_unset();
		session_destroy();
		header("Location: home.php");
		exit;
	}