<?php 
include  "..\..\config\databaseconnect.php";

$result = mysqli_query($conn, "SELECT `orders`.*, `users`.`u_name` FROM `orders` JOIN `users` ON `orders`.`u_id` = `users`.`u_id` ");
if (!$result) {
  echo "<script>alert('Category could not be fetched')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "../components/headtag.php" ?>
<body>
  <?php include "../components/headeradmin.php" ?> 
  <div class="container my-4">
    <div class="heading_container justify-content-center">
      <h2 class="my-5 ">
        Orders
      </h2>
    </div>
    <table class="table">
        <tr>
          <th>#</th>
          <th>Time</th>
          <th>User ID</th>
          <th>User Name</th>
          <th>Total</th>
        </tr>
        <?php 
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row['o_id']?></td>
            <td><?php echo $row['o_date']?></td>
            <td><?php echo $row['u_id']?></td>
            <td><?php echo $row['u_name']?></td>
            <td>Rs. <?php echo $row['o_total']?></td>
          </tr>
        <?php } ?>
    </table>
    
  </div>
  <script type="text/javascript" src="<?php echo "../../js/bootstrap.bundle.js"?>"></script>
  <script type="text/javascript" src="<?php echo "../../js/custom.js"?>"></script>
</body>
</html>