<?php 
  include "config/databaseconnect.php";
  $u_id = $_SESSION['user']['u_id'];
  $order_result = mysqli_query($conn, 
    "SELECT * FROM orders 
    join users on orders.u_id = users.u_id 
    where users.u_id = '$u_id'"
  );
  if (!$order_result) echo "<scrip>alert('".mysqli_error($conn)."')</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include "components/headtag.php"?>
  <link rel="stylesheet" href="css/orders.css" >
</head>
<body>
    <?php include "components/header.php" ?>

    <div class="row d-flex justify-content-center mt-100 mb-100">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="card-title m-b-0 title-text-gradient">Orders</h1>
                </div>
                <ul class="list-style-none">
                  <?php 
                  while ($row = mysqli_fetch_assoc($order_result)) {
                  ?>
                    <li class="d-flex no-block card-body border-top"> 
                        <div> 
                            <h4>Order # <?php echo $row['o_id'] ?></h4>

                            <?php $invoice_result = mysqli_query($conn, "SELECT * FROM invoice where o_id = '".$row['o_id']."'");
                            if (!$invoice_result) echo "<scrip>alert('".mysqli_error($conn)."')</script>"; ?>

                            <span class="text-muted">AAA has invested $2M in MMM. we are happy to
                            working forward with AAA.</span> 
                          </div>
                        <div class="ml-auto">
                            <div class="tetx-right">
                                <h5 class="text-muted m-b-0">11</h5> <span class="text-muted font-16">MAR</span>
                            </div>
                        </div>
                    </li>
                  <?php } ?>
                </ul>
            </div>
        </div>
    </div>

  <!-- <div class=".modal">
        <div class="title">Purchase Reciept</div>
        <div class="info">
            <div class="row">
                <div class="col-7"> <span id="heading">Date</span><br> <span id="details">10 October 2018</span> </div>
                <div class="col-5 pull-right"> <span id="heading">Order No.</span><br> <span
                        id="details">012j1gvs356c</span> </div>
            </div>
        </div>
        <div class="pricing">
            <div class="row">
                <div class="col-9"> <span id="name">BEATS Solo 3 Wireless Headphones</span> </div>
                <div class="col-3"> <span id="price">£299.99</span> </div>
            </div>
            <div class="row">
                <div class="col-9"> <span id="name">Shipping</span> </div>
                <div class="col-3"> <span id="price">£33.00</span> </div>
            </div>
        </div>
        <div class="total">
            <div class="row">
                <div class="col-9"></div>
                <div class="col-3"><big>£262.99</big></div>
            </div>
        </div>
        <div class="tracking">
            <div class="title">Tracking Order</div>
        </div>
        <div class="progress-track">
            <ul id="progressbar">
                <li class="step0 active " id="step1">Ordered</li>
                <li class="step0 active text-center" id="step2">Shipped</li>
                <li class="step0 active text-right" id="step3">On the way</li>
                <li class="step0 text-right" id="step4">Delivered</li>
            </ul>
        </div>
        <div class="footer">
            <div class="row">
                <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/YBWc55P.png"></div>
                <div class="col-10">Want any help? Please &nbsp;<a> contact us</a></div>
            </div>
        </div>
    </div> -->

  <!-- <============ FOOTER  ============> -->
  <?php include "components/footer.php" ?>
  <!-- <============ SCRIPTS ============> -->
  
  <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
</body>