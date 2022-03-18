<?php 
include  "..\..\config\databaseconnect.php";

$result = mysqli_query($conn, "SELECT * FROM `users`");
if (!$result) {
  echo "<script>alert('Category could not be fetched')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "../components/headtag.php" ?>
<body>
  <?php include "../components/headeradmin.php" ?> 
  <div class="container">
    <table class="table">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email Address</th>
          <th>Phone Number</th>
          <th>Password</th>
          <th>Actions</th>
        </tr>
        <?php 
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row['u_id']?></td>
            <td><?php echo $row['u_name']?></td>
            <td><?php echo $row['u_email']?></td>
            <td><?php echo $row['u_phone']?></td>
            <td><?php echo $row['u_password']?></td>
            <td>
              <a href="./edit.php?id=<?php echo $row['u_id']?>">Edit</a> | 
              <a href="./delete.php?id=<?php echo $row['u_id']?>">Delete</a> 
            </td>
          </tr>
        <?php } ?>
    </table>
    
  </div>
  <button class="create-button d-flex justify-content-center" >
    <a href="create.php">+</a>
  </button>
  <script type="text/javascript" src="<?php echo "../../js/bootstrap.bundle.js"?>"></script>
  <script type="text/javascript" src="<?php echo "../../js/custom.js"?>"></script>
</body>
</html>