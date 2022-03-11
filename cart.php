<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include "config/databaseconnect.php";

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $ids = "'".implode("','", $_SESSION['cart'])."'";
    $ids = "'3','4'";
    echo "<script>console.log(".json_encode($ids).")</script>";
    // $products_result = mysqli_query($conn, 
    //     "SELECT `p_id`, `p_name`, `p_price`, `p_description`, `p_quantity`, `p_image`, `c_name` 
    //     FROM `products`
    //     INNER JOIN category
    //     ON `products`.`c_id` = `category`.`c_id` WHERE `p_id` IN (".$ids.")"
    // );
    $products_result = mysqli_query($conn, 
        "SELECT `p_id`, `p_name`, `p_price`, `p_description`, `p_quantity`, `p_image`
        FROM `products` WHERE `p_id` = 3"
    );
    if (!$products_result) {
        echo "<script>alert('Error: ".mysqli_error($conn)."')</script>";
    } else {
        echo "<script>console.log(".json_encode(mysqli_fetch_assoc($products_result)).")</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "components/headtag.php"?>
  <link rel="stylesheet" href="css/cart.css">
</head>
<body>
  <?php include "components/header.php" ?>
    <br>
    <div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                      <h4><b>Shopping Cart</b></h4>
                    </div>
                    <div class="col align-self-center text-right text-muted">3 items</div>
                </div>
            </div>
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                  <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/1GrakTl.jpg"></div>
                  <div class="col">
                      <div class="row text-muted">Shirt</div>
                      <div class="row">Cotton T-shirt</div>
                    </div>
                  <div class="col"> <a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a> </div>
                  <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
            <?php 
            while($row = mysqli_fetch_assoc($products_result)) {
            ?>
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2">
                        <img class="img-fluid" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['p_image']); ?>">
                    </div>
                    <div class="col">
                        <div class="row text-muted"></div>
                        <div class="row"><?php echo $row['p_name'] ?></div>
                    </div>
                    <div class="col">
                        <a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a> 
                    </div>
                    <div class="col">Rs. <?php echo $row['p_price'] ?> <span class="close">&#10005;</span></div>
                </div>
            </div>
            <?php
            }
            ?>
            
            <div class="row border-top border-bottom">
                <div class="row main align-items-center">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/pHQ3xT3.jpg"></div>
                    <div class="col">
                        <div class="row text-muted">Shirt</div>
                        <div class="row">Cotton T-shirt</div>
                    </div>
                    <div class="col"> <a href="#">-</a><a href="#" class="border">1</a><a href="#">+</a> </div>
                    <div class="col">&euro; 44.00 <span class="close">&#10005;</span></div>
                </div>
            </div>
            <div class="back-to-shop"><a href="shop.php">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
        </div>
        <div class="col-md-4 summary">
            <div>
                <h5><b>Summary</b></h5>
            </div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0;">ITEMS 3</div>
                <div class="col text-right">&euro; 132.00</div>
            </div>
            <form>
                <p>SHIPPING</p> <select>
                    <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                </select>
                <p>GIVE CODE</p> <input id="code" placeholder="Enter your code">
            </form>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">TOTAL PRICE</div>
                <div class="col text-right">&euro; 137.00</div>
            </div><button class="checkout-btn">CHECKOUT</button>
        </div>
    </div>
</div>
<br>

  <?php include "components/footer.php" ?>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>