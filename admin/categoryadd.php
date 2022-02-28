
<?php 
include "../config/databaseconnect.php";

if (isset($_POST["submit"])) {
    $name = $_POST["txtname"];

    $query = "INSERT INTO `category`(`c_name`) VALUES ('$name')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Category Added!')</script>";
    }
    else {
        echo "<script>alert('New category did not not added!')</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include "../components/headtag.php"?>
</head>
<body class="sub_page">
  <div class="hero_area">
    <?php include "../components/header.php"?>
  </div>

  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="container ">
      <div class="heading_container justify-content-center">
        <h2 class="">
          Add a category
        </h2>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <form action="" method="POST">
            <div>
              <input type="text" placeholder="Category Name" name="txtname"/>
            </div>
            <div class="d-flex mt-4">
            <button type="submit" name="submit">
                Submit
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php include "../components/footer.php" ?>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>

</body>

</html>