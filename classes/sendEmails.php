<?php
require_once '../vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('navsa.ng'))
    ->setUsername("info@navsa.ng")
    ->setPassword("2338@navsa");

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);


//resetPass
function  sendPassR($userEmail, $token)
{
    global $mailer;
    $body = '<!DOCTYPE html>
    <html lang="en">

    <head>
      
      <title>Password recovery</title>
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
        a {
          background:green;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #fff;
        }
      </style>
    </head>

    <body>
      <div class="wrapper">
        <p>Welcome to NAVSA password reset. Please click on the link below to reset your password:.</p>
        <a href="localhost/navsa/(navsa)/n(home)/resetPass.php?token=' . $token . '">Reset Password!</a>
      </div>
    </body>

    </html>';

    // Create a message
    $message = (new Swift_Message('Reset Password'))
        ->setFrom("admin@nwicte.ng")
        ->setTo($userEmail)
        ->setBody($body, 'text/html');

    // Send the message
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}
