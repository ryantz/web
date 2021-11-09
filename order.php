<?php
    session_start();
    $id=session_id();
    
  // Check for cart items
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }
  // print_r($_SESSION['cart']);

  @ $db = new mysqli('localhost','f32ee','f32ee','f32ee');
    if(mysqli_connect_errno()){
        echo 'Error: Could not connect to database.  Please try again later.';
	  exit;
    }

  $order_id = $_POST['order_id'];

  $query="SELECT order_item.*, 
  product.product_id, product.title,product.price
  FROM product INNER JOIN order_item
  ON order_item.product_id = product.product_id
  WHERE order_item.order_id = $order_id
  ";
  $result = $db -> query($query); //query submission
  $num_results = $result->num_rows; //retrieve num of rows in result set    
  $item_names = array();
  $item_price = array();
  $item_quantity = array();  
  $item_spec =array();
  $total = 0;
  for ($j=0; $j <$num_results; $j++){
      $row = $result->fetch_assoc();        
      array_push($item_names,$row['title']);        
      array_push($item_price,$row['total_price']);  
      $total = $total+$row['total_price'];      
      array_push($item_quantity,$row['product_qty']);    
      array_push($item_spec,$row['spec']);                    
  }

  date_default_timezone_set("Asia/Singapore");
  $todaysDate = date("Y-m-d");
  $deliveryDate = date('Y-m-d', strtotime($Date. ' + 3 days'));
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
            <a href="login.php"><img src="assets/navbar/user.png"></a>
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
        <li>Order</li>
    </ul>




    <main>
        <form action="order.php" method="POST">
            <div align='center'id="order_tag"><label></i> Order ID  </label>
            <input type="number" id="order_id" name="order_id" placeholder="Enter Order_id"></div><br><br>
            <div class='submitinfoBtn' align='center'><input type="submit" id="submitinfoBtn" name="submit" value="Submit" /></div>
        </form><br><br><br>
        <?php 
          if ($order_id) {
            echo "<table class='itemsorderedTable'>
              <tr>
                <th style='font-size:x-large;background-color:#e8e8e8' colspan='5'>Items Ordered</th>
              </tr>          
              <tr>
                <th colspan='2'>Items Name</th> 
                <th>Specification</th>
                 
              <th>Quantity</th>
              <th>Price</th>         

              </tr>";                   
              echo "<tr>
                <td colspan='2'>"; 
                  foreach($item_names as $key=>$val)
                echo "{$val}<br><br>";
                echo "</td>";
                echo "<td>"; 
                  foreach($item_spec as $key=>$val)
                echo "{$val}<br><br>";
                echo "</td>";
                echo "<td>"; 
                  foreach($item_quantity as $key=>$val)
                echo "{$val}<br><br>";
                echo "</td>";
                echo "<td>"; 
                  foreach($item_price as $key=>$val) 
                echo "\${$val}<br><br>";
                echo "</td>";
                
                echo "
                </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total:</b></td>
                <td colspan='1'style='font-size: 18px;'>\$$total</td>
                </tr>
              </tr>
              <tr>
                <td colspan='2'style='font-size: 18px'><b>Order Status:</b> Reached local sorting facility.</td>
                <td colspan='2'style='font-size: 18px'><b>Estimated delivery:</b> {$deliveryDate}</td>
                </tr>        
            </table>";
          }
        ?>
          </main>
</div>
</body>
    <!-- footer -->
    <footer>
        <script src="footer.js"></script>
    </footer>
</html>
