<?php
  session_start();
  $id=session_id();
  

// Check for cart items
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();

}

$customer_name=$_POST['firstname'];
$customer_email=$_POST['email'];
$customer_address=$_POST['address'];


 @ $db = new mysqli('localhost','f32ee','f32ee','f32ee');
 if(mysqli_connect_errno()){
     echo 'Error: Could not connect to database.  Please try again later.';
   exit;
 }
    
        $query = "INSERT INTO customer_billing values
        (null,'".$customer_name."', '".$customer_email."', '".$customer_address."')";
$result = $db->query($query); //query submission
//insert query results
    
?>
<!Doctype html>

<html lang="en">
<head>
<title>Does IT All</title>
<meta charset=“utf-8”>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/checkout.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- navigation bar -->
    <nav class="navbar">
    <div class="nav">
        <a href="index.php" class="logo">Does IT All
        <span class="circ-pink"></span></a>
        <div class="search">
                <input type="text" class="search-box" placeholder="search brand, product">
                <button class="search-btn"onclick="location.href='search.php';">search</button>
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
    <!-- checkout form -->
    <div class="row">
        <div class="col-75">
            <div class="container">
            <form action="user.php" method="post">

                <div class="row">
                <div class="col-50">
                    <h3>Billing Address</h3>
                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                    <input type="text" id="fname" name="firstname" placeholder="John M. Doe" onchange="validateName()" required>
                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                    <input type="text" id="email" name="email" placeholder="john@example.com" onchange="validateEmail()" required>
                    <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                    <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                    <label for="city"><i class="fa fa-institution"></i> City</label>
                    <input type="text" id="city" name="city" placeholder="New York">

                    <div class="row">
                    <div class="col-50">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" placeholder="NY">
                    </div>
                    <div class="col-50">
                        <label for="zip">Zip</label>
                        <input type="text" id="zip" name="zip" placeholder="10001" onchange="validateZip()" required>
                    </div>
                    </div>
                </div>

                <div class="col-50">
                    <h3>Payment</h3>
                    <label for="fname">Accepted Cards</label>
                    <div class="icon-container">
                    <i class="fa fa-cc-visa" style="color:navy;"></i>
                    <i class="fa fa-cc-amex" style="color:blue;"></i>
                    <i class="fa fa-cc-mastercard" style="color:red;"></i>
                    <i class="fa fa-cc-discover" style="color:orange;"></i>
                    </div>
                    <label for="cname">Name on Card</label>
                    <input type="text" id="cname" name="cardname" placeholder="John More Doe" onchange="validateName()" required>
                    <label for="ccnum">Credit card number</label>
                    <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" onchange="validateCard()" required>
                    <label for="date">Exp date</label>
                    <input type="month" id="expdate" name="expdate" onchange="validateDate()" required>
                    

                    <div class="row">
                    <div class="col-50">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="352" onchange="validateCVV()" required>
                    </div>
                    </div>
                </div>

                </div>
                <label>
                <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                </label>
                <input type="submit" value="Continue to checkout" class="btn" name="btn" >
            </form>
            </div>
        </div>

        <div class="col-25">
            <div class="container">
            <h4>Cart
                <span class="price" style="color:black">
                <i class="fa fa-shopping-cart"></i>
                
                </span>
            </h4>
            <p><a href="cart.php">Click here to see cart again</a> </p>
            
           
            </div>
        </div>
    </div>




    <!-- footer -->
    <footer>
        <script src="footer.js"></script>
    </footer>
    <script type="text/javascript" src="validate.js"></script>
</body>
</html>