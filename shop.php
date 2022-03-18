<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  include "config/databaseconnect.php";

  $products_result = mysqli_query($conn, "SELECT `p_id`, `p_name`, `p_price`, `p_description`, `p_quantity`, `p_image`, `c_name` 
    FROM `products`
    INNER JOIN category
    ON `products`.`c_id` = `category`.`c_id`;"
  );
  if (!$products_result) {
    echo "<script>alert('Products fetch failed!')</script>";
  }
  
  if (isset($_POST['addToCart'])) {
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    } 
    $_SESSION['cart'][] = $_POST['p_id'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "components/headtag.php" ?>
</head>
<body class="sub_page">
  <div class="hero_area">
    <?php include "components/header.php" ?>
  </div>
  <div class="container mt-5 mb-5">
    <!-- LOGIN ALERT -->
    <div class="alert alert-warning alert-dismissible fade show" role="alert" id="loginAlert" hidden>
      <strong>You are not logged in!</strong> Please <a href='login.php?lastPage=<?php echo $_SERVER['REQUEST_URI']?>'>Log In</a> to add items in your cart.
      <button type="button" class="btn-close" aria-label="Close"></button>
    </div>

    <div class="d-flex justify-content-center row">
      <div class="col-md-10">
        <?php 
        while ($row = mysqli_fetch_assoc($products_result)) {
        ?>
          <div class="row p-2 bg-white border rounded mt-2">
            <div class="col-md-3 mt-1">
              <img
                class="img-fluid img-responsive rounded product-image"
                src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['p_image']); ?>"
              />
            </div>
            <div class="col-md-6 mt-1">
              <h5 class="product-title" class="product-title"><?php echo $row['p_name'] ?></h5>
              <div class="d-flex flex-row">
                <div class="ratings mr-2">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div>
                <span><?php echo $row['c_name'] ?></span>
              </div>

              <p class="text-justify text-truncate para mb-0">
                <?php echo $row['p_description'] ?>.
              </p>
            </div>
            <div
              class="align-items-center align-content-center col-md-3 border-left mt-1"
            >
              <div class="d-flex flex-row align-items-center">
                <h4 class="mr-1">Rs <?php echo $row['p_price'] ?></h4>
                <span class="strike-text">Rs <?php echo (int)$row['p_price'] + (int)$row['p_price']*.30; ?></span>
              </div>
              <h6 class="text-success">Free shipping</h6>
              <div class="d-flex flex-column mt-4">
                <form method="POST" id="addToCartForm">
                  <input type="hidden" name="p_id" value="<?php echo $row['p_id']?>">
                  <input class="btn btn-primary btn-sm bg-primary addToCart" type="button" name="addToCart" value="Add to cart"/>
                </form>
                <span class="">Qty. Left: <?php echo $row['p_quantity'] ?></span>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
          </div>
        </div>
      </div>

  <?php include "components/footer.php" ?>
  <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <script>
    $(document).ready(function() {
      //$('#loginAlert').hide();
      $('.btn-close').click(() => $('#loginAlert').attr("hidden"));
      $('.addToCart').click(function() {
        let loggedIn = <?php echo json_encode(isset($_SESSION['user'])) ?>;
        if (loggedIn) { 
          $('.addToCart').removeAttr("type").attr("type", "submit");
        } else {
          $('#loginAlert').removeAttr("hidden");  
        }
      })
      
    })
  </script>
</body>
</html>