<?php
session_start();

require_once 'classes/database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

if (isset($_POST) && !empty($_POST) && trim($_POST['email']) != '') {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT staffId FROM staff_tb WHERE staff_email=:email LIMIT 1");
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount()) {
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();

        //generate reset token and expiry = $email + random number
        $token = md5($email) . rand(1111, 9999);
        $expDate = date('Y-m-d H:i:s', strtotime("+30 minutes"));

        //prepare link
        $link = explode('/forgot-password', $_SERVER['HTTP_REFERER'])[0] . '/reset-password?hash=' . $token;

        //replace password with link
        $update_query = "UPDATE staff_tb SET security_key=:hash WHERE staff_email=:email";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bindValue(':hash', $token . ',' . $expDate, PDO::PARAM_STR);
        $update_stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $result = $update_stmt->execute();

        if ($result) {
            //send reset mail to staff
            require("PHPMailer_5.2.0/class.phpmailer.php");
            require("PHPMailer_5.2.0/class.smtp.php");
            require("PHPMailer_5.2.0/class.pop3.php");

            //$mail = new PHPMailer(true);
            $mail = new PHPMailer();

            require_once "home/components/forgot-password-email.php";
            //notify sent
            $_POST = [];
            $_SESSION['success'] = "Reset link sent to your email successfully!<br/><b>Note: </b>Link will expire in 30 minutes.";
        } else {
            $_SESSION['error'] = "Error generating link";
        }
    } else {
        $_SESSION['error'] = "Invalid email address!";
    }
} else {
    $_SESSION['error'] = "Please provide an email address!";
}

header("Location: forgot-password");
