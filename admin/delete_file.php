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
  		$filename = $_GET['filename'];
  		$p_id = $_GET['p_id'];
  		
  		if($filename !== null){
  			
  		$pdo = Database::connect();
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "UPDATE `adidas_product` SET `adidas_product_img` = '-' WHERE `adidas_product`.`adidas_product_id` = ?;";
	    $q = $pdo->prepare($sql);
	    $q->execute(array($p_id));
	    Database::disconnect();
	    unlink("../img_product/$filename");
	    header('Location: product_edit.php?id='.$p_id);
		//header('Location: product_edit.php?id='.$p_id);
  		}else{
  			echo 'fail!';
  		}
	}
?>