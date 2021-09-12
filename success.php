<?php
    session_start();
    $session_id = session_id();
    include 'config/connect.php';
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $user_login = null;
if(isset($_SESSION["user_login"])){
	// login pass
	$user_login = $_SESSION["user_login"];
	
	$sql = "UPDATE `adidas_reference` SET `adidas_reference_member_id` = ? WHERE `adidas_reference`.`session_id` = ?;";
	$q = $pdo->prepare($sql);
	$q->execute(array($user_login,$session_id));
	
	$sql = "SELECT * FROM `adidas_reference` WHERE `session_id`=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($session_id));
    $row = $q->fetch(PDO::FETCH_ASSOC);
    $lot = $row['adidas_reference_id'];
    $date = $row['adidas_reference_datetime'];
    
    $sql="INSERT INTO `adidas_orders` (`adidas_reference_id`, `order_date`) VALUES (?, CURDATE()) ON DUPLICATE KEY UPDATE `adidas_reference_id` = `adidas_reference_id`;";
    $q = $pdo->prepare($sql);
    $q->execute(array($lot));
}else{
    // no login
    header("Location: ../register.php");
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>adias</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/payment.css">
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
</head>
<body>
<?php 
	$sql = "SELECT * FROM `adidas_member` WHERE `adidas_member_id`=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($user_login));
    $row = $q->fetch(PDO::FETCH_ASSOC);
    $id_m = $row['adidas_member_id'];
    $name = $row['name'];
    $last = $row['lastname'];
    $address = $row['address'];
?>
<div id="payment">
	<div class="container">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 my_address">
                    <address>
                    <div id="headsite">
                        <strong>Website name : </strong>adidas.abcprintf.com
                    </div>
                    <div id="address">
                        <strong>Address: </strong><?php echo $address;?>
                        <br>
                        <abbr title="Phone">Tel.:</abbr> (213) 484-6829
                    </div>
                    </address>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 text-right">
                <em>Lot #: <u><?php echo $lot; ?></u></em>
                <div class="row">
                	<div class="col-xs-12 col-sm-12 col-md-12 mt"> <div><h1>RECEIPT</h1></div></div>
                </div>
                   
                </div>
            </div>
<br>

        <div id="user">
            <div class="row">
            	<div class="col-xs-8 col-sm-8 col-md-8 border1">
            		<div class="row">
            			<div class="col-md-12">
            				<strong>Name :</strong><?php echo $name.' '.$last; ?>
            			</div>
            			<div class="col-md-12">
            				<strong>Address : </strong><?php echo $address; ?> <br><br>
            			</div>
            		</div>
            	</div>
            	<div class="col-xs-4 col-sm-4 col-md-4  border0">
            			<div class="col-md-12">
            			<strong>Vat_ID : </strong><br>
            			0124658457
            			</div>
            			<div class="col-md-12">
            					<strong>Date :</strong> <?php $date=date_create($date);
                                echo date_format($date,"Y/m/d"); ?>
            			</div>
            	</div>
            </div>
        </div>   
<br>        
            <div class="row">
                <table class="table table-hover">
      <thead>
         <tr>
                            <th>Product</th>
                            <th class="text-center">#</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        	</tr>
      </thead>
      <tbody>
     
        <?php
						$sql = "SELECT * FROM `adidas_reference`,`adidas_cart`,`adidas_product`,`adidas_orders` WHERE `adidas_reference`.`adidas_reference_id`=`adidas_cart`.`adidas_cart_lot_id` AND `adidas_product`.`adidas_product_id`=`adidas_cart`.`adidas_product_id`AND `adidas_orders`.`adidas_reference_id`= `adidas_reference`.`adidas_reference_id` AND `adidas_reference_member_id` = ? AND `adidas_reference`.`adidas_reference_id`= ?;";
						$q = $pdo->prepare($sql);
				        $q->execute(array($user_login,$lot));
						$total_price=0;
                       while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td class="col-md-9">'.'<input name="product_name" type="hidden" value="'. $row['adidas_product_name'] . '">'. $row['adidas_product_name'] . '</td>';
                                echo '<td class="col-md-1 text-center">'.'<input type="hidden" name="qty" value="'. $row['qty'] .'" required="">'.$row['qty'].'</td>';
                                echo '<td class="col-md-1 text-center">'.'<input name="price" type="hidden" value="'. $row['adidas_product_price'] . '">'.'฿'. $row['adidas_product_price'] . '</td>';
                                	$a =  $row['qty'];
                                	$b =  $row['adidas_product_price'];
                                	$total = $a *= $b ;
                                	
								echo '<td class="col-md-1 text-center">'.'<input name="qty_price" type="hidden" value="'. $row['adidas_product_price'] . '">'. $total.'</td>';
                                echo '</tr>';
                                
                                $total_price+=$total;
                       }
                       	echo '<tr>';
                            echo '<td>   </td>';
                            echo '<td>   </td>';
                            echo '<td class="text-right">';
                            echo '<p>';
                                echo '<strong>Subtotal: </strong>';
                           echo '</p>';
                            echo '<p>';
                                echo '<strong>Tax: </strong>';
                            echo '</p></td>';
                            echo '<td class="text-center">';
                            echo '<p>';
                                echo "&#3647;{$total_price}";
                            echo '</p>';
                            echo '<p>';
                             $tax = ($total_price * 7) /100;
                                echo "&#3647;{$tax}";
                            echo '</p></td>';
                        echo '</tr>';
                        
                        
                      echo '<tr>';
                            echo '<td><div class="text-center"> (<input style="width: 90%;">) <br> Total fee (text)</div></td>';
                            echo '<td>   </td>';
                            echo '<td class="text-right"><h4>Total: </h4></td>';
                            echo '<td class="text-center text-danger"><h4>';
                            $sum = ($tax + $total_price);
                            echo "&#3647;{$sum}";
                            echo '</h4></td>';
                        echo '</tr>';
                      ?>
      </tbody>
    </table>
            </div>
<br>         
            <div class="row">
            	<div class="col-xs-8 col-sm-8 col-md-8">
            	
            	</div>
            	<div class="col-xs-4 col-sm-4 col-md-4 text-center">
            		<p>__________________</p>
            		<p>Receiver/Collector</p>
            	</div>
            </div>
            
        </div>
    </div>
    
  </div>  
  </div>
  <div class="right">
  <button onclick="printContent('payment')" class="btn btn-danger">Print</button>
  <a class="btn btn-default" href="successfull.php" role="button">Close</a>
  </div>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php Database::disconnect();?>