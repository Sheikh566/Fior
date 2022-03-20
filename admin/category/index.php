<?php 
include  "..\..\config\databaseconnect.php";

$result = mysqli_query($conn, "SELECT `c_id`, `c_name` FROM `category`");
if (!$result) {
  echo "<script>alert('Category could not be fetched')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "../components/headtag.php" ?>
</head>
<body>
  <?php include "../components/headeradmin.php" ?> 
  <div class="container">
    <div class="heading_container justify-content-center">
      <h2 class="my-5 ">
        Categories
      </h2>
    </div>
    <table class="table">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Actions</th>
        </tr>
        <?php 
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row['c_id']?></td>
            <td><?php echo $row['c_name']?></td>
            <td>
              <a href="./edit.php?id=<?php echo $row['c_id']?>">Edit</a> | 
              <a href="./delete.php?id=<?php echo $row['c_id']?>">Delete</a> 
            </td>
          </tr>
        <?php } ?>
    </table>
    
  </div>
  <button class="create-button">
    <a href="create.php">+</a>
  </button>
  <script type="text/javascript" src="<?php echo "../../js/bootstrap.bundle.js"?>"></script>
  <script type="text/javascript" src="<?php echo "../../js/custom.js"?>"></script>
</body>
</html>