<?php
session_start();

function msg($success, $status, $user, $message, $extra = [])
{
    return array_merge([
        'success' => $success,
        'status' => $status,
        'user' => $user,
        'message' => $message
    ], $extra);
}

if (!$_POST['document_name'] || !$_POST['document_desc']) {
    $_SESSION['error'] = "Document name and description are required for file edits.";
}

require __DIR__ . '/../../classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

$id = $_GET['doc_dialogue'];

$document_name = $_POST['document_name'];

$document_desc = $_POST['document_desc'];
$doc_file = $_POST['doc_file'];

try {
    $update_query = "UPDATE `document_manager` SET `document_name`='$document_name',`document_desc`='$document_desc', `doc_file`='$doc_file' WHERE  `documentId`=$id";
    $update_stmt = $conn->prepare($update_query);
    $result = $update_stmt->execute();

    if ($result) {
        $_SESSION['success'] = "Changes Updated Successfully";
    } else {
        $_SESSION['error'] = ("Error updating document");
    }
} catch (Exception $e) {
    $_SESSION['error'] = $e;
}
header('location:../md_home');
