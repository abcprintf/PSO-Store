<?php 
	if(!empty($_POST)){
		$usernameError = null;
		$passwordError = null;
		$emailError = null;
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		
		$valid = true;
		if (empty($username)) {
            $usernameError = 'Please enter username';
            $valid = false;
            header("Location: index.php");
        }
        if (empty($password)) {
            $passwordError = 'Please enter password';
            $valid = false;
            header("Location: index.php");
        }
        if (empty($email)) {
            $emailError = 'Please enter email';
            $valid = false;
            header("Location: index.php");
        }
		
		if($valid) {
			include 'config/connect.php';
			$pdo = Database::connect();
	        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "INSERT INTO `adidas_member` (`adidas_member_user`, `adidas_member_pass`, `adidas_member_email`, `adidas_member_datetime`) VALUES (?, MD5(?), ?, NOW());";
	        $q = $pdo->prepare($sql);
	        $q->execute(array($username,$password,$email));
	        Database::disconnect();
	        header("Location: login.php?success=1");
		}
	}
?>