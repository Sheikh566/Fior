<?php 
if (session_status() === PHP_SESSION_NONE) {
  session_start();
} 
if (!isset($_SESSION['user'])) {
  header('location:../login.php?lastPage='.$_SERVER['REQUEST_URI']);
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Fior</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Poppins:400,600,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="../css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../css/responsive.css" rel="stylesheet" />
</head>
<body>
<header class="header_section">
   <div class="container">
     <nav class="navbar navbar-expand-lg custom_nav-container ">
       <a class="navbar-brand" href="index.php">
         <span>
           Fior <span class="title-text-gradient"> &lt; admin/ &gt; </span>
         </span>
       </a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
           <ul class="navbar-nav">
             <li class="nav-item active" id='nav-link-0'>
               <a class="nav-link" href="index.php">Dashboard</a>
             </li>
             <li class="nav-item"  id='nav-link-1'>
               <a class="nav-link" href="./products/">Products</a>
             </li>
             <li class="nav-item" id='nav-link-2'>
               <a class="nav-link"  href="./category/">Category</a>
             </li>
             <li class="nav-item" id='nav-link-3'>
               <a class="nav-link" href="./users/">Users</a>
             </li>
             <li class="nav-item" id='nav-link-4' >
            <a class="nav-link" href="./orders/">Orders</a>
           </li>
            <li class="nav-item" id='nav-link-5' >
              <a class="nav-link" href="./invoices/">Invoices</a>
            </li>
           </ul>
         </div>
         <div class="quote_btn-container ">
           <?php 
            if(count($_SESSION) == 0) {
              echo "<a href='login.php'>Log in</a>";
            } 
            else {
              echo $_SESSION['user']['u_name']." | ";
              echo "<a href='config/logout.php'>Log out</a>";
            }
           ?>
           <a href="">
             <img src="images/cart.png" alt="">
           </a>
           <form class="form-inline">
             <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
           </form>
         </div>
       </div>
     </nav>
   </div>
 </header>

  <div class="container d-flex justify-content-center" style="height: 90vh; align-items:center; ">
    <div class="heading_container">
      <h1 class="text-main">
        Dashboard Under Construction
      </h1>
  </div>

  <script type="text/javascript" src="<?php echo "../js/bootstrap.bundle.js"?>"></script>
  <script type="text/javascript" src="<?php echo "../js/custom.js"?>"></script>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script>
  $(document).ready(function() {
    // Nav link 'active' class add/remove
    let id = localStorage.getItem('nav-link') === null ? 'nav-link-0' : localStorage.getItem('nav-link');
    $('#'+id).addClass('active');
    $('.nav-item').click(function() {
      id = $(this).attr('id');
      localStorage.setItem('nav-link', id);
      $('ul li').removeClass('active');
      $('#'+id).addClass('active');
    })
  })
</script>
</body>
</html>