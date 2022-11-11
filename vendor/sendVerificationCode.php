<?php
  session_start();
  require  __DIR__.'/phpmailer/includes/PHPMailer.php';
  require  __DIR__.'/phpmailer/includes/SMTP.php';
  require  __DIR__.'/phpmailer/includes/Exception.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use PHPMailer\PHPMailer\SMTP;

  $email = "";
  
  //sendMail();

  function sendMail($reciveEmail){
    $otp = rand(100000,999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $reciveEmail;
    $mail = new PHPMailer();
    $mail -> SMTPDebug=3;
    $mail->IsSMTP();

    //$mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "scpgelibraryuser@gmail.com"; //sender mail(gmail)
    $mail->Password   = "sqlrhqmnghdqtyfm"; //sender gmail password

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

        
        header('location:../student/verification.php?email='.$reciveEmail);
      
      //var_dump($mail);
    } else {
      echo '<script>alert("Fail to send email!")</script>';
    }
    $mail->smtpClose();
  }

  if(isset($_POST['verify']))
	{
		$otp = $_POST['otp'];
		
        if($_SESSION['otp'] == $otp)
        {
            $verify = mysqli_query($conn,"update `student_acc` set verified='1'");
            if($verify)
            {
                if($_SESSION['task'] == 'resetpwd'){
					header('location:resetpwd.php');
				}
				else{
					header('location:index.php');
				}
                
            }
        }
        else
        {
            echo '<script>alert("Invalid OTP Code")</script>'; 
        }
	}
  
  if(isset($_POST['resend'])) 
  {
    $_SESSION['otp'] = rand(100000,999999);
    $email = $_POST['resend'];
    $mail = new PHPMailer();
    $mail -> SMTPDebug=3;
    $mail->IsSMTP();
    echo '<script>alert("Please enter the OTP code received by '.$email.' to verify your account.")</script>';
    //$mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "scpgelibraryuser@gmail.com"; //sender mail(gmail)
    $mail->Password   = "sqlrhqmnghdqtyfm"; //sender gmail password

    $mail->IsHTML(true);
    $mail->AddAddress($email); //receive user email , user name
    $mail->SetFrom("scpgelibrary@gmail.com","SEGi College Penang E-library"); // set sender email
    $mail->Subject = "Verify Your Account With OTP Code";
    $mail->Body = "<p>Dear user, </p> <h3>Your OTP code is ".$_SESSION['otp']."</h3>
    <br>
    <p>With regards,</p>
    <b>SEGi Penang E-library Team</b>";
    
    
    // $content = $mailMessage;

    // $mail->MsgHTML($content); 
    if($mail->Send()) {
      echo '<script>alert("Please enter the OTP code received by '.$email.' to verify your account.")</script>';

        
        header('location:../student/verification.php');
      
      //var_dump($mail);
    } else {
      echo '<script>alert("Fail to send email!")</script>';
    }
    $mail->smtpClose();
  }
?>
