<?php 
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }
?>
<header class="header_section">
  <div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="index.php">
        <span>
          Fior
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
          <ul class="navbar-nav" >
            <li class="nav-item" id='nav-link-0' >
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item" id='nav-link-1'>
              <a class="nav-link"  href="shop.php">Shop</a>
            </li>
            <li class="nav-item" id='nav-link-2' >
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item" id='nav-link-3' >
              <a class="nav-link" href="contact.php">Contact us</a>
            </li>
          </ul>
        </div>
        <div class="quote_btn-container ">
          <?php  
          if(!isset($_SESSION['user'])) {
            echo "<a href='login.php'>Log in</a>";
          } 
          else {
            echo "<a href='orders.php' >".$_SESSION['user']['u_name']."</a> &nbsp; &nbsp;| ";
            echo "<a href='config/logout.php'>&nbspLog out</a>";
          }
          ?>
          <a href="cart.php">
            <img src="images/cart.png" alt="">
            <sub><?php echo count(array_unique($_SESSION['cart'])) ?></sub>
          </a>
          <form class="form-inline">
            <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
          </form>
        </div>
      </div>
    </nav>
  </div>
</header>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script>
  $(document).ready(function() {
    // Nav link 'active' class add/remove
    let id = localStorage.getItem('nav-link') === null ? 'nav-link-0' : localStorage.getItem('nav-link');
    $('#'+id).addClass('active');
    $('li.nav-item').click(function() {
      id = $(this).attr('id');
      localStorage.setItem('nav-link', id);
      $('ul li').removeClass('active');
      $('#'+id).addClass('active');
    })
  })
</script>