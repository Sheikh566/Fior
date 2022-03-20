<?php 
include "../../config/databaseconnect.php";

$categories_result = mysqli_query($conn, "SELECT * FROM `category`");
if (!$categories_result) {
  echo "<script>alert('Couldnt retrieve categories')</script>";
}
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $p_res = mysqli_query($conn, "SELECT * FROM `products` WHERE `p_id` = '$id'");
  $p_res = mysqli_fetch_row($p_res);
  if (isset($_POST["submit"])) {
    $name = $_POST["txtname"];
    $price = $_POST["price"];
    $description = $_POST["txtdescription"];
    $quantity = $_POST["quantity"];
    $category = $_POST["c_id"];
    
    $imageQuery = "";
    if (file_exists($_FILES['image']['tmp_name'])) {
      $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
      $imageQuery = ",`p_image` = '$image'";
    }

    $query = "UPDATE `products` SET 
    `p_name` = '$name',
    `p_price` = '$price',
    `p_description` = '$description',
    `p_quantity` = '$quantity',
    `c_id` = '$category'".$imageQuery."
    WHERE `p_id` = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location:index.php');
    }
    else {
        echo "<script>alert('Oops! Product details did not updated')</script>";
    }
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <?php include "../components/headtag.php" ?>
</head>

<body class="sub_page">
  <div class="hero_area">
    <?php include "../components/headeradmin.php" ?>
  </div>

  <section class="contact_section layout_padding">
    <div class="container ">
      <div class="heading_container justify-content-center">
        <h2 class="">Product Edit</h2>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <form action="" method="POST" enctype="multipart/form-data">
            <div>
              <label for="txtname">Name</label>
              <input type="text" placeholder="Name" name="txtname" value="<?php echo $p_res[1]?>"/>
            </div>
            <div>
              <label for="price">Price</label>
              <input type="number" placeholder="Price" name="price" value="<?php echo $p_res[2]?>"/>
            </div>
            <div>
              <label for="txtdescription">Description</label>
              <input type="text" placeholder="Description" name="txtdescription" value="<?php echo $p_res[3] ?>"/>
            </div>
            <div>
              <label for="quantity">Quantity</label>
              <input type="number" placeholder="Quantity" name="quantity" value="<?php echo $p_res[4]?>"/>
            </div>
            <div class="dropdown d-flex justify-content-between">
              <label for="c_id">Category: </label>
              <select name="c_id" class="btn btn-default dropdown-toggle"> 
                <?php 
                  while ($row = mysqli_fetch_assoc($categories_result)) {
                    if ($p_res[6] == $row['c_id']) {
                      echo "<option value='".$row['c_id']."' selected>".$row['c_name']."</option>";
                    } else {
                    echo "<option value='".$row['c_id']."'>".$row['c_name']."</option>";
                    }
                  }
                ?>
              </select> 
            </div>
            <div class="d-flex flex-row align-items-center justify-content-between">
              <label for="image" class="me-5">Image:</label>
              <input class="border-0 p-0 my-1 display-inline pt-2" type="file" placeholder="Image" name="image" />
            </div>

            <div class="d-flex mt-4 justify-content-between">
            <a href="index.php" class="btn btn-outline-primary rounded-pill pt-3">Cancel</a>
            <button type="submit" name="submit" class="mx-0">
                Submit
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript" src="../../js/bootstrap.js"></script>
  <script type="text/javascript" src="../../js/custom.js"></script>
</body>
</html>