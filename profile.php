<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login2.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login2.php");
  }
?>
<!DOCTYPE html>
<!Doctype html>
<html lang="en">
<head>
<title>Does IT All</title>
<meta charset=“utf-8”>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/reg.css">
</head>
<body>
    <!-- navigation bar -->
    <nav class="navbar">
    <div class="nav">
        <a href="index.php" class="logo">Does IT All
        <span class="circ-pink"></span></a>
        <div class="search">
                <input type="text" class="search-box" placeholder="search brand, product">
                <button class="search-btn">search</button>
        </div>
        <div class="nav-items">
            <a href="profile.php" id = "logbtn"><img src="assets/navbar/user.png"></a>
            
            <a href="cart.php"><img src="assets/navbar/cart.png">
            <div class="cart_items"><?php echo count($_SESSION['cart']) ?></div></a>
        </div>
    </div>
	<ul class="links-container">
        <li class="link-item"><a href="products.php?category_id=1" class="link">Electronic Devices</a></li>
        <li class="link-item"><a href="products.php?category_id=2" class="link">Electronic Accessories</a></li>
        <li class="link-item"><a href="products.php?category_id=3" class="link">Home Appliances</a></li>
    </ul>
    </nav>



<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="profile.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>