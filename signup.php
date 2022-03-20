
<?php 
include "config/databaseconnect.php";

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

<!DOCTYPE html>
<html>
<head>
  <?php include "components/headtag.php" ?>
</head>
<body class="sub_page">
  <div class="hero_area">
    <?php include "components/header.php"  ?>
  </div>

  <section class="contact_section layout_padding">
    <div class="container ">
      <div class="heading_container justify-content-center">
        <h2 class="">
          Sign Up
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
              <input type="email" placeholder="Email" name="txtemail"/>
            </div>
            <div>
              <input type="tel" placeholder="Phone Number" name="txtphone" />
            </div>
            <div>
              <input type="password" placeholder="Password" name="txtpassword" />
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

  <?php include "components/footer.php" ?>

  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>