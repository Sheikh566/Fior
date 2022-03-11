<?php 

include "databaseconnect.php";

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
if (isset($_GET['p_id'])) {
  $result = mysqli_query($conn, 
    "SELECT `p_id`, `p_name`, `p_price`, `p_description`, `p_quantity`, `p_image`
    FROM `products` WHERE `p_id` = ".$_GET['p_id']
  );
  if (!$result) {
    echo "<script>alert('Products could not be fetched')</script>";
  }
  array_push($_SESSION['cart'], mysqli_fetch_array($result));
  header('location:../shop.php');
}
?>