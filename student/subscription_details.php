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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="../src/css/mdb.min.css"/>
  </head>
  <style>
    @charset "utf-8";
    /* CSS Document */
    @import url(http://fonts.googleapis.com/css?family=Open+Sans:300italic,500,400,300,800);
    @import url(http://fonts.googleapis.com/css?family=Ubuntu:300,400,700);
    @import url(http://fonts.googleapis.com/css?family=Roboto:100,300,400);

    body{ 
        background-color:#f0f3f6;
      overflow-x: hidden;

    }
    h1,h2,h3,h4,h5,h6,div,input,p,a{
        font-family: "Open Sans";  
        margin:0px; 
    }

    h3{ 
        font-size:22px;
    }
    label{
      font-weight:500;
    }
    .form-group{
      margin-bottom:5px;
    }


    input,textarea,select,button{ 
        margin: 5px 0px ;
        font-size:13px !important; 
        border-radius:0px;
    }
    input[type=text],input[type=password],textarea,input[type=email],select,textarea{ 
        width: 100%; 
        border:1px solid #DADADA; 
        padding: 5px 10px;  
        height:45px;  
    }
    input[type=submit],input[type=button],input[type=reset],button{
        border:none; 
        font-size: 11px;  
      border-radius:3px;
      height:45px;
      color:#FFF;
    }

    .btn:hover,.btn:focus{  
        cursor:pointer; 
        color:#FFF;
    }
    input[type=radio]{
        margin:0px;
        padding:0px; 
        height:auto;
    }
    .form-control{ 
        box-shadow:none !important;  
      border-radius:0px;
    }
    .form-control:focus{
        border:1px solid #CCC;
    }
    .btn:focus{
      box-shadow:none !important;
    }

    textarea{ 
        width: 100%;
    }
    input[type=reset]{ 
        margin-left: 10px;
    }
    textarea{
      min-height:100px;
    }
    a{ 
        color: inherit;
    }
    a:hover,a:focus{ 
        text-decoration: none !important; 
        color: inherit !important;
    }
    ul{
        margin: 0px; 
        padding: 0px; 
        list-style: none;
    }
    .relative{ 
        position: relative;
    }
    .absolute{ 
        position: absolute;
    }
    .fixed{ 
        position: fixed;
    }

    .pricing-table-container{
      padding:50px 0px;
    }
    .description{
      padding:15px 0px;
    }
    .description a{
      padding:10px;
      font-size:13px;
      display:block;
      font-weight:bold;
      border-bottom:1px solid #DDD;
    }
    .description a.active{
      background-color:#FFF;
      padding-left:25px;
    }
    @charset "utf-8";
    /* DEMO 01 */
    .pricing-table-3{
      background-color:#FFF;
      margin:15px auto;
      box-shadow:0px 0px 25px rgba(0,0,0,0.1);
      max-width:300px;
      border-radius:0px 10px 0px 10px;
      overflow:hidden;
      position:relative;
      min-height:250px;
      transition:all ease-in-out 0.25s;
    }
    .pricing-table-3:hover{
      transform:scale(1.1,1.1);
      cursor:pointer;
    }

    .pricing-table-3.basic .price{
      background-color:#28b6f6;
      color:#FFF;
    }
    .pricing-table-3.premium .price{
      background-color:#ff9f00;
      color:#FFF;
    }
    .pricing-table-3.business .price{
      background-color:#c3185c;
      color:#FFF;
    }

    .pricing-table-3 .pricing-table-header{
      background-color:#212121;
      color:#FFF;
      padding:20px 0px 0px 20px;
      position:absolute;
      z-index:5;
    }
    .pricing-table-3 .pricing-table-header p{
      font-size:12px;
      opacity:0.7;
    }
    .pricing-table-3 .pricing-table-header::before{
      content:"";
      position:absolute;
      left:-50px;
      right:-180px;
      height:125px;
      top:-50px;
      background-color:#212121;
      z-index:-1;
      transform:rotate(-20deg)
    }

    .pricing-table-3 .price{
      position:absolute;
      top:0px;
      text-align:right;
      padding:110px 20px 0px 0px;
      right:0px;
      left:0px;
      font-size:20px;
      z-index:4;
    }
    .pricing-table-3 .price::before{
      content:"";
      position:absolute;
      left:0px;
      right:0px;
      height:100px;
      bottom:-25px;
      background-color:inherit;
      transform:skewY(10deg);
      z-index:-1;
      box-shadow:0px 5px 0px 5px rgba(0,0,0,0.05);
    }


    .pricing-table-3 .pricing-body{
      padding:20px;
      padding-top:200px;  
    }
    .pricing-table-ul{
      margin-left:20px;
      padding:0 10px 10px 0px !important;
    }
    .pricing-table-3 .pricing-table-ul li{
      color:rgba(0,0,0,0.7);
      font-size:13px;
      padding:10px 10px 10px 0px !important;
      border-bottom:1px solid rgba(0,0,0,0.1);
    }
    .pricing-table-3 .pricing-table-ul .fa{
      margin-right:10px;
    }
    .pricing-table-3.basic .pricing-table-ul .fa{
      color:#28b6f6;
    }
    .pricing-table-3.premium .pricing-table-ul .fa{
      color:#ff9f00;
    }
    .pricing-table-3.business .pricing-table-ul .fa{
      color:#c3185c;
    }
    .pricing-table-3 .view-more{
      margin:10px 20px;
      display:block;
      text-align:center;
      background-color:#212121;
      padding:10px 0px;
      color:#FFF;
    }
  </style>
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
