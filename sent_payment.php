<?php
	session_start();
	$session_id = session_id(); 
	include 'config/connect.php';
	
	$user_login = null;
	if(isset($_SESSION["user_login"])){
	// login pass
	$user_login = $_SESSION["user_login"];
	}else{
		header('Location: index.php');
	}
	
	if(!empty($_POST)){
		// keep track validation errors
        $idError = null;
        $pay_incomeError = null;
        $time_incomeError = null;
        $commentError = null;
         
        // keep track post values
        $id = $_POST['id'];
        $pay_income = $_POST['pay_income'];
        $time_income = $_POST['time_income'];
        $comment = $_POST['comment'];
        
        // validate input
        $valid = true;
        if (empty($pay_income)) {
            $pay_incomeError = 'Please enter pay_income';
            $valid = false;
        }
         
        if (empty($time_income)) {
            $time_incomeError = 'Please enter time_income';
            $valid = false;
        }
         
        if (empty($comment)) {
            $commentError = 'Please enter comment';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `adidas_payment` (`date_time`, `adidas_reference_id`, `adidas_member_id`, `time_income`, `price_income`, `comment`) VALUES (NOW(), ?, ?, ?, ?,?);";
            $q = $pdo->prepare($sql);
            $q->execute(array($id,$user_login,$time_income,$pay_income,$comment));
            
            $sql2 = "SELECT * FROM `adidas_orders` WHERE `adidas_reference_id` = ?;";
            $q2 = $pdo->prepare($sql2);
            $q2->execute(array($id));
            $data = $q2->fetch(PDO::FETCH_ASSOC);
        	$adidas_orders_id = $data['adidas_orders_id'];
            
            $sql3 = "UPDATE `adidas_orders` SET `payment` = '1' WHERE `adidas_orders`.`adidas_orders_id` = ?;";
            $q3 = $pdo->prepare($sql3);
            $q3->execute(array($adidas_orders_id));
            
            Database::disconnect();
            header('Location: payment_view.php?id='.$id);
        }
	}
?>