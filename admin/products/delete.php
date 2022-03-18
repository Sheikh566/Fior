<?php 
    include "../../config/databaseconnect.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if ($conn) {
            $query = "DELETE FROM `products` WHERE `p_id`='$id'";
            echo mysqli_query($conn, $query) ? 
            header('location:index.php') : "<script>alert('Product didnt Deleted')</script>";
        }else {
            echo "<script>alert('Connection Failed')</script>";
        }
    }
?>