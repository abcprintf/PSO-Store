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
    
    $sql2 = "SELECT COUNT(*) AS `total_product` FROM `adidas_product`";
    $q2 = $pdo->prepare($sql2);
    $q2->execute(array());
    $data2 = $q2->fetch(PDO::FETCH_ASSOC);
    $total_product = $data2['total_product'];
    
    $sql3 = "SELECT COUNT(*) AS `total_member` FROM `adidas_member`";
    $q3 = $pdo->prepare($sql3);
    $q3->execute(array());
    $data3 = $q3->fetch(PDO::FETCH_ASSOC);
    $total_member = $data3['total_member'];
    
    $sql4 = "SELECT COUNT(*) AS `total_cart` FROM `adidas_cart`";
    $q4 = $pdo->prepare($sql4);
    $q4->execute(array());
    $data4 = $q4->fetch(PDO::FETCH_ASSOC);
    $total_cart = $data4['total_cart'];
	}else{
		header('Location: ../index.php');
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
            <div class="large-4 small-6 columns text-center">
            <div class="callout callout-style-1">
              <span><i class="fa fa-cart-arrow-down fa-5x fa-inverse"></i></span>
              <div>
                <h5><a href="order_view.php">New Orders (<?php echo $total_cart;?>)</a></h5>
              </div>
            </div>
            </div>
 
            <div class="large-4 small-6 columns text-center">
            <div class="callout callout-style-2">
               <span><i class="fa fa-gift fa-5x fa-inverse"></i></span>
              <div>
                <h5><a href="product.php">All Product (<?php echo $total_product;?>)</a></h5>
              </div>
            </div>
            </div>
 
            <div class="large-4 small-6 columns text-center">
            <div class="callout callout-style-3">
              <span><i class="fa fa-users fa-5x fa-inverse"></i></span>
              <div>
                <h5><a href="user_view.php">All User (<?php echo $total_member;?>)</a></h5>
              </div>
            </div>
            </div>
		</div><!-- header -->
		</div><!-- row -->
		
		<hr>
		<div style="height: 400px;"></div>
	</div>
</div>

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
    </script>
</body>
</html>
<?php Database::disconnect(); ?>