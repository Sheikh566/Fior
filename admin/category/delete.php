<?php 
    include "../../config/databaseconnect.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM `category` WHERE `c_id`='$id'";
        echo mysqli_query($conn, $query) ? 
        header('location:index.php') : "<script>alert('Product didnt Deleted')</script>";
    }
?>