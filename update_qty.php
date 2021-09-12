<?php
if(session_id() == "") 
{ 
session_start(); 
$session_id = session_id();
//echo $session;
$id = $_REQUEST['id'];
$qty = $_POST['quantity'];

require 'config/connect.php';
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "UPDATE `adidas_cart` SET `qty` = ? WHERE `adidas_cart`.`adidas_cart_id` = ?;";
$q = $pdo->prepare($sql);
$q->execute(array($qty,$id));
Database::disconnect();
header("Location: cart.php");
}
?>