<?php
	session_start();
	include '../config/connect.php';
	//connect
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$admin_login = null;
	if(isset($_SESSION["admin_login"])){
	// login pass
	$admin_login = $_SESSION["admin_login"];

    $sql = "SELECT * FROM `adidas_member` WHERE `adidas_member_id` = ?;";
    $q = $pdo->prepare($sql);
    $q->execute(array($admin_login));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $adidas_member_user = $data['adidas_member_user'];
	}else{
		header('Location: ../index.php');
	}
	
	if(!empty($_GET)){
		$id = $_GET['id'];
	}else{
		header('Location: order_view.php');
	}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>PsO | Project Site selling shoes online</title>
<link rel="stylesheet" href="../css/foundation.css" />
<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/app.css" />
</head>
<body>

<!-- modal content -->
	<!-- // login // -->
	<div class="tiny reveal" id="exampleModal1" data-reveal>
    	<div class="row">
		    <div class="large-12 columns auth-plain">
		    <h3>Oops!</h3>
		      <div class="signup-panel left-solid text-center">
		         <h3>Please contact us.</h3>
		         <h5><u><a href="http://abcprintf.com/" target="_blank">abcprintf.com</a></u></h5>
		      </div>
		    </div>
		    </div>
    	<button class="close-button" data-close aria-label="Close modal" type="button">
    		<span aria-hidden="true">&times;</span>
    	</button>
    </div>
    
<!-- modal content -->

<!-- // topbar // -->
<div class="top-bar">
<div class="row">	
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="brand"><a href="index.php"><i class="fa fa-bars"></i> PsO</a></li>
    </ul>
  </div>
  
  <div class="top-bar-right">
  	<ul class="dropdown menu" data-dropdown-menu>
     	<li> <a href="#"><?php echo $adidas_member_user;?> <i class="fa fa-user"></i></a>
        <ul class="menu vertical">
         <?php if($admin_login !== null){ ?>
          <li><a href="#">profile</a></li>
          <li><a href="../logout.php">logout</a></li>	
          <?php }else{ ?>
          <li><a data-open="exampleModal1">account</a></li>
          <li><a data-open="exampleModal2">create an account</a></li>
          <?php } ?>
        </ul>
      </li>
     </ul>
  </div>
  </div>
</div>
<!-- // topbar // -->

<div class="row" id="content">
	<div class="medium-3 columns" data-sticky-container>
		<!--<div class="sticky" data-sticky data-anchor="content">-->
			<ul class="side-nav">
                <li class="active"><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="order_view.php"><i class="fa fa-cart-arrow-down"></i> Order</a></li>
                <li><a href="product.php"><i class="fa fa-product-hunt"></i> Product</a></li>
                <li><a href="category_view.php"><i class="fa fa-hashtag"></i> Category</a></li>
                <li><a href="type_view.php"><i class="fa fa-hashtag"></i> Type</a></li>
                <li><a href="user_view.php"><i class="fa fa-user"></i> User</a></li>
            </ul>
		<!--</div>-->
	</div>
	<div class="medium-9 columns">
		<div class="row">
 		<div class="header">
 			
    	<nav aria-label="You are here:" role="navigation">
        	<ul class="breadcrumbs">
          		<li><a href="#">Dashboard</a></li>
          		<li><span class="show-for-sr">Current: </span> Orders</li>
        	</ul>
      	</nav>
      	<hr>
      	<div class="callout primary">
	       	<h4>View all orders.</h4>
	    </div>
	    
	    <div class="button-group">
	    	<!--<a data-open="myModal_2" class="primary button"><i class="fa fa-plus"></i> Add</a>-->
      		<a href="order_view_edit.php" class="button"><i class="fa fa-arrow-left"></i> Back</a>
      		<!--<a data-open="exampleModal1" class="alert button"><i class="fa fa-times"></i> Delete</a>-->
      	</div>
      	
	    <table class="hover">
        <thead>
          <tr>
            <th>#</th>
            <th>รูปภาพ</th>
            <th>ชื่อสินค้า</th>
            <th>จำนวน</th>
            <th>ราคา</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $total = 0;
          	$i=0;
            $sql = "SELECT * FROM `adidas_cart`,`adidas_product` WHERE `adidas_cart`.`adidas_product_id` = `adidas_product`.`adidas_product_id` AND `adidas_cart_lot_id` = ?;";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            while($data = $q->fetch(PDO::FETCH_ASSOC)){
                $i++;
            	
            	echo '<tr>';
            	echo '<td>'.$i.'</td>';
            	echo '<td><img class="thumbnail" src="../img_product/'.$data['adidas_product_img'].'"style="height: 150px;width: 150px;"></td>';
            	echo '<td>'.$data['adidas_product_name'].'</td>';
            	echo '<td>'.$data['qty'].'</td>';
            	$totals = $data['adidas_product_price'] * $data['qty'];
            	echo '<td>'.$totals.'</td>';
            	echo '</tr>';
            	
            	$total += $totals;
            	
            	$tax = ($total * 7)/ 100;
            	$totalsum = $total + $tax;
            }
		  ?>
		  <tr>
		  	<td>ราคารวม</td>
		  	<td></td>
		  	<td></td>
		  	<td></td>
		  	<td><?php echo $total;?></td>
		  </tr>
		  <tr>
		  	<td>ราคารวม + ภาษี(7%)</td>
		  	<td></td>
		  	<td></td>
		  	<td></td>
		  	<td><?php echo $totalsum;?></td>
		  </tr>
        </tbody>
      </table>
      <?php
        $sql="SELECT * FROM `adidas_orders`,`adidas_payment` WHERE `adidas_orders`.`adidas_reference_id` = `adidas_payment`.`adidas_reference_id` AND `adidas_orders`.`adidas_reference_id` = ?;";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $adidas_orders_id = $data['adidas_orders_id'];
        $orders_status = $data['orders_status'];
        $payment = $data['payment'];
        $price_income = $data['price_income'];
      ?>
      <?php if(($payment == 1) && ($orders_status == "Payments successful")){ ?>
      	<span class="warning label"><i class="fa fa-clock-o"></i> ชำระเรียบร้อยแล้ว</span> : <span class="secondary label"> <?php echo $price_income.' บาท';?></span>
      	<span style="float: right;"><a href="confirm_order.php?id=<?php echo $adidas_orders_id;?>&chk=0&id_b=<?php echo $id;?>" class="alert button"><i class="fa fa-times"></i> ยกเลิก</a></span>
      <?php }else if(($payment == 1) && ($orders_status == "Not payments")){ ?>
      	<span class="warning label"><i class="fa fa-clock-o"></i> ชำระเรียบร้อยแล้ว</span> : <span class="secondary label"> <?php echo $price_income.' บาท';?></span>
      	<span style="float: right;"><a href="confirm_order.php?id=<?php echo $adidas_orders_id;?>&chk=1&id_b=<?php echo $id;?>" class="success button"><i class="fa fa-check"></i> อนุมัติ</a></span>
      <?php }else{ ?>
      	<span class="alert label"><i class="fa fa-times"></i> ยังไม่ได้ชำระ</span>
      <?php } ?>
		</div><!-- header -->
		</div><!-- row -->
		
		<hr>
		<div class="content-control"></div>
	</div>
</div>

<!-- fix -->
<div style="margin-bottom: 260px;"></div>

<div class="callout2"></div>
<footer>
	
  <div class="row">
    <div class="large-12 text-right"> Create by <a href="http://abcprintf.com/" target="_blank">abcprintf</a>.</div>
  </div>
</footer>
<script src="../js/vendor/jquery.min.js"></script> 
<script src="../js/vendor/what-input.min.js"></script> 
<script src="../js/foundation.min.js"></script> 
<script src="../js/app.js"></script> 
<script>
      $(document).foundation();
      /*$(window).bind("load", function () {
		    var footer = $("footer");
		    var pos = footer.position();
		    var height = $(window).height();
		    height = height - pos.top;
		    height = height - footer.height();
		    if (height > 0) {
		        footer.css({
		            'margin-top': height + 'px'
		        });
		    }
		});*/
    </script>
</body>
</html>
<?php Database::disconnect(); ?>