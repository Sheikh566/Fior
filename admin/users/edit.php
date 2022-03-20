<?php 
include "../../config/databaseconnect.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $u_res = mysqli_query($conn, "SELECT * FROM `users` WHERE `u_id` = '$id'");
  $u_res = mysqli_fetch_row($u_res);
  if (isset($_POST["submit"])) {
    $name = $_POST["txtname"];
    $email = $_POST["txtemail"];
    $phone = $_POST["txtphone"];
    $password = $_POST["txtpassword"];

    $query = "UPDATE `users` SET 
    `u_name` = '$name',
    `u_email` = '$email',
    `u_phone` = '$phone',
    `u_password` = '$password'
     WHERE `u_id` = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location:index.php');
    }
    else {
        echo "<script>alert('Oops! User details did not updated')</script>";
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

  <section class="contact_section layout_padding">
    <div class="container ">
      <div class="heading_container justify-content-center">
        <h2 class="">
          Edit User Details
        </h2>
      </div>

    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <form action="" method="POST">
            <div>
              <input type="text" placeholder="Name" name="txtname" value="<?php echo $u_res[1]?>"/>
            </div>
            <div>
              <input type="email" placeholder="Email" name="txtemail" value="<?php echo $u_res[2]?>"/>
            </div>
            <div>
              <input type="tel" placeholder="Phone Number" name="txtphone" value="<?php echo $u_res[3]?>"/>
            </div>
            <div>
              <input type="text" placeholder="Password" name="txtpassword" value="<?php echo $u_res[4]?>"/>
            </div>
            <div class="d-flex mt-4 justify-content-between">
              <a href="index.php" class="btn btn-outline-primary rounded-pill pt-3">Cancel</a>
              <button type="submit" name="submit" class="mx-0">
                  Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript" src="../js/bootstrap.js"></script>
  <script type="text/javascript" src="../js/custom.js"></script>

</body>
</html>