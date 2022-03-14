<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include "config/databaseconnect.php";

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $ids = join(",", $_SESSION['cart']);
    echo "ids in cart session: ".$ids;
    $query = "SELECT `p_id`, `p_name`, `p_price`, `p_description`, `p_quantity`, `p_image`, `c_name` 
              FROM `products`
              INNER JOIN category
              ON `products`.`c_id` = `category`.`c_id` WHERE `p_id` IN (".$ids.")";
    if (count($_SESSION['cart']) > 0) {
        $products_result = mysqli_query($conn, $query);
        if (!$products_result) {
            echo "<script>alert('Error: ".mysqli_error($conn)."')</script>";
        }
    }
    $cartWorth = 0;       
    if (isset($_POST['confirm'])) {
        $u_id =  $_SESSION['user']['u_id'];
        $total = $_POST['total'] + (int)$_POST['delivery-type'];
        $orderResult = mysqli_query($conn, 
            "INSERT INTO `orders`(`o_date`, `u_id`, `o_total`) 
             VALUES (NOW(),'$u_id','$total')"
        );
        if ($orderResult) {
            $o_id = mysqli_insert_id($conn);
            foreach (array_unique($_SESSION['cart']) as $p_id) {
                $i_qty = count(array_keys($_SESSION['cart'], $p_id));
                $invoiceResult = mysqli_query($conn, 
                    "INSERT INTO `invoice`(`o_id`, `p_id`, `i_qty`) 
                     VALUES ('$o_id','$p_id','$i_qty')"
                );
                if (!$invoiceResult) {
                    echo "<script>alert('Error: ".mysqli_error($conn)."')</script>";
                }
            }
            $_SESSION['cart'] = [];
        } else {
            echo "<script>alert('Error: ".mysqli_error($conn)."')</script>";
        }
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "components/headtag.php"?>
  <link rel="stylesheet" href="css/cart.css">
</head>
<body class="sub_page">
    <div class="hero_area">
        <?php include "components/header.php" ?>
    </div>
    <br>
    <div class="card">
    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                      <h4><b>Shopping Cart</b></h4>
                    </div>
                    <div class="col align-self-center text-right text-muted">
                        <?php echo count(array_unique($_SESSION['cart'])) ?> items
                    </div>
                </div>
            </div>
            <!-- <============ CART ITEMS LIST GENERATOR ============> -->
            <?php 
            if (isset($products_result)) {
                foreach (mysqli_fetch_all($products_result) as $row) {
                    $cartWorth += count(array_keys($_SESSION['cart'], $row[0]))*$row[2]; // Multiply item price and item qty
            ?>     
                    <div class="row border-top border-bottom">
                        <div class="row main align-items-center">
                            <div class="col-2">
                                <img class="img-fluid" 
                                    src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row[5]); ?>"
                                >
                            </div>
                            <div class="col">
                                <div class="row text-muted"><?php echo $row[6] ?></div>
                                <div class="row"><?php echo $row[1] ?></div>
                            </div>
                            <div class="col quantity-panel">
                                <a href="config/changeCartQty.php?change=dec&itemId=<?php echo $row[0]?>" class="qty-minus">-</a>
                                <a href="#" class="border"><?php echo count(array_keys($_SESSION['cart'], $row[0])) ?></a>
                                <a href="config/changeCartQty.php?change=inc&itemId=<?php echo $row[0]?>" class="qty-plus">+</a>
                            </div>
                            <div class="col">Rs. <?php echo $row[2] ?>&nbsp;<sub>per item</sub>
                                <a class="close" href="config/changeCartQty.php?change=del&itemId=<?php echo $row[0]?>">&#10005;</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='row align-items-center'><i>Your cart is empty!</i></div>";
            }
            ?>
            <!-- <============ END - CART ITEMS LIST GENERATOR ============> -->
            <div class="back-to-shop">
                <a href="shop.php">&leftarrow;</a>
                <span class="text-muted">Back to shop</span>
            </div>
        </div>
        <!-- <============ BILLING SIDE PANEL ============> -->
        <div class="col-md-4 summary">
            <div>
                <h5><b>Summary</b></h5>
            </div>
            <hr>
            
            <form method="POST">
                <p>SHIPPING</p> 
                <select name="delivery-type" id="delivery-type">
                    <option class="text-muted" value="100">Standard Rs. 100</option>
                    <option class="text-muted" value="200">Express Rs. 200</option>
                </select>
                <p>COUPON CODE (optional)</p> 
                <input id="code" placeholder="Enter your code">
                <div class="row m-1">
                    <div class="col " style="padding-left:0;">GROSS TOTAL</div>
                    <div class="col text-right">Rs. <?php echo $cartWorth ?></div>
                </div>
                <div class="row m-1">
                    <div class="col " style="padding-left:0;">DELIVERY FEES</div>
                    <div class="col text-right" id="delivery-fees"></div>
                </div>
                <div class="row m-1">
                    <div class="col " style="padding-left:0;">COUPON DISCOUNT</div>
                    <div class="col text-right" id="delivery-fees">Rs. 0</div>
                </div>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col fs-5">NET TOTAL</div>
                    <div class="col text-right fs-5" id="net-total"></div>
                </div>
                <input type="hidden" name="total" value="<?php echo $cartWorth ?>">
                <button 
                    type="button"
                    class="btn btn-primary checkout-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop"
                >CHECKOUT
                </button>
                <!-- Modal -->
                <div 
                    class="modal fade" 
                    id="staticBackdrop" 
                    data-bs-backdrop="static" 
                    data-bs-keyboard="false" 
                    tabindex="-1" 
                    aria-labelledby="staticBackdropLabel" 
                    aria-hidden="true"
                >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body d-flex justify-content-center">
                                Rs. <h1 class="title-text-gradient" id="net-total-modal"></h1>
                            </div>
                        <div class="modal-footer">
                            <input type="submit" name='confirm' class="btn btn-primary" value="Pay"/>
                            <input type="button" class="btn btn-secondary" data-bs-dismiss="modal" value="Later"/>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- <============ END - BILLING SIDE PANEL ============> -->
    </div>
</div>
<br>

  <?php include "components/footer.php" ?>
  <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <script>
      $(document).ready(function() {
        //  <==== Calculates Net Total ====>
        let delivery = 100; // Default delivery is set "Standard"
        let cartWorth = parseInt(<?php echo $cartWorth?>);
        let netTotal =  cartWorth + delivery;
        $('#net-total').text("Rs. ".concat(netTotal));
        $('#net-total-modal').text(netTotal);
        $('#delivery-fees').text("Rs. ".concat(delivery));
        // Update Net Total on changing delivery type
        $("#delivery-type").on('change', function() {
            delivery = parseInt(this.value);
            netTotal = cartWorth + delivery;
            $('#net-total').text("Rs. ".concat(netTotal));
            $('#delivery-fees').text("Rs. ".concat(delivery));
        });
       
        $('.summary').css('opacity', <?php echo (count($_SESSION['cart']) == 1) ?>);
      })
  </script>
</body>
</html>