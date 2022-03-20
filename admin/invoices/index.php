<?php 
include  "..\..\config\databaseconnect.php";

$result = mysqli_query($conn, "SELECT `invoice`.*, `products`.`p_name` FROM `invoice` JOIN `products` ON `invoice`.`p_id` = `products`.`p_id` ");
if (!$result) {
  echo "<script>alert('Invoice could not be fetched')</script>";
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
        Products
      </h2>
    </div>
    <table class="table">
        <tr>
          <th>#</th>
          <th>Order ID</th>
          <th>Product Name</th>
          <th>Product ID</th>
          <th>Quantity</th>
        </tr>
        <?php 
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row['i_id']?></td>
            <td><?php echo $row['o_id']?></td>
            <td><?php echo $row['p_name']?></td>
            <td><?php echo $row['p_id']?></td>
            <td><?php echo $row['i_qty']?></td>
          </tr>
        <?php } ?>
    </table>
    
  </div>
  <script type="text/javascript" src="<?php echo "../../js/bootstrap.bundle.js"?>"></script>
  <script type="text/javascript" src="<?php echo "../../js/custom.js"?>"></script>
</body>
</html>