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
        
		$sql2 = "SELECT * FROM `adidas_product` WHERE `adidas_product_id` = ?;";
	    $q2 = $pdo->prepare($sql2);
	    $q2->execute(array($id));
	    $data2 = $q2->fetch(PDO::FETCH_ASSOC);
	    $adidas_product_name = $data2['adidas_product_name'];
	    $adidas_product_price = $data2['adidas_product_price'];
	    $adidas_product_title = $data2['adidas_product_title'];
	    $adidas_product_img = $data2['adidas_product_img'];
	    $adidas_product_details = $data2['adidas_product_details'];
	    $adidas_category_id = $data2['adidas_category_id'];
	    $adidas_type_id = $data2['adidas_type_id'];
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
 			
    	<nav aria-label="You are here:" role="navigation">
        	<ul class="breadcrumbs">
          		<li><a href="#">Dashboard</a></li>
          		<li><a href="#">Product</a></li>
          		<li><span class="show-for-sr">Current: </span>Edit</li>
        	</ul>
      	</nav>
      	<hr>
      	<div class="callout primary">
	       	<h4><i class="fa fa-pencil-square-o"></i> Edit Product.</h4>
	    </div>
	    
	    <div class="button-group">
	    	<a href="product_edit_view.php" class="button"><i class="fa fa-arrow-left"></i> Back</a>
      	</div>
      	
      	<hr>
      	
	    <form action="product_update.php" method="post" enctype="multipart/form-data">
	    	<input type="hidden" name="product_id" value="<?=$id;?>">
        <div class="row">
          <div class="medium-6 columns">
            <label>ชื่อสินค้า
              <input type="text" placeholder="ชื่อสินค้า" name="product_name" value="<?=$adidas_product_name;?>">
            </label>
          </div>
          <div class="medium-6 columns">
            <label>ราคา
              <div class="input-group">
		        <input class="input-group-field" type="number" name="price" value="<?=$adidas_product_price;?>">
		        <span class="input-group-label">฿</span>
		      </div>
            </label>
          </div>
        </div>
        <?php
        	if($adidas_product_img == '-'){ ?>
        	<input type="hidden" name="check_img" value="1">
	    <div class="row">
	      <div class="medium-4 columns">
	        <label>ชื่อรูปภาพ (ลง Server)
	          <input type="text" placeholder="ชื่อรูปภาพ (ลง Server)" name="img_name">
	        </label>
	      </div>
	      <div class="medium-4 columns">
	        <label>ชื่อหัวข้อสินค้า (ที่โชว์)
	          <input type="text" placeholder="ชื่อหัวข้อสินค้า (ที่โชว์)" name="title_name" value="<?=$adidas_product_title;?>">
	        </label>
	      </div>
	      <div class="medium-4 columns">
			<label>อัพโหลดรูป</label>
	          <label for="exampleFileUpload" class="button"><i class="fa fa-upload"></i> Browse...</label>
	  			<input type="file" id="exampleFileUpload" class="show-for-sr" name="file">
	      </div>
	    </div>
        <?php }else{ ?>
        <div class="row">
        	<div class="medium-8 columns text-center">
        		<img class="thumbnail" src="../img_product/<?=$adidas_product_img;?>" style="width:300px; height:300px;">
        	</div>
        	<div class="medium-4 columns">
        		<a href="delete_file.php?filename=<?=$adidas_product_img;?>&p_id=<?=$id;?>" class="alert button delete-file" onclick="return confirm('are you sure delete?')"><i class="fa fa-trash"></i></a>
        	</div>
        </div>
        <?php } ?>
        <div class="row">
        	<div class="medium-12 columns">
        		<label>
		        Details
		        <textarea class="ckeditor" id="editor1" name="details"><?=$adidas_product_details;?></textarea>
		      	</label>
        	</div>
        </div>
        <div class="row">
        	<div class="medium-12 columns">
        		<label>Category
			        <select name="category">
			          <?php
				        $sql = "SELECT * FROM `adidas_category` ORDER BY `adidas_category`.`category_id` ASC";
				        $q = $pdo->prepare($sql);
				        $q->execute(array());
				        while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
						echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
						}
					 ?>
			        </select>
		      	</label>
        	</div>
        </div>
        <div class="row">
        	<div class="medium-12 columns">
        		<label>Type
			        <select name="type">
			          <?php
				        $sql = "SELECT * FROM `adidas_type` ORDER BY `adidas_type`.`adidas_type_id` ASC";
				        $q = $pdo->prepare($sql);
				        $q->execute(array());
				        while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
						echo '<option value="'.$row['adidas_type_id'].'">'.$row['adidas_type_name'].'</option>';
						}
					 ?>
			        </select>
		      	</label>
        	</div>
        </div>
        <div class="row">
        	<div class="medium-12 columns text-right">
        		<button type="submit" class="success button"><i class="fa fa-check"></i> Submit</button>
        	</div>
        </div>
      </form>
      
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
<script src="../plugin/ckeditor/ckeditor.js"></script>
<script>
      $(document).foundation();
    </script>
</body>
</html>
<?php Database::disconnect();?>