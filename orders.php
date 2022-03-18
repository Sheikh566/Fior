<?php 
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  include "config/databaseconnect.php";
  if (isset($_SESSION['user'])) {
    $u_id = $_SESSION['user']['u_id'];
    $order_result = mysqli_query($conn, 
    "SELECT * FROM orders 
    join users on orders.u_id = users.u_id 
    where users.u_id = '$u_id'"
  );
  if (!$order_result) echo "<scrip>alert('".mysqli_error($conn)."')</script>";
  } else {
      header('location:index.php');
  }
  

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
        <div class="text-center col-lg-6">
            <h1 class="card-title m-b-0 title-text-gradient">Order History</h1>
            <ul class="list-style-none">
                <?php 
                if (isset($order_result)) {
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
                            <h6 class="mb-0 text-muted"><?php echo humanTiming(strtotime($row['o_date'])) ?> ago</h6>
                            <div class="ml-auto">
                                <button class="float-end text-main details mt-2" type="button"  data-bs-toggle="modal" data-bs-target="<?php echo "#modal".$i?>">
                                    <h6 class="m-0 ">Details</h6>
                                </button>
                            </div>
                        </div>
                    </li>
                    <!-- Modal -->
                    <div class="modal fade" id="<?php echo "modal".$i?>" tabindex="-1" aria-labelledby="<?php echo "#modal".$i?>" aria-hidden="true">
                    <div class="modal-dialog my-modal">
                        <div class="modal-content border-0 rounded-0">
                        <div class="modal-header">
                            <h5 class="modal-title text-main" id="<?php echo "modal".$i?>">Invoice</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="info">
                                <div class="row">
                                    <div class="col-7"> <span id="heading">Date</span><br> <span id="details"><?php echo $row['o_date'] ?></span> </div>
                                    <div class="col-5 pull-right"> <span id="heading">Order No.</span><br> <span
                                            id="details"><?php echo $row['o_id']?> </span> </div>
                                </div>
                            </div>
                            
                            <div class="pricing">
                                <?php 
                                    $invoice_result = mysqli_query($conn, 
                                    "SELECT `invoice`.`i_id`, `products`.`p_name`, `products`.`p_price`, `invoice`.`i_qty`
                                    FROM `products` 
                                    JOIN `invoice` on `products`.`p_id` = `invoice`.`p_id`
                                    WHERE `invoice`.o_id = ".$row['o_id']
                                    );
                                    if (!$invoice_result) echo "<scrip>alert('".mysqli_error($conn)."')</script>"; 
                                    else {
                                        while ($row1 = mysqli_fetch_assoc($invoice_result)) {
                                        echo "<script>console.log('".json_encode($row1)."')</script>" 
                                ?>
                                    <div class="row">
                                        <div class="col-6 text-start"> 
                                            <span id="product-name"><?php echo $row1['p_name'] ?></span> 
                                        </div>
                                        <div class="col-3"> 
                                            <span id="qty">QTY: <?php echo $row1['i_qty'] ?></span> 
                                        </div>
                                        <div class="col-3"> 
                                            <span id="price" >Rs. <?php echo $row1['p_price'] ?></span>
                                        </div>
                                    </div>
                                <?php  
                                        }
                                    }
                                ?>
                                
                                <div class="row">
                                    <div class="col-6 text-start"> <span id="name" class="text-main">Shipping</span> </div>
                                    <div class="col-3"> <span id="gap"></span> </div>
                                    <div class="col-3"> <span id="price" class="text-main">Rs. 100 </span> </div>
                                </div>
                            </div>
                        <div class="total">
                            <div class="row">
                                <div class="col-9 text-start">Total</div>
                                <div class="col-3"><big>Rs. <?php echo $row['o_total'] ?></big></div>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Download</button>
                        </div>
                        </div>
                    </div>
                    </div>
                <?php 
                    }
                } 
                ?>
            </ul>
        </div>
    </div>
    <!-- Button trigger modal -->



  <!-- <============ FOOTER  ============> -->
  <?php include "components/footer.php" ?>
  <!-- <============ SCRIPTS ============> -->
  
  <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
</body>