<?php 
	session_start();
	$user_login = null;
	if(isset($_SESSION["user_login"])){
	// login pass
	$user_login = $_SESSION["user_login"];
	
	}else{
		header('Location: index.php');
	}
	
	if(!empty($_POST)){
		
		$nameError = null;
		$lastnameError = null;
		$addressError = null;
		$telError = null;
		
		$name = $_POST['name'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$tel = $_POST['tel'];
		
		$valid = true;
		if (empty($name)) {
            $nameError = 'Please enter name';
            $valid = false;
            header("Location: active.php");
        }
        if (empty($lastname)) {
            $lastnameError = 'Please enter lastname';
            $valid = false;
            header("Location: active.php");
        }
        if (empty($address)) {
            $addressError = 'Please enter address';
            $valid = false;
            header("Location: active.php");
        }
        if (empty($tel)) {
            $telError = 'Please enter tel';
            $valid = false;
            header("Location: active.php");
        }
		
		if($valid) {
			include 'config/connect.php';
			$pdo = Database::connect();
	        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "UPDATE `adidas_member` SET `check_active` = '1', `name` = ?, `lastname` = ?, `address` = ?, `tel` = ? WHERE `adidas_member`.`adidas_member_id` = ?;";
	        $q = $pdo->prepare($sql);
	        $q->execute(array($name,$lastname,$address,$tel,$user_login));
	        Database::disconnect();
	        header("Location: profile.php");
		}
		
	}
?>