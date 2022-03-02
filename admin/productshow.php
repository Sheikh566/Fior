<?php 
include "../config/databaseconnect.php";

$result = mysqli_query($conn, "SELECT * FROM `products`");
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
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />
</head>
<body>
  <div class="hero_area">
    <?php include "../components/header.php" ?>
  </div>
    <table class="table table-striped">
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
        while ($row = $mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $row['p_id']?></td>
                <td><?php echo $row['p_id']?></td>
                <td><?php echo $row['p_id']?></td>
                <td><?php echo $row['p_id']?></td>
                <td><?php echo $row['p_id']?></td>
                <td><?php echo $row['p_id']?></td>
                <td><?php echo $row['p_id']?></td>
            </tr>
        <?php } ?>
    </table>


  <?php include "../components/footer.php" ?>

  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <script type="text/javascript" src="../js/custom.js"></script>
</body>
</html>