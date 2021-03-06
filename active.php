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
    
    $sql = "SELECT * FROM `adidas_member` WHERE `adidas_member_id` = ?;";
    $q = $pdo->prepare($sql);
    $q->execute(array($user_login));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $adidas_member_user = $data['adidas_member_user'];
	}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>PsO | Project Site selling shoes online</title>
<link rel="stylesheet" href="css/foundation.css" />
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="css/app.css" />
<link rel="stylesheet" href="css/register.css" />
</head>
<body>
<!-- // topbar // -->
<div class="top-bar">
  <div class="row">
    <div class="top-bar-left">
      <ul class="dropdown menu" data-dropdown-menu>
        <li class="brand"><a href="index.php"><i class="fa fa-bars"></i> PsO</a></li>
        <li> <a href="index.php">online shop</a>
          <ul class="menu vertical">
            <li><a href="men.php">Men</a></li>
            <li><a href="women.php">Women</a></li>
            <li><a href="kids.php">Kids</a></li>
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
      </ul>
    </div>
    <div class="top-bar-right">
      <ul class="dropdown menu" data-dropdown-menu>
      	<?php
      	$sql = "SELECT * FROM `adidas_reference` WHERE `session_id` LIKE ?;";
        $q = $pdo->prepare($sql);
        $q->execute(array($session_id));
        $row = $q->fetch(PDO::FETCH_ASSOC);
        $lot = $row['adidas_reference_id'];
      	
        $sql = "SELECT COUNT(*) AS `total` FROM `adidas_cart` WHERE `adidas_cart_lot_id` = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($lot));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $total = $data['total'];
      ?>
        <li> <a href="cart.php"><span class="badge"><?php echo $total;?></span></i></a>
        <li> <a href="#"><?php echo $adidas_member_user;?> <i class="fa fa-user"></i></a>
          <ul class="menu vertical">
            <?php if($user_login !== null){ ?>
            <li><a href="logout.php">profile</a></li>
            <li><a href="logout.php">logout</a></li>
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

<hr>
<div class="row">
	<div class="small-6 large-centered columns">
      <div class="signup-panel">
        <p class="welcome">Active Form.</p>
        <form action="sent_active.php" method="post">
          <div class="row collapse">
            <div class="small-2  columns text-center">
              <span class="prefix"><i class="fa fa-user"></i></span>
            </div>
            <div class="small-10  columns">
              <input type="text" placeholder="name" name="name">
            </div>
          </div>
          <div class="row collapse">
            <div class="small-2  columns text-center">
              <span class="prefix"><i class="fa fa-user"></i></span>
            </div>
            <div class="small-10  columns">
              <input type="text" placeholder="lastname" name="lastname">
            </div>
          </div>
          <div class="row collapse">
            <div class="small-2  columns text-center">
              <span class="prefix"><i class="fa fa-home"></i></span>
            </div>
            <div class="small-10  columns">
               <textarea placeholder="Address" name="address"></textarea>
            </div>
          </div><div class="row collapse">
            <div class="small-2  columns text-center">
              <span class="prefix"><i class="fa fa-mobile"></i></span>
            </div>
            <div class="small-10  columns">
              <input type="text" placeholder="Tel" name="tel" maxlength="10">
            </div>
          </div>
        <button type="submit" class="success button">Update info!</button>
        </form>
      </div>
	</div>
</div>
<hr>

<div class="callout2"></div>
<div class="row connect hide-for-small-only">
  <div class="large-3 columns">
    <div class="learn-links">
      <h4 class="hide-for-small">sports</h4>
      <a href="#">adidas by Stella McCartney</a> <br>
      <a href="#">Basketball</a> <br>
      <a href="#">Football</a> <br>
      <a href="#">Golf</a> <br>
      <a href="#">Outdoor</a> <br>
      <a href="#">Running</a> <br>
      <a href="#">Tennis</a> <br>
      <a href="#">Training</a> </div>
  </div>
  <div class="large-2 columns">
    <div class="support-links">
      <h4>street</h4>
      <p><a href="#">Originals</a></p>
    </div>
    <div class="support-links">
      <h4>style</h4>
      <a href="#">NEO</a> <br>
      <a href="#">Y-3</a> </div>
  </div>
  <div class="large-2 columns">
    <div class="connect-links">
      <h4>catalogue</h4>
      <a href="#">Men's Shoes</a> <br>
      <a href="#">Men's Clothing</a> <br>
      <a href="#">Women's Shoes</a> <br>
      <a href="#">Women's Clothing</a> <br>
      <a href="#">Kid's Shoes</a> <br>
      <a href="#">Kid's Clothing</a> </div>
  </div>
  <div class="large-3 columns">
    <div class="connect-links">
      <h4>service</h4>
      <a href="#">Store finder</a> <br>
      <a href="#">Account</a> <br>
      <a href="#">Contact Us</a> </div>
    <div class="support-links">
      <h4>company info</h4>
      <a href="#">Partners</a> <br>
      <a href="#">Careers</a> <br>
      <a href="#">Press</a> <br>
      <a href="#">Corporate Information</a> </div>
  </div>
  <div class="large-2 columns">
    <div class="connect-links">
      <h4>help</h4>
      <a href="#">Catalogue</a> <br>
      <a href="#">Community & Newsletters</a> <br>
      <a href="#">Corporate</a> <br>
      <a href="#">General</a> <br>
      <a href="#">Products</a> <br>
      <a href="#">Usability</a> </div>
  </div>
</div>
<footer>
  <div class="row">
    <div class="large-12 text-right"> Create by <a href="http://abcprintf.com/" target="_blank">abcprintf</a>.</div>
  </div>
</footer>
<script src="js/vendor/jquery.min.js"></script> 
<script src="js/vendor/what-input.min.js"></script> 
<script src="js/foundation.min.js"></script> 
<script src="js/app.js"></script> 
<script>
      $(document).foundation();
    </script>
</body>
</html>
<?php Database::disconnect();?>