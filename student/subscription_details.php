<?php
  session_start();

  //Check login status
  require('../controller/login_status.php');
  //DB connection
  require('../controller/conn.php');

  //get subscription details
  $status = "";
  $result = mysqli_query($conn,"SELECT * from `subscription` WHERE student_ID = '".$_SESSION['studentID']."' AND status != 'expired'");
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result); 
    $status = $row['status'];
    $plan_end = $row['plan_end'];
    } else {
      $status = "none";
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SCPG E-library</title>
    <!-- Tab icon -->
    <link href="../src/image/segi_logo.png" rel="icon">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- MDB -->
    <link rel="stylesheet" href="../src/css/mdb.min.css"/>
    <!-- Subscription Box -->
    <link rel="stylesheet" href="../src/css/subscription.css"/>
  </head>
<body>
  <!-- Nav -->
  <?php require 'nav.php' ?>

  <!-- Unsubscribe -->
  <?php
    if($status == "expired" || $status == "none" || $status == "")
    {
  ?>
  <div class="row" id="unsubscribe">
      <div class="col-md-4 col-sm-6 mx-auto" margin="auto auto";>
          <div class="pricing-table-3 basic mx-auto">
              <div class="pricing-table-header">
                  <h4><strong>PREMIUM</strong></h4>
              </div>
              <div class="price"><strong>RM10</strong> / Month</div>
              <div class="pricing-body">
                  <ul class="pricing-table-ul">
                      <li><p>Get Access to </p><b>High Quality Material</b></li>
                      <li><i class="fas fa-check"></i> &nbsp;Journal</li>
                      <li><i class="fas fa-check"></i> &nbsp;Exam Paper</li>
                      <!-- <li><i class="fas fa-eye"></i> &nbsp;Exam Paper</li> -->
                  </ul><a href="card_details.php" class="view-more">Subscribe</a>
              </div>
          </div>
      </div>
  </div>
  <?php
    }
  ?>

  <!-- Subscribed -->
  <?php
    if($status == "active")
    {
  ?>
  <div class="row" id="subscribe">
      <div class="col-md-4 col-sm-6 mx-auto" margin="auto auto";>
          <div class="pricing-table-3 basic mx-auto">
              <div class="pricing-table-header">
                  <h4><strong>PREMIUM</strong></h4>
              </div>
              <div class="price"><strong>RM10</strong> / Month</div>
              <div class="pricing-body">
                  <ul class="pricing-table-ul">
                      <li><p>Get Access to </p><b>High Quality Material</b></li>
                      <li><i class="fas fa-check"></i> &nbsp;Journal</li>
                      <li><i class="fas fa-check"></i> &nbsp;Exam Paper</li>
                      <!-- <li><i class="fas fa-eye"></i> &nbsp;Exam Paper</li> -->
                  </ul><a onclick="cancel()" href="../controller/cancel_subscription.php" class="view-more">Cancel Subscription</a>
                  <p style="margin: 0; text-align:center;">Subscription Renew By <br/><?php echo $plan_end; ?></p>
              </div>
          </div>
      </div>
  </div>
  <?php
    }
  ?>

  <!-- Cancel Subscription at Plan End -->
  <?php
    if($status == "last")
    {
  ?>
  <div class="row" id="subscribe">
      <div class="col-md-4 col-sm-6 mx-auto" margin="auto auto";>
          <div class="pricing-table-3 basic mx-auto">
              <div class="pricing-table-header">
                  <h4><strong>PREMIUM</strong></h4>
              </div>
              <div class="price"><strong>RM10</strong> / Month</div>
              <div class="pricing-body">
                  <ul class="pricing-table-ul">
                      <li><p>Get Access to </p><b>High Quality Material</b></li>
                      <li><i class="fas fa-check"></i> &nbsp;Journal</li>
                      <li><i class="fas fa-check"></i> &nbsp;Exam Paper</li>
                      <!-- <li><i class="fas fa-eye"></i> &nbsp;Exam Paper</li> -->
                  </ul><a href="../controller/undo_cancellation.php" class="view-more">Resume Subscription</a>
                  <p style="margin: 0; text-align:center;">Subscription End By <br> <?php echo $plan_end; ?></p>
              </div>
          </div>
      </div>
  </div>
  <?php
    }
  ?>

  <!-- Footer -->
  <?php include 'footer.php' ?>

  <script>
  //prompt confirmation box
  function cancel(){
    var cancel = confirm('Are you sure you want to cancel the Premium subscription?');
    if(cancel == false){
      event.preventDefault();
    }
  }
  </script>
  </body>
</html>
