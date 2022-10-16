<?php
  require  __DIR__.'/phpmailer/includes/PHPMailer.php';
  require  __DIR__.'/phpmailer/includes/SMTP.php';
  require  __DIR__.'/phpmailer/includes/Exception.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use PHPMailer\PHPMailer\SMTP;

  //sendMail();

  function sendMail($reciveEmail){
    $otp = rand(100000,999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['mail'] = $email;
    $mail = new PHPMailer();
    $mail->IsSMTP();

    //$mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "scpgelibrary@gmail.com"; //sender mail(gmail)
    $mail->Password   = "Elibrary$123"; //sender gmail password

    $mail->IsHTML(true);
    $mail->AddAddress($reciveEmail); //receive user email , user name
    $mail->SetFrom("scpgelibrary@gmail.com","SEGi College Penang E-library"); // set sender email
    $mail->Subject = "Verify Your Account With OTP Code";
    $mail->Body = "<p>Dear user, </p> <h3>Your OTP code is $otp</h3>
    <br>
    <p>With regards,</p>
    <b>SEGi Penang E-library Team</b>";
    
    
    // $content = $mailMessage;

    // $mail->MsgHTML($content); 
    if($mail->Send()) {
      echo '<script>alert("Please enter the OTP code received by '.$reciveEmail.' to verify your account.")</script>';

        
        header('location:verification.php');
      
      //var_dump($mail);
    } else {
      echo '<script>alert("Successfully Sign Up")</script>';
    }
    $mail->smtpClose();
  }
?>
