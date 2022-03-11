  <?php 
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
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
           <ul class="navbar-nav  ">
             <li class="nav-item active">
               <a class="nav-link" href="index.php">Home</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="shop.php">Shop</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="about.php">About</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="contact.php">Contact us</a>
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
              echo "<a href='config/logout.php'>&nbspLog out</a>";
            }
           ?>
           <a href="cart.php">
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
