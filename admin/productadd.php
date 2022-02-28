
<?php 
include "../config/databaseconnect.php";

$categories_result = mysqli_query($conn, "SELECT * FROM `category`");
if (!$categories_result) {
  echo "<script>alert('Could'nt retrieve categories')</script>";
}

if (isset($_POST["submit"])) {
    $name = $_POST["txtname"];
    $email = $_POST["txtemail"];
    $phone = $_POST["txtphone"];
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    $query = "INSERT INTO `users`(`u_name`, `u_email`, `u_phone`, `u_password`) VALUES ('$name','$email','$phone','$password')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Registered!')</script>";
    }
    else {
        echo "<script>alert('Registeration Failed!')</script>";
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
    <?php include "../components/header.php" ?>
  </div>
    <?php 
    include "../config/databaseconnect.php";

    if (isset($_POST["submit"])) {
        $name = $_POST["txtname"];
        $email = $_POST["txtemail"];
        $phone = $_POST["txtphone"];
        $password = $_POST["txtpassword"];

        $query = "INSERT INTO `users`(`u_name`, `u_email`, `u_phone`, `u_password`) VALUES ('$name','$email','$phone','$password')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>alert('Registered!')</script>";
        }
        else {
            echo "<script>alert('Registeration Failed!')</script>";
        }
    }
    ?>

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
          <form action="" method="POST">
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
              <?php 
              while ($row = mysqli_fetch_assoc($categories_result)) {
                echo "<option value=".$row['c_id'].">".$row['c_name']."</option>";
              }
              ?>
            </select> 
            </div>
            <div>
              <input type="image" placeholder="Image" name="image" />
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

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>

</body>

</html>