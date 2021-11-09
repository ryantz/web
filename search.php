<?php
// Establish connection with DB
  @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
  if (mysqli_connect_errno()) {
    echo 'Error: Could not connect to database.  Please try again later.';
    exit;

    $search = $_GET['search'];

    if(isset($_GET['sbtn'])){

        $query = " SELECT * FROM product WHERE 'title' LIKE  '%.$search.%'";
        $result - $db->query($query);
        $num_results = $results ->num_rows;

        echo "Number of items found:" .$num_Results.;
    }
    

  }
?>

<!Doctype html>
<html lang="en">
<head>
<title>Does IT All</title>
<meta charset=“utf-8”>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/search.css">
</head>
<body>
    <!-- navigation bar -->
    <nav class="navbar">
    <div class="nav">
        <a href="index.php" class="logo">Does IT All
        <span class="circ-pink"></span></a>
        <form method="get", action="search.php">
        <div class="search">
                <input type="text" name= "search" class="search-box" placeholder="search brand, product">
                <button class="search-btn"  name= "sbtn">search</button>
        </div>
</form>
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

    <!-- search results-->
    <section class="search-results">
        <h2 class="heading">search results for <span>product</span></h2>
        <div class="product-container" style="padding:0;">
            <?php include "productCard.php" ?>
    </section>



    <!-- footer -->
    <footer>
        <script src="footer.js"></script>
    </footer>
</body>
</html>