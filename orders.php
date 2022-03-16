<?php 
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  include "config/databaseconnect.php";
  $u_id = $_SESSION['user']['u_id'];
  $order_result = mysqli_query($conn, 
    "SELECT * FROM orders 
    join users on orders.u_id = users.u_id 
    where users.u_id = '$u_id'"
  );
  if (!$order_result) echo "<scrip>alert('".mysqli_error($conn)."')</script>";

  // Calculate Time Elasped
  function humanTiming ($time)
    {
        $time = time() - $time; // to get the time since that moment 
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }
    }
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
                    <h1 class="card-title m-b-0 title-text-gradient">Order History</h1>
                </div>
                <ul class="list-style-none">
                  <?php 
                  $i = 0;
                  while ($row = mysqli_fetch_assoc($order_result)) {
                  ?>
                    <li class="d-flex card-body border-top justify-content-between"> 
                        
                        <div class="ml-10">
                            <div class="mr-auto d-inline">
                                <span class="order-serial-no text-muted">#<?php echo ++$i ?></span> 
                            </div>
                            <h5 class="text-center d-inline">Order ID: <?php echo $row['o_id'] ?></h5>
                            <?php $invoice_result = mysqli_query($conn, "SELECT * FROM invoice where o_id = '".$row['o_id']."'");
                            if (!$invoice_result) echo "<scrip>alert('".mysqli_error($conn)."')</script>"; ?>
                        </div>

                        <div class="ml-auto">
                            <h6 class="mb-0 text-muted"><?php echo humanTiming(strtotime($row['o_date'])) ?>s ago</h6>
                            <div class="ml-auto">
                                <button class="float-end btn btn-primary" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <h6 class="m-0 ">Details</h6>
                                </button>
                            </div>
                        </div>
                    </li>
                  <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog my-modal">
        <div class="modal-content border-0 rounded-0">
        <div class="modal-header">
            <h5 class="modal-title text-main" id="exampleModalLabel">Invoice</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
        </div>
        <div class="modal-footer">
            <div class="my-footer">
                <div class="row">
                    <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/YBWc55P.png"></div>
                    <div class="col-10">Want any help? Please &nbsp;<a> contact us</a></div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Download</button>
        </div>
        </div>
    </div>
</div>
  <div class="my-modal">
        <div class="title">Purchase Reciept</div>
        
        
        
    </div>

  <!-- <============ FOOTER  ============> -->
  <?php include "components/footer.php" ?>
  <!-- <============ SCRIPTS ============> -->
  
  <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
</body>