
<?php 
include "../../config/databaseconnect.php";

if (isset($_POST["submit"])) {
    $name = $_POST["txtname"];

    $query = "INSERT INTO `category`(`c_name`) VALUES ('$name')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location:index.php');
    }
    else {
        echo "<script>alert('New category did not not added!')</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<?php include "../components/headtag.php" ?>
<body class="sub_page">
  <div class="hero_area">
    <?php include "../components/headeradmin.php"?>
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
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <script type="text/javascript" src="../js/custom.js"></script>

</body>

</html>