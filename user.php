<?php
session_start();
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

// stablish connection with DB
@ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
if (mysqli_connect_errno()) {
  echo 'Error: Could not connect to database.  Please try again later.';
  exit;
}
?>
<!Doctype html>
<html lang="en">
<head>
<title>Does IT All</title>
<meta charset=“utf-8”>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/order.css">

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
            <a href="profile.php"><img src="assets/navbar/user.png"></a>
            <a href="cart.php"><img src="assets/navbar/cart.png">
            <div class="cart_items"><?php echo count($_SESSION['cart']) ?></div></a>
        </div>
    </div>
    <ul class="links-container">
        <li class="link-item"><a href="products.php?category_id=1" class="link">Electronic Devices</a></li>
        <li class="link-item"><a href="products.php?category_id=2" class="link">Electronic Accessories</a></li>
        <li class="link-item"><a href="products.php?category_id=3" class="link">Home Appliances</a></li>
        <li class="link-item"><a href="order.php" class="link">Track Your Order</a></li>
    </ul>
    </nav>
    <main>
        <h2>DELIVERY INFO</h2>
        <form action="confirmation.php" method="POST">
        <table class="orderconfirmTable" align='center'>
          <tr>
            <th><label>Customer Name:</label></th>
            <td><input
              type="text"
              textarea rows='2' cols='50'
              id="customer_name"
              name="customer_name"
              placeholder="Enter your name here"
              onchange="validateName()"
              required
            /></td>
          </tr>
          <tr>
            <th><label>Email:</label></th>
            <td><input
              type="text"
              id="email"
              name="email"
              placeholder="Enter your email address here"
              onchange="validateEmail()"
              required
            /></td>
          </tr>
          <tr>
            <th><label>Contact:</label></th>
            <td><input
              type="text"
              id="phone"
              name="phone"
              placeholder="Enter your contact no. here"
              onchange="validateContact()"              
              required
            /></td>
          </tr>
          <tr>
            <th><label>Address:</label></th>
            <td><input
              type="text"
              id="address"
              name="address"
              placeholder="Enter your delivery address here"              
              required
            /></td>
          </tr>          
        </table><br><br>        
          <div class='submitinfoBtn' align='center'><input type="submit" id="submitDeliveryInfoBtn" name="submit" value="Submit" />
          <input type="reset" id="submitDeliveryInfoBtn" name="clear" value="Clear" /></div>          
        </form>
    </main>
</div>
</body>
<footer>
<script src="footer.js"></script>
</footer>
<script type="text/javascript" src="validate.js"></script>
</html>
