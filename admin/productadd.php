<?php 
include "../config/databaseconnect.php";

$categories_result = mysqli_query($conn, "SELECT * FROM `category`");
if (!$categories_result) {
  echo "<script>alert('Couldnt retrieve categories')</script>";
}

if (isset($_POST["submit"])) {
    $name = $_POST["txtname"];
    $price = $_POST["price"];
    $description = $_POST["txtdescription"];
    $quantity = $_POST["quantity"];
    $category = $_POST["c_id"];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    $query = "INSERT INTO `products`(`p_name`, `p_price`, `p_description`, `p_quantity`, `p_image`, `c_id`) 
              VALUES ('$name','$price','$description','$quantity','$image','$category')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Product Added!')</script>";
    }
    else {
        echo "<script>alert('Product couldnot be added!')</script>";
    }
}
?>
<!DOCTYPE html>
<html>
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

<body class="sub_page">
  <div class="hero_area">
    <?php include "../components/header.php" ?>
  </div>

  <!-- contact section -->
  <section class="contact_section layout_padding">
    <div class="container ">
      <div class="heading_container justify-content-center">
        <h2 class="">
          Product Add
        </h2>
      </div>

    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <form action="" method="POST" enctype="multipart/form-data">
            <div>
              <input type="text" placeholder="Name" name="txtname"/>
            </div>
            <div>
              <input type="number" placeholder="price" name="price"/>
            </div>
            <div>
              <input type="text" placeholder="Description" name="txtdescription" />
            </div>
            <div>
              <input type="number" placeholder="Quantity" name="quantity" />
            </div>
            <div>
            <select name="c_id"> 
            <script>
              </script>
              <?php 
              while ($row = mysqli_fetch_assoc($categories_result)) {
                
                echo "<option value='".$row['c_id']."'>".$row['c_name']."</option>";
              }
              ?>
            </select> 
            </div>
            <div>
              <input type="file" placeholder="Image" name="image" />
            </div>
            <div class="d-flex  mt-4 ">
            <button type="submit" name="submit">
                Register
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php include "../components/footer.php" ?>

  <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <script type="text/javascript" src="../js/custom.js"></script>

</body>

</html>