<?php 
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  session_destroy();
  if (isset($_GET['lastPage'])) {
    header('location:'.$_GET['lastPage']);
  }
?>