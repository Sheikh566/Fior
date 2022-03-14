<?php 
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  $id = (int)$_GET['itemId'];
  switch ($_GET['change']) {
    case 'inc':
      $_SESSION['cart'][] = $id;
      break;
    case 'dec':
      array_splice($_SESSION['cart'], array_search($id, $_SESSION['cart']), 1);
      break;
    case 'del':
      $_SESSION['cart'] = array_values(array_diff($_SESSION['cart'], [$id]));
      break;
    default:
      echo "<script>alert('Invalid `change` parameter)</script>";
  }
  header('location:../cart.php');
?>