<?php
session_start();
$_SESSION['subType'] = $plan;
function msg($success, $status, $user, $message, $extra = [])
{
  return array_merge([
    'success' => $success,
    'status' => $status,
    'user' => $user,
    'message' => $message
  ], $extra);
}

if (!$_POST['toId'] || !$_POST['fileId']) {
  $_SESSION['error'] = "Please fill in required details to share a file.";
  header('location:../md_home');
}

require __DIR__ . '/../../classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

$fileId = $_POST['fileId'];
$fromId =    $_POST['fromId'];
$toId =   $_POST['toId'];
$comment = $_POST['comment'];

try {

  $insert_query = "INSERT INTO shared_files( fileId, `from_Id`,to_Id,comments)VALUES(:fileId,:from_id,
                :to_Id,:comments)";

  $insert_stmt = $conn->prepare($insert_query);

  // DATA BINDING
  $insert_stmt->bindValue(':fileId', $fileId, PDO::PARAM_INT);
  $insert_stmt->bindValue(':from_id', $fromId, PDO::PARAM_INT);
  $insert_stmt->bindValue(':to_Id',  $toId, PDO::PARAM_INT);
  $insert_stmt->bindValue(':comments', $comment, PDO::PARAM_STR);

  $result = $insert_stmt->execute();
  $employer = $conn->lastInsertId();

  if ($result) {
    $_SESSION['success'] = "File shared successfully!";
  } else {
    $_SESSION['error'] = "Could not share file.";
  }
} catch (PDOException $e) {
  //$returnData = msg(0, 500, 'fail', $e->getMessage());
  $_SESSION['error'] = $e->getMessage();
}
header('location:../md_home');


//echo json_encode($returnData);
