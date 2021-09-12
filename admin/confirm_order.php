<?php
	session_start();
	include '../config/connect.php';
	
	$admin_login = null;
	if(isset($_SESSION["admin_login"])){
	// login pass
	$admin_login = $_SESSION["admin_login"];
	
    //echo $user_login.'<== $user_login <br>';
	}else{
		header('Location: ../index.php');
	}

	//$id = "Payments successful"
	//$id = "Not payments"
	
	if(!empty($_GET)){
		
		$id = $_GET['id'];
		$chk = $_GET['chk'];
		$id_b = $_GET['id_b'];
		//echo $id;
		if($chk == 1){
			$pdo = Database::connect();
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql = "UPDATE `adidas_orders` SET `orders_status` = 'Payments successful' WHERE `adidas_orders`.`adidas_orders_id` = ?;";
		    $q = $pdo->prepare($sql);
		    $q->execute(array($id));
		    Database::disconnect();
		    header('Location: order_view_info.php?id='.$id_b);
		}else{
			$pdo = Database::connect();
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql = "UPDATE `adidas_orders` SET `orders_status` = 'Not payments' WHERE `adidas_orders`.`adidas_orders_id` = ?;";
		    $q = $pdo->prepare($sql);
		    $q->execute(array($id));
		    Database::disconnect();
		    header('Location: order_view_info.php?id='.$id_b);
		}
	}else{
		header('Location: ../index.php');
	}
	
?>