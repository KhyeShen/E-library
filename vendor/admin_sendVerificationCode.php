<?php
  session_start();
  require  __DIR__.'/phpmailer/includes/PHPMailer.php';
  require  __DIR__.'/phpmailer/includes/SMTP.php';
  require  __DIR__.'/phpmailer/includes/Exception.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use PHPMailer\PHPMailer\SMTP;

  $_SESSION['send'] = "";
  $email = "";
  
  //send email

  function sendEmail($recieveEmail){
    $otp = rand(100000,999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $recieveEmail;
    $mail = new PHPMailer();
    $mail -> SMTPDebug=3;
    $mail->IsSMTP();

    //$mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "scpgelibrary@gmail.com"; //sender mail(gmail)
    $mail->Password   = "aybbhanxxdgndsal"; //sender gmail password

    $mail->IsHTML(true);
    $mail->AddAddress($recieveEmail); //receive user email , user name
    $mail->SetFrom("scpgelibrary@gmail.com","SEGi College Penang E-library"); // set sender email
    $mail->Subject = "Verify Your Account With OTP Code";
    $mail->Body = "<p>Dear user, </p> <h3>Your OTP code is $otp</h3>
    <br>
    <p>With regards,</p>
    <b>SEGi Penang E-library Team</b>";
    
    if($mail->Send()) {
      $_SESSION['send'] = "yes";
      header('location:../administrator/verification.php');
      
      //var_dump($mail);
    } else {
      echo '<script>alert("Fail to send email!")</script>';
    }
    $mail->smtpClose();
  }

  
  if(isset($_POST['resend'])) 
  {
    $_SESSION['otp'] = rand(100000,999999);
    $email = $_POST['resend'];
    $mail = new PHPMailer();
    $mail->IsSMTP();
    
    //$mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "scpgelibrary@gmail.com"; //sender mail(gmail)
    $mail->Password   = "aybbhanxxdgndsal"; //sender gmail password

    $mail->IsHTML(true);
    $mail->AddAddress($email); //receive user email , user name
    $mail->SetFrom("scpgelibrary@gmail.com","SEGi College Penang E-library"); // set sender email
    $mail->Subject = "Verify Your Account With OTP Code";
    $mail->Body = "<p>Dear admin, </p> <h3>Your OTP code is ".$_SESSION['otp']."</h3>
    <br>
    <p>With regards,</p>
    <b>SEGi Penang E-library Team</b>";
    
    if($mail->Send()) {
      $_SESSION['send'] = "yes";
      echo '<script type="text/javascript">'; 
			echo 'alert("Please enter the OTP code received by '.$_SESSION['email'].' to verify your account.");'; 
			echo 'window.location.href = "../administrator/verification.php";';
			echo '</script>';
    } else {
      echo '<script type="text/javascript">'; 
			echo 'alert("Fail to send email!");'; 
			echo 'history.back();';
			echo '</script>';
    }
    $mail->smtpClose();
  }
?>
