<?php 
	session_start();
	$se = session_id();
	$user_login = null;
		if(isset($_SESSION["user_login"])){
			// login pass
			$user_login = $_SESSION["user_login"];
			session_regenerate_id();
			session_start();
			$se2 = session_id();
			$user_login2 = $_SESSION["user_login"];

			header("Location: index.php");
		}else{
			// no login
			header("Location: register.php");
		}


