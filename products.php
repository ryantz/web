<?php
  session_start();
  $id=session_id();
  
// Check for cart items
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  // Establish connection with DB
  @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
  if (mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.  Please try again later.';
    exit;
  }
  // // Fetch row of shoe data using id
  // $query = "SELECT * FROM shoes_table WHERE product_id = $subjectId";
  // $result = $db->query($query);
  // $row = $result->fetch_assoc();


  // // Check for cart items
  // if (!isset($_SESSION['cart'])) {
  //   $_SESSION['cart'] = array();
  // }
  // if ($_POST['quantity']) {
  //   $_SESSION['cart'][] = ['product_id'=>$subjectId, 'name'=>$row['name'], 'price'=>$row['price'], 'quantity'=>$_POST['quantity']] ;
  // }

  // print_r($_SESSION['cart']);

  $query = "SELECT * FROM category WHERE parent_id is NULL";
  $result = $db->query($query);
  $num_results = $result->num_rows;
  $main_cat_arr = array();
  for ($i=1; $i <$num_results+1; $i++) {
    $row = $result->fetch_assoc();
    // array_push($main_cat_arr, $row);
    $main_cat_arr[$i]=$row['name'];
  }

  $category_id=$_GET['category_id'];
  // echo "123category: $category_id";
  // echo "provide Id";
  $query = "SELECT * FROM category WHERE parent_id = $category_id";
  $result = $db->query($query);
  $num_results = $result->num_rows;
  $sub_cat_arr = array();
  for ($i=0; $i <$num_results; $i++) {
    $row = $result->fetch_assoc();
    array_push($sub_cat_arr, $row);
  }


  $query = "SELECT * FROM category";
  $result = $db->query($query);
  $num_results = $result->num_rows;
  $arr = array();
  for ($i=1; $i <$num_results+1; $i++) {
    $row = $result->fetch_assoc();
    array_push($arr, $row);
    $arr[$i]=$row;
  }

 

?>
<!Doctype html>
<html lang="en">
<head>
<title>Does IT All</title>
<meta charset=“utf-8”>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/products.css">

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

    <!-- left sidebar -->
    <nav class="left-sidebar">
        <ul class="sidenav">
            <?php 
               for ($i=0; $i <$num_results; $i++) {
                echo "
                <li><a href='products.php?category_id={$sub_cat_arr[$i]['category_id']}'>{$sub_cat_arr[$i]['name']}</a></li>
                ";
              }
            ?>
        </ul>
    </nav>

    <!-- breadcrumb navbar -->
    <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <?php
        if ($category_id == 1 || $category_id == 2 || $category_id == 3) {
          echo "
          <li>{$main_cat_arr[$category_id]}</li>
          ";
        }else {
          echo "
          <li><a href='products.php?category_id={$arr[$category_id]['parent_id']}'>{$main_cat_arr[$arr[$category_id]['parent_id']]}</a></li>
          <li>{$arr[$category_id]['name']}</li>
          ";
        }

        ?>
    </ul>

    <!-- Page content -->
    <div class="main">
        <div class="product-container" style="padding:0;">
            <?php 
            // $category=$_GET['category_id'];
            include "productCard.php"; ?>
            <!-- <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">50% off</span>
                    <img src="img/card1.png" class="product-thumb" alt="">
                    <button class="card-btn">add to whislist</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">brand</h2>
                    <p class="product-short-des">a short line about the cloth..</p>
                    <span class="price">$20</span><span class="actual-price">$40</span>
                </div>
            </div> -->

            


        </div>
    </div>


    <!-- footer -->
    <footer>
        <script src="footer.js"></script>
    </footer>
</body>
</html>