<?php 
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"])."/fior/";
include  $rootDir."config\databaseconnect.php";

$result = mysqli_query($conn, "SELECT `p_id`, `p_name`, `p_price`, `p_description`, `p_quantity`, `p_image`, `c_name` 
  FROM `products`
  INNER JOIN `category`
  ON `products`.`c_id` = `category`.`c_id`;"
);
if (!$result) {
    echo "<script>alert('Products could not be fetched')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Fior</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href= "../../css/bootstrap.css" rel="stylesheet" />
</head>
<body>
  <?php include $rootDir."components\header.php" ?>
  <div class="container">
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Photo</th>
        </tr>
        <?php 
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
              <td><?php echo $row['p_id']?></td>
              <td><?php echo $row['p_name']?></td>
              <td><?php echo $row['p_description']?></td>
              <td><?php echo $row['p_price']?></td>
              <td><?php echo $row['p_quantity']?></td>
              <td><?php echo $row['c_name']?></td>
              <td>
                <img
                  class="img-fluid img-thumbnail img-responsive rounded product-image"
                  src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['p_image']); ?>"
                />
              </td>
            </tr>
        <?php } ?>
    </table>
  </div>


  <?php include $rootDir."components/footer.php" ?>

  <script type="text/javascript" src="<?php echo $rootDir."js/jquery-3.4.1.min.js"?>"></script>
  <script type="text/javascript" src="<?php echo $rootDir."js/bootstrap.bundle.js"?>"></script>
  <script type="text/javascript" src="<?php echo $rootDir."js/custom.js"?>"></script>
</body>
</html>