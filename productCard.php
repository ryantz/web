<?php
    // Establish connection with DB
    @ $db = new mysqli('localhost', 'f32ee', 'f32ee', 'f32ee');
    if (mysqli_connect_errno()) {
      echo 'Error: Could not connect to database.  Please try again later.';
      exit;
    }
    // // Switch case to fetch shoes from their respective categories
    // switch ($category) {
    //   case "men":
    //     $fetchData = mysqli_query($db , "SELECT * FROM shoes_table WHERE category='men'");
    //     break;
    //   case "women":
    //     $fetchData = mysqli_query($db , "SELECT * FROM shoes_table WHERE category='women'");
    //     break;
    //   default:
    //     $fetchData = mysqli_query($db , "SELECT * FROM shoes_table");
    // }

    $category_id=$_GET['category_id'];
    if ($category_id == 0) {
    $query = "SELECT * FROM product";
    }
    else {
      // $query = "SELECT * FROM category WHERE parent_id = $category_id";
      $query = "SELECT * FROM product WHERE category_id = '$category_id'
      OR category_id IN (
      SELECT category_id FROM category 
      WHERE parent_id = $category_id
    )";
    }
    // // $query = "SELECT * FROM category WHERE parent_id = $category_id";
    //   $query = "SELECT * FROM product WHERE category_id = '$category_id'
    //   OR category_id IN (
    //   SELECT parent_id FROM category 
    //   WHERE category_id = $category_id
    // )";

    $result = $db->query($query);
    $num_results = $result->num_rows;  


    
    // Append to array to render product card
    // $num_results = $fetchData->num_rows;  
    // $arr = array();
    for ($i=0; $i <$num_results; $i++) {
      // $row = $fetchData->fetch_assoc();
      $row = $result->fetch_assoc();
      $image_arr = explode(",","{$row['image']}");
      echo "<div class='product-card'>
              <div class='product-image'>
                <a href='product-details.php?product_id={$row['product_id']}'>
                <img src='assets/product/{$image_arr[0]}' class='product-thumb'></a>
                <button class='card-btn'>add to whislist</button>
              </div>
              <div class='product-info'>
                <p class='product-short-des'>{$row['title']}</p>
                <span class='price'>\${$row['price']}</span><span class='actual-price'></span>
              </div>
            </div>";
    }
    ?>


            <!-- "<div class='product-card'>
              <div class='product-image'>
                <span class='discount-tag'>50% off</span>
                <a href='product-details.php?product_id={$row['product_id']}'>
                <img src='assets/product/{$image_arr[0]}' class='product-thumb'></a>
                <button class='card-btn'>add to whislist</button>
              </div>
              <div class='product-info'>
                <p class='product-short-des'>{$row['title']}</p>
                <span class='price'>\${$row['price']}</span><span class='actual-price'>$40</span>
              </div>
            </div>"; -->





