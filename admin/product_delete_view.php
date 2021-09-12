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
      <!--
      <li> <a href="index.php">online shop</a>
        <ul class="menu vertical">
          <li><a href="#">Men</a></li>
          <li><a href="#">Women</a></li>
          <li><a href="#">Kids</a></li>
        </ul>
      </li>
      <li><a href="#">sports</a>
      	<ul class="menu vertical">
          <li><a href="#">football</a></li>
          <li><a href="#">running</a></li>
          <li><a href="#">basketball</a></li>
          <li><a href="#">traning</a></li>
        </ul>
      </li>
      <li><a href="#">brands</a>
      	<ul class="menu vertical">
          <li><a href="#">originals</a></li>
          <li><a href="#">NEO</a></li>
          <li><a href="#">stella mcCartney</a></li>
        </ul>
      </li>
      -->
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
          		<li><a href="#">Product</a></li>
          		<li><span class="show-for-sr">Current: </span> Delete</li>
        	</ul>
      	</nav>
      	<hr>
      	<div class="callout primary">
	       	<h4><i class="fa fa-pencil-square-o"></i> Delete</h4>
	    </div>
	    
	    <div class="button-group">
      		<a href="product.php" class="button"><i class="fa fa-arrow-left"></i> Back</a>
      	</div>
      	
	    <table class="hover">
        <thead>
          <tr>
            <th width="50">#</th>
            <th width="150">Picture</th>
            <th>Product Name</th>
            <th width="150">Price</th>
            <th width="150">Category</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
           $sql = 'SELECT * FROM `adidas_product`,`adidas_category` WHERE `adidas_product`.`adidas_category_id` = `adidas_category`.`category_id` ORDER BY `adidas_product_id` DESC';
           foreach ($pdo->query($sql) as $row) {
           			$i++;
           			
                    echo '<tr>';
                    echo '<td>'. $i. '</td>';
                    echo '<td><img class="thumbnail" src="../img_product/'.$row['adidas_product_img'].'" style="height: 150px;width: 150px;"></td>';
                    echo '<td>'. $row['adidas_product_name'] . '</td>';
                    echo '<td>'. $row['adidas_product_price'] . '</td>';
                    echo '<td>'. $row['category_name'] . '</td>';
                    echo '<td><a href="product_delete.php?id='.$row['adidas_product_id'].'" class="alert button" onclick="return confirm(\'are you sure?\')"><i class="fa fa-trash"></i></a></td>';
                    echo '</tr>';
           }
		  ?>
        </tbody>
      </table>
      
      <!--<ul class="pagination text-center" role="navigation" aria-label="Pagination">
        <li class="pagination-previous disabled">Previous</li>
        <li class="current"><span class="show-for-sr">You're on page</span> 1</li>
        <li><a href="#" aria-label="Page 2">2</a></li>
        <li><a href="#" aria-label="Page 3">3</a></li>
        <li><a href="#" aria-label="Page 4">4</a></li>
        <li class="ellipsis"></li>
        <li><a href="#" aria-label="Page 12">12</a></li>
        <li><a href="#" aria-label="Page 13">13</a></li>
        <li class="pagination-next"><a href="#" aria-label="Next page">Next</a></li>
      </ul>-->
	       
		</div><!-- header -->
		</div><!-- row -->
		
		<hr>
		<div class="content-control"></div>
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