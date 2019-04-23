<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\UwAmp\www\ProjetWeb\composer\vendor\autoload.php';

$mail = new PHPMailer(TRUE);

/* Open the try/catch block. */
try {
   /* Set the mail sender. */
   $mail->setFrom('quiz.imt.lille.douai@gmail.com', 'Darth Vader');

   /* Add a recipient. */
   $mail->addAddress('loupt7@gmail.com', 'Emperor');

   /* Set the subject. */
   $mail->Subject = 'Force';

   /* Set the mail message body. */
   $mail->Body = 'There is a great disturbance in the Force.';



   /* SMTP parameters. */
   
   /* Tells PHPMailer to use SMTP. */
   $mail->isSMTP();
   
   /* SMTP server address. */
   $mail->Host = 'smtp.gmail.com';

   /* Use SMTP authentication. */
   $mail->SMTPAuth = TRUE;
   
   /* Set the encryption system. */
   $mail->SMTPSecure = 'tls';
   
   /* SMTP authentication username. */
   $mail->Username = 'quiz.imt.lille.douai@gmail.com';
   
   /* SMTP authentication password. */
   $mail->Password = 'imtLilleDouai';
   
   /* Set the SMTP port. */
   $mail->Port = 587;
   
   /* Disable some SSL checks. */
   $mail->SMTPOptions = array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
   );
   
   /* Finally send the mail. */
   $mail->send();
}
catch (Exception $e)
{
   /* PHPMailer exception. */
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   /* PHP exception (note the backslash to select the global namespace Exception class). */
   echo $e->getMessage();
}
?>