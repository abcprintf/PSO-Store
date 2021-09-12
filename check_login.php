<?php
    session_start();
    include 'config/connect.php';
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if(!empty($_POST)){
		$usernameError = null;
		$passwordError = null;
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$valid = true;
        if (empty($username)) {
            $usernameError = 'Please enter username';
            $valid = false;
            header("Location: index.php");
        }
        if (empty($password)) {
            $passwprdError = 'Please enter password';
            $valid = false;
            header("Location: index.php");
        }
        
        // insert data
        if ($valid) {
        
            $sql = "SELECT * FROM `adidas_member` WHERE `adidas_member_user` LIKE ?;";
            $q = $pdo->prepare($sql);
            $q->execute(array($username));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $adidas_member_id = $data['adidas_member_id'];
            $adidas_member_pass = $data['adidas_member_pass'];
            $adidas_member_status = $data['adidas_member_status'];
            $check_active = $data['check_active'];
    
            $pw = MD5($password);
            
            //echo $pw;
            if(($username == 'admin') && ($adidas_member_status == 'admin')){
            	$_SESSION["admin_login"]=$data['adidas_member_id'];
            	header("Location: admin/index.php");
            }else if($pw == $adidas_member_pass){
            	if($check_active == 1){
            		$_SESSION["user_login"]=$data['adidas_member_id'];
            		header("Location: index.php?success=1");
            	}else{
            		$_SESSION["user_login"]=$data['adidas_member_id'];
            		header("Location: active.php");
            	}
            }else{
            	header("Location: index.php?Error=1");
            }
        }
    }
    Database::disconnect();
?>