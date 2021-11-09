<?php
    session_start();
    $id=session_id();
    
  // Check for cart items
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }
//   if ($_POST['quantity']) {
//     $_SESSION['cart'][] = ['product_id'=>$$product_i, 'name'=>$row['name'], 'price'=>$row['price'], 'quantity'=>$_POST['quantity']] ;
//   }

//   print_r($_SESSION['cart']);
?>
<!Doctype html>
<html lang="en">
<head>
<title>Does IT All</title>
<meta charset=“utf-8”>
<link rel="stylesheet" href="css/style.css">
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

    <!-- hero section -->
    <header class="hero-section">
        <div class="content">
            <!-- Slideshow container -->
            <div class="slideshow-container">
                <!-- Full-width images with number and caption text -->
                <div class="mySlides">
                <div class="numbertext">1 / 3</div>
                <!-- source: https://www.google.com/url?sa=i&url=https%3A%2F%2Fmegabonus.com%2Fen%2Fblog%2F11-11-sale-current-events%2F&psig=AOvVaw3E-74jv6OSF98AhMz_rrbm&ust=1635445115848000&source=images&cd=vfe&ved=0CAgQjRxqFwoTCPDGuq2a6_MCFQAAAAAdAAAAABAr -->
                <img src="assets/home/sales1.jpg">
                </div>
            
                <div class="mySlides">
                <div class="numbertext">2 / 3</div>
                <!-- source: https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.wowktv.com%2Fnews%2Fthe-best-deals-this-year-for-black-friday%2F&psig=AOvVaw24V61qufP26fVCkYo0TaOS&ust=1635445410404000&source=images&cd=vfe&ved=0CAgQjRxqFwoTCJCs4Iib6_MCFQAAAAAdAAAAABAD -->
                <img src="assets/home/sales2.jpg">
                </div>
            
                <div class="mySlides">
                <div class="numbertext">3 / 3</div>
                <!-- source: https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.omnisend.com%2Fblog%2Fbiggest-sales-of-the-year%2F&psig=AOvVaw3E-74jv6OSF98AhMz_rrbm&ust=1635445115848000&source=images&cd=vfe&ved=0CAgQjRxqFwoTCPDGuq2a6_MCFQAAAAAdAAAAABAJ -->
                <img src="assets/home/sales3.jpg">
                </div>
            
                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                <!-- The dots/circles -->
                <div class="dots">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
            <br>
        </div>
    </header>

    <!-- collections -->
    <section class="featured-product">
        <h2 class="featured-title">Categories</h2>
        <div class="category-container">
            <a href="products.php?category_id=1" class="category">
                <!-- source: https://similarpng.com/digital-laptops-on-transparent-background-png/#getdownload -->
                <img src="assets/home/category1.png">
                <p class="category-title">Electronic <br>Devices</p>
            </a>
            <a href="products.php?category_id=2" class="category">
                <!-- source: https://www.seekpng.com/ipng/u2w7i1u2w7u2y3y3_iphone-chargers-iphone-10-charger-cable/ -->
                <img src="assets/home/category2.png">
                <p class="category-title">Electronic <br>Accessories</p>
            </a>
            <a href="products.php?category_id=3" class="category">
                <!-- source: https://similarpng.com/household-appliances-on-transparent-background-png/#getdownload -->
                <img src="assets/home/category3.png">
                <p class="category-title">Home Appliances</p>
            </a> 
        </div>
    </section>

    <!-- latest product -->
    <section class="featured-product">
        <h2 class="featured-title">Most Popular</h2>
        <div class="product-container">
            <?php include "productCard.php" ?>
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
    </section>



    <!-- footer -->
    <footer>
        <script src="footer.js"></script>
    </footer>
</body>
<script type="text/javascript" src="heroSlideshow.js"></script>
</html>
