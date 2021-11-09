<?php
  session_start();
  $id=session_id();
 
  // Check for cart items
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }
  if ($_POST['quantity']) {
    $_SESSION['cart'][] = ['product_id'=>$subjectId, 'name'=>$row['name'], 'price'=>$row['price'], 'quantity'=>$_POST['quantity']] ;
  }
  //check if quanities exist, if it does put into array

  if (isset($_GET['delete'])) {
    $_SESSION['subtotal'] -= $_SESSION['cart'][$_GET['delete']]['price'];
    unset($_SESSION['cart'][$_GET['delete']]);
    header('location: ' . $_SERVER['PHP_SELF']);
    exit();
  }  


?>

<!Doctype html>
<html lang="en">
<head>
<title>Does IT All</title>
<meta charset=“utf-8”>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <!-- navigation bar -->
    <nav class="navbar">
    <div class="nav">
        <a href="index.php" class="logo">Does IT All
        <span class="circ-pink"></span></a>
        <div class="search">
                <input type="text" class="search-box" placeholder="search brand, product">
                <button class="search-btn" onclick="location.href='search.php';">search</button>
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

    <!-- breadcrumb navbar -->
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Cart</li>
    </ul>


    <!-- content -->
    <main>
        <?php
          if ($_SESSION['cart']) {
              echo "<form action='user.php' method='POST'>";
              echo "<div id='cartWrapper'>
                      <table class='cartTable'>
                          <tr>
                            <th colspan='2'>ITEM</th>
                            <th>SPEC</th>
                            <th>QTY</th>
                            <th>PRICE</th>
                            <th>DELETE</th>
                          </tr>";
                  $subtotal = 0;
                  foreach ($_SESSION['cart'] as $key=>$value) {
                      $total = $value['price'] * $value['quantity'];
                      
                    echo "<tr>
                            <td><img id='shoe' src='assets/product/{$value['image']}' width='100px' ></td>
                            <td>{$value['name']}\n<div style='color:grey;font-size:16px'>{$value['color']} </div></td> 
                            <td><label style='background-color:{$value['colour']}; color:{$value['colour']};padding:5px;'>{$value['colour']}</label></td>
                            <td>{$value['quantity']}</td>
                            <td>\$<label id='itemCost'>$total</td>
                            <input type='hidden' id='itemPrice' value='{$value['price']}'>
                            <td><a href='{$_SERVER['PHP_SELF']}?delete=$key'><img id='delete' src='assets/cart/trash.png'></a></td>
                          </tr>";
                    $subtotal = $subtotal + $total;
                    

                    
                
                    
                  } 
                    
                  
              echo "</table>
                    </div>
                    <hr class='solid'><br>
                    <span class='cartTotal'>SUBTOTAL: \$$subtotal </span><br><br><br><br>
                    
                  
                    </form>
                    <a href='checkout.php'><button id='checkoutBtn' name= 'cbtn'>CHECKOUT</button></a>
                    <a href='index.php'><button id='backBtn'>BACK TO SHOPPING</button></a>";
                    

                    
          } else {
            echo "<div align='center' style='font-size: 18px;'>Oops! Looks like your cart is empty!</div>";
          }
          ?>
    </main>




    <!-- footer -->
    <footer>
        <script src="footer.js"></script>
    </footer>
</body>
</html>