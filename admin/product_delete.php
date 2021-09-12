<?php
	session_start();
	include '../config/connect.php';
	
	$admin_login = null;
	if(isset($_SESSION["admin_login"])){
	// login pass
	$admin_login = $_SESSION["admin_login"];
    //echo $user_login.'<== $user_login <br>';
	}
	
	if (!empty($_GET)) {
  		$id = $_GET['id'];
  		
  		if($id !== null){
  			
  		$pdo = Database::connect();
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "DELETE FROM `adidas_product` WHERE `adidas_product`.`adidas_product_id` = ?;";
	    $q = $pdo->prepare($sql);
	    $q->execute(array($id));
	    Database::disconnect();
	    header('Location: product_delete_view.php');
	    
  		}else{
  			header('Location: product_delete_view.php');
  		}
	}
?>