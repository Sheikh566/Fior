<?php 
    $conn = mysqli_connect("localhost", "root", "", "fior");
    if (!$conn) {
        echo "<script>alert('Connection Failed')</script>";
    }
?>