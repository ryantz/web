<?php
session_start();
  if (isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    
  // Establish connection with DB
  @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
  if (mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.  Please try again later.';
    exit;
  }
  // Fetch row of data using product id
  $query = "SELECT * FROM product WHERE product_id = $product_id";
  $result = $db->query($query);
  $row = $result->fetch_assoc();
  // split the image path string into a array
  $image_arr =  explode(",","{$row['image']}");
  // get subcategory name
  $sub_cat_id = $row['category_id'];
  $query = "SELECT * FROM category WHERE category_id = $sub_cat_id";
  $result = $db->query($query);
  $sub_cat_row = $result->fetch_assoc();
  $sub_cat = $sub_cat_row['name'];
  $main_cat_id = $sub_cat_row['parent_id'];
  // get main category name
  $query = "SELECT * FROM category WHERE category_id = $main_cat_id";
  $result = $db->query($query);
  $main_cat_row = $result->fetch_assoc();
  $main_cat = $main_cat_row['name'];

 
  // Check for cart items
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }
  if ($_POST['quantity']) {
    $total = $row['price'] * $_POST['quantity'];
    $_SESSION['cart'][] = ['product_id'=>$product_id, 'name'=>$row['title'], 'price'=>$row['price'], 'quantity'=>$_POST['quantity'], 'image'=>$image_arr[0], 'colour'=>$_POST['colour'], 'subtotal'=>$total] ;
  }

  // print_r($_SESSION['cart']);


}else{
  echo "provide Product Id";
}


?>
<!Doctype html>
<html lang="en">
<head>
<title>Does IT All</title>
<meta charset=“utf-8”>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/product-details.css">
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
        <?php
          echo "
          <li><a href='products.php?category_id={$main_cat_id}'>{$main_cat}</a></li>
          <li><a href='products.php?category_id={$sub_cat_id}'>{$sub_cat}</a></li>
          <li>{$row['title']}</li>
          ";
        ?>
    </ul>

  <!-- content -->

  <main>
      <div class="productpage-row">
        <div class="productpage-column-left">
          <!-- Container for the image gallery -->
          <div class="productpage-slider">
            <!-- Full-width images with number text -->
            <?php 

            for ($i=0; $i<count($image_arr); $i++) {
              echo "
                <div class='mySlides'>
                  <img
                    src='assets/product/$image_arr[$i]'
                    style='width: 100%'
                  />
                </div>
              ";
            }
            ?>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <!-- Thumbnail images -->
            <div class="row">
              <?php 
              for ($i=0;$i<count($image_arr);$i++) {
                echo "
                  <div class='column'>
                    <img
                      class='demo cursor'
                      src='assets/product/$image_arr[$i]'
                      style='width: 100%'
                      onclick='currentSlide($i+1)'
                    />
                  </div>
                ";
              }
              ?>
        
            </div>
          </div>
        </div>
        <div class="productpage-column-right">
          <h4 class="product-title"><?php echo $row['title'] ?></h4>
          <p class="product-description"><?php echo $row['description'] ?></p>
          <span class="product-price">$<?php echo $row['price'] ?></span><br/><br/>
          <span class="product-color">Specification</span><br /><br />
          <form action="product-details.php?product_id=<?php echo $product_id ?>" method="POST">
              <div class="buttongroup">  
                <?php
                  $colours = explode(",", $row['colour']);
                  for ($i=0; $i <count($colours); $i++) {
                    echo "<input id='$colours[$i]' type='radio' value='$colours[$i]' name='colour' checked required/>
                          <label for='$colours[$i]' style='background-color: $colours[$i]; color: $colours[$i];'>$colours[$i]</label>";
                  }
                ?>
              </div>
            <br /><br />
            <span class="product-size">Quantity</span><br />
              <div class="quantity buttons_added">
                <input type="number" id='qty_id' name="quantity" step="1" min="1" value="1" title="Qty" size="3" onchange="validateQty()">
              </div>
              <br /><br />
              <input type="submit" id="addToCartBtn" value="Add to Cart">
          </form>
        </div>
      </div>
  </main>



  <!-- footer -->
  <footer>
      <script src="footer.js"></script>
  </footer>
</body>
<script type="text/javascript" src="productSlideshow.js"></script>
</html>