<?php

/**
 * Feature:     Change @nsitf.gov.ng email password
 * Description: Verify email and password from cpanel the update
 * Author:      Ben Onabe
 * Date:        July 6, 2023
 * Location:    PGL
 * Files:       index.php, change-email-password.php, changeEmailPassword.php
 */

session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$new_pass = $_POST['new_password'];
$con_pass = $_POST['confirm_password'];

//validation for all inputs
if (!$email || !$password || !$new_pass || !$con_pass) {
    $_SESSION['error'] = "Error: All fields are required!";
    header("location:change-email-password");
    exit;
}

//password confirm validation
if ($new_pass !== $con_pass) {
    $_SESSION['error'] = "Error: Password confirm mismatch!";
    header("location:change-email-password");
    exit;
}

/* 
    VERIFY PASSWORD
*/
//curl -H'Authorization: cpanel nsitfmai:CBQGD88REZCOO15NI5VB64VEGQLPVOBQ' 'https://nsitf.gov.ng:2083/execute/Email/verify_password?email=developer%40nsitf.gov.ng&password=Qu3s7i0n4#'

$verify_url = "https://nsitf.gov.ng:2083/execute/Email/verify_password?email=" . urlencode($email) . "&password=" . urlencode($password);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $verify_url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: cpanel nsitfmai:CBQGD88REZCOO15NI5VB64VEGQLPVOBQ",
        "Cache-Control: no-cache",
    ),
));

$resp = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    $_SESSION['error'] = $err;
    header('location: change-email-password');
    exit;
} /* else { */

$response = json_decode($resp, true);

if (
    array_key_exists('data', $response)
    && array_key_exists('status', $response)
    && $response['data'] == 1
    && $response['status'] == 1
) { //if current email and password is verified
    /*
        UPDATE PASSWORD
    */
    $update_url = "https://nsitf.gov.ng:2083/execute/Email/passwd_pop?email=" . urlencode($email) . "&password=" . urlencode($new_pass) . "&domain=nsitf.gov.ng";

    $curl2 = curl_init();

    curl_setopt_array($curl2, array(
        CURLOPT_URL => $update_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: cpanel nsitfmai:CBQGD88REZCOO15NI5VB64VEGQLPVOBQ",
            "Cache-Control: no-cache",
        ),
    ));

    $resp1 = curl_exec($curl2);
    $err1 = curl_error($curl2);
    curl_close($curl2);

    if ($err1) {
        $_SESSION['error'] = $err1;
        header('location: change-email-password');
        exit;
    }

    $response1 = json_decode($resp1, true);

    if (
        array_key_exists('data', $response1)
        && array_key_exists('status', $response1)
        && $response1['data'] == null
        && $response1['status'] == 1
    ) { //if password changed
        $_SESSION['success'] = "Success: Password updated successfully!";
    } else { //if password not changed
        if (array_key_exists('errors', $response1) && count($response1['errors']) > 0) { //if custom error
            $_SESSION['error'] = strpos($response1['errors'][0], 'strength rating of') !== false ? "Password must contain: Lowercase letter, Capital letter, Number and at least 8 characters" : $response1['errors'][0];
        } else { //if no custom error
            $_SESSION['error'] = "Error: Password not updated!";
        }
    }
} else { //if current password or email is incorrect
    $_SESSION['error'] = "Error: Invalid email or password!";
}

header("location:change-email-password");
exit;
//}
