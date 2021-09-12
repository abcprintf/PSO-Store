<?php
    session_start();
    $session_id = session_id();
    include 'config/connect.php';
    //connect
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
    if(!empty($_GET)){
        if($_GET['success'] == 1){
            echo '<div id="alert" class="success callout" style="margin-bottom:-8px;"></div>';
        }else if($_GET['Error'] == 1){
            echo '<div id="alert-2" class="alert callout" style="margin-bottom:-8px;"></div>';	
        }
    }

 	$user_login = null;
    $adidas_member_user = null;
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
</head>

<body>
<!-- // topbar // -->
<div class="top-bar">
  <div class="row">
    <div class="top-bar-left">
      <ul class="dropdown menu" data-dropdown-menu>
        <li class="brand"><a href="index.php"><i class="fa fa-bars"></i> PsO</a></li>
        <li> <a href="#">online shop</a>
          <ul class="menu vertical">
            <li><a href="men.php">Men</a></li>
            <li><a href="women.php">Women</a></li>
            <li><a href="kids.php">Kids</a></li>
          </ul>
        </li>
        <li><a href="#">sports</a>
          <ul class="menu vertical">
            <li><a href="football.php">football</a></li>
            <li><a href="running.php">running</a></li>
            <li><a href="neo.php">neo</a></li>
            <li><a href="training.php">traning</a></li>
          </ul>
        </li>
        <?php if($user_login !== null){ ?>
        <li><a href="payment.php">payment</a></li>
        <?php } ?>
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

            if($user_login !== null){ ?>
        <li> <a href="cart.php"><span class="badge"><?php echo $total;?></span></i></a>
          <?php } ?>
        <li> <a href="#"> <?php echo $adidas_member_user;?> <i class="fa fa-user"></i></a>
          <ul class="menu vertical">
            <?php if($user_login !== null){ ?>
            <li><a href="profile.php">profile</a></li>
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
<!-- modal content --> 
<!-- // login // -->
<div class="tiny reveal" id="exampleModal1" data-reveal>
  <div class="row">
    <div class="large-12 columns auth-plain">
      <h3>Singin.</h3>
      <div class="signup-panel left-solid">
        <form action="check_login.php" method="post">
          <div class="row collapse">
            <div class="input-group"> <span class="input-group-label"><i class="fa fa-user"></i></span>
              <input class="input-group-field" type="text" name="username" required>
            </div>
          </div>
          <div class="row collapse">
            <div class="input-group"> <span class="input-group-label"><i class="fa fa-unlock-alt"></i></span>
              <input class="input-group-field" type="password" name="password" required>
            </div>
          </div>
          <button type="submit" class="primary button">Singin</button>
        </form>
      </div>
    </div>
  </div>
  <button class="close-button" data-close aria-label="Close modal" type="button"> <span aria-hidden="true">&times;</span> </button>
</div>
<!-- // register // -->
<div class="reveal" id="exampleModal2" data-reveal>
  <div class="row">
    <div class="large-12 columns auth-plain">
      <form action="sent_register.php" method="post">
        <h3>Register Form.</h3>
        <div class="signup-panel left-solid">
          <div class="row collapse">
            <div class="input-group"> <span class="input-group-label"><i class="fa fa-user"></i> Username:</span>
              <input class="input-group-field" type="text" name="username" required>
            </div>
          </div>
          <div class="row collapse">
            <div class="input-group"> <span class="input-group-label"><i class="fa fa-unlock-alt"></i> Password:</i></span>
              <input class="input-group-field" type="password" name="password" required>
            </div>
          </div>
          <div class="row collapse">
            <div class="input-group"> <span class="input-group-label"><i class="fa fa-envelope-o"></i> Email:</i></span>
              <input class="input-group-field" type="email" name="email" required>
            </div>
          </div>
          <button type="submit" class="primary button">Submit</button>
        </div>
      </form>
    </div>
  </div>
  <button class="close-button" data-close aria-label="Close modal" type="button"> <span aria-hidden="true">&times;</span> </button>
</div>
<!-- modal content -->
<div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
  <ul class="orbit-container">
    <button class="orbit-previous" aria-label="previous"><span class="show-for-sr">Previous Slide</span>&#9664;</button>
    <button class="orbit-next" aria-label="next"><span class="show-for-sr">Next Slide</span>&#9654;</button>
    <li class="orbit-slide is-active"> <img class="orbit_img" src="img/header_adidas_1.jpg"> </li>
    <li class="orbit-slide"> <img class="orbit_img" src="img/header_adidas_2.jpg"> </li>
    <li class="orbit-slide"> <img class="orbit_img" src="img/header_adidas_3.jpg"> </li>
  </ul>
</div>
<hr>
<div class="row text-center">
  <div class="large-6 columns">
    <div> <a href="men.php"><img class="thumbnail" src="img/adidas_1.jpg">
      <h5>tubular men's</h5>
      </a> </div>
    <div> <a href="kids.php"><img class="thumbnail" src="img/adidas_3.jpg">
      <h5>control everything</h5>
      </a> </div>
  </div>
  <div class="large-6 columns">
    <div> <a href="women.php"><img class="thumbnail" src="img/adidas_2.jpg">
      <h5>tubular women's</h5>
      </a> </div>
    <div> <a href="#"><img class="thumbnail" src="img/adidas_4.jpg">
      <h5>her energy.her style.her story.</h5>
      </a> </div>
  </div>
</div>
<!-- row -->
<div class="callout2"></div>
<div class="row">
  <div class="large-12 columns">
    <div class="row collapse connect">
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
    $("#alert").html("Register Success!", "inline").fadeOut(3000);
    $("#alert-2").html("Login Fail!", "inline").fadeOut(3000);
</script>
</body>
</html>
<?php Database::disconnect(); ?>