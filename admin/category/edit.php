<?php 
include "../../config/databaseconnect.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $cat_res = mysqli_query($conn, "SELECT `c_name` FROM `category` WHERE `c_id` = '$id'");
  if (isset($_POST["submit"])) {
    $name = $_POST["txtname"];

    $query = "UPDATE `category` SET `c_name` = '$name' WHERE `c_id` = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location:index.php');
    }
    else {
        echo "<script>alert('Oops! Category name did not updated')</script>";
    }
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

  <!--  -->
  <section class="contact_section layout_padding">
    <div class="container ">
      <div class="heading_container justify-content-center">
        <h2 class="">
          Edit Category
        </h2>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <form action="" method="POST">
            <div>
              <input type="text" placeholder="Category Name" value='<?php echo mysqli_fetch_row($cat_res)[0] ?>' name="txtname"/>
            </div>
            <div class="d-flex mt-4">
            <button type="submit" name="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <script type="text/javascript" src="../js/custom.js"></script>

</body>
</html>