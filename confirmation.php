<?php
   

    
    session_start();
    $id=session_id();
    

  // Check for cart items
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

//create short variables
$customer_name=$_POST['customer_name'];
$customer_email=$_POST['email'];
$customer_address=$_POST['address'];
$customer_contact=$_POST['phone'];


if (!$customer_name || !$customer_email || !$customer_contact || !$customer_address) {
  echo "You have not entered all the required details.<br />"
       ."Please go back and try again.";
  exit;
}
@ $db = new mysqli('localhost','f32ee','f32ee','f32ee');
    if(mysqli_connect_errno()){
        echo 'Error: Could not connect to database.  Please try again later.';
	  exit;
    }
    $query = "INSERT INTO customer_order values
            (null,'".$customer_name."', '".$customer_email."', '".$customer_address."', '".$customer_contact."')";
    $result = $db->query($query); //query submission
    //insert query results
    if ($result) {
      // echo  $db->affected_rows." book inserted into database.";
          
      // Get the last index in the log to be assigned the order_id, push order into orders-details
      $queryLastIndex = "SELECT MAX( customer_id ) FROM `customer_order`;";
      // echo $queryLastIndex;
      $lastIndex = $db->query($queryLastIndex);
      $row = $lastIndex->fetch_assoc();
      $lastIndex = $row['MAX( customer_id )'];
      // echo ( $lastIndex);
      
    } else {
      echo "An error has occurred.  The item was not added.";
    }

    // Assigns KV pair for items in cart
    foreach ($_SESSION['cart'] as $key=>$value) {
      $product_id = $value['product_id'];
      $total_price = $value['subtotal'];
      $quantity = $value['quantity'];
      $spec = $value['colour'];

      $query = "INSERT INTO order_item values
            ($lastIndex,'".$product_id."', '".$quantity."', '".$total_price."', '".$spec."')";
      $result = $db->query($query); //query submission
      // echo  $db->affected_rows." item inserted into database.";

    }

    // Combine 2 tables to one with customer_id=order_id
    $query="SELECT order_item.*, customer_order.*, product.product_id, product.title 
    FROM product INNER JOIN order_item
    ON order_item.product_id = product.product_id INNER JOIN  customer_order 
    ON order_item.order_id =  customer_order.customer_id     
    ";
    $result = $db -> query($query); //query submission
    $num_results = $result->num_rows; //retrieve num of rows in result set
    $arr = array();    
    for ($i=0; $i <$num_results; $i++){
        $row = $result->fetch_assoc();        
        array_push($arr,$row);//push row array into bigger array
        }    
    // print_r($arr);
    

    $query="SELECT order_item.*, 
    product.product_id, product.title, product.price
    FROM product INNER JOIN order_item
    ON order_item.product_id = product.product_id
    WHERE order_item.order_id = (SELECT MAX(order_item.order_id) FROM order_item)
    ";
    $result = $db -> query($query); //query submission
    $num_results = $result->num_rows; //retrieve num of rows in result set    
    $item_names = array();
    $item_price = array();
    $item_qty = array();
    $item_spec = array();
    $total = 0;
    for ($j=0; $j <$num_results; $j++){
        $row = $result->fetch_assoc();        
        array_push($item_names,$row['title']);        
        array_push($item_price,$row['total_price']);
        $total = $total+$row['total_price'];      
        array_push($item_qty,$row['product_qty']);                  
        array_push($item_spec,$row['spec']);                  
    }
    $to      = 'f32ee@localhost';
    $subject = 'Order Confirmed!';
    $message = "Greetings from Does TI all! Thank you for using our platform, your order has been confirmed! \nOrder Id: {$lastIndex}. This Order id can be used to track the status of your package under the Track Your Order tab in the Navigation Bar.";
    $headers = 'From: f32ee@localhost' . "\r\n" .
        'Reply-To: f32ee@localhost' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers,'-ff32ee@localhost');
    // echo ("mail sent to : ".$to);
    session_destroy(); //stop cart session after confirmation
  
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

     <!-- breadcrumb navbar -->
     <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Order Confirmation</li>
    </ul>


      <main>
        <table class="orderconfirmTable">
          <tr>
            <th>Order ID: </th>
            <td><?php echo $arr[$i-1]['order_id']?></td>
          </tr>
          <tr>
            <th>Customer Name: </th>
            <td><?php echo $arr[$i-1]['customer_name']?></td>
          </tr>
          <tr>
            <th>Email: </th>
            <td><?php echo $arr[$i-1]['email']?></td>
          </tr>
          <tr>
            <th>address: </th>
            <td><?php echo $arr[$i-1]['address']?></td>
          </tr>
          <tr>
            <th>phone: </th>
            <td><?php echo $arr[$i-1]['phone']?></td>
          </tr>
        </table>
        <table class='itemsorderedTable'>
          <tr>
            <th style='font-size:x-large;background-color:#e8e8e8' colspan='5'>Items Ordered</th>
          </tr>          
          <tr>
            <th colspan='2'>Items Name</th>                  
          <th>Spec</th>     
          <th>Qty</th>         
          <th>Subtotal</th>         
          
          </tr>                      
          <tr>
            <td colspan='2'><?php foreach($item_names as $key=>$val)
            echo "{$val}<br><br>"?>
            </td>
            <td><?php foreach($item_spec as $key=>$val)
            echo "{$val}<br><br>"?>
            </td>
            <td><?php foreach($item_qty as $key=>$val)
            echo "{$val}<br><br>"?>
            </td>
            <td><?php foreach($item_price as $key=>$val)
            echo "\${$val}<br><br>"?>
            </td>
          </tr>    
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total: </b></td>
            <?php echo "
            <td>\$$total</td>
            ";
            ?>
          </tr>
        </table>
        </br></br>
        <a href="index.php"><button id="backBtn">BACK TO SHOPPING</button></a>            
      </main>
    </div>
  </body>
  <!-- footer -->
  <footer>
        <script src="footer.js"></script>
  </footer>
</html>