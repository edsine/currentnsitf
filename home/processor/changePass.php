<?php
session_start();

require_once 'classes/manage.php';
$query = new Manage();

$staff = $_SESSION['staff'];
$oldPass = $_POST['old_pass'];
$newPass = $_POST['new_pass'];
$conPass = $_POST['con_pass'];

if($newPass !== $conPass){
  $_SESSION['error'] = "Password confirm mismatch!";
  header("location:../changePassword");
  exit;
}

$password1 = password_hash($newPass, PASSWORD_DEFAULT);

$staffDetails = $query->getRow("select staffId, security_key from staff_tb where staffId =  $staff ");

$exPass =   $staffDetails['security_key'];

if (password_verify($oldPass, $exPass)) {

  $update = $query->updateRow("update staff_tb set security_key=?  where staffId = ?", ["$password1", "$staff"]);

  $_SESSION['changed'] = TRUE;
  header("location:../changePassword");
} else {
  $_SESSION['fail'] = TRUE;
  header("location:../changePassword");
}
