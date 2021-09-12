<?php
    session_start();
    $session_id = session_id();
    include 'config/connect.php';
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $Id_product = $_POST['Id_product'];
    $qty = $_POST['qty'];

    $sql = "INSERT INTO `adidas_reference` (`adidas_reference_datetime`,`session_id`) VALUES (CURDATE(),?) ON DUPLICATE KEY UPDATE `adidas_reference_id`=`adidas_reference_id`;";
    $q = $pdo->prepare($sql);
    $q->execute(array($session_id));
    
    $sql2 = "SELECT `adidas_reference_id` FROM `adidas_reference` WHERE `session_id`=?;";
    $q2 = $pdo->prepare($sql2);
    $q2->execute(array($session_id));
    $row = $q2->fetch(PDO::FETCH_ASSOC);
    $adidas_reference_id = $row['adidas_reference_id'];
    
    $sql3 = "INSERT INTO `adidas_cart` ( `adidas_product_id`, `qty`, `adidas_cart_lot_id`) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE qty = qty +1;";
    $q3 = $pdo->prepare($sql3);
    $q3->execute(array($Id_product,$qty,$adidas_reference_id));
    Database::disconnect();
    header("Location: cart.php");
?>