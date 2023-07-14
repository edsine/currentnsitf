<?php
session_start();

require __DIR__ . '/../../classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();


if($_GET['type'] == 'doc'){
    $id = $_GET['id'];
    $sql = "DELETE  FROM document_manager WHERE documentId =$id ";
    $delete_stmt = $conn->prepare($sql);
    $result = $delete_stmt->execute();

    if ($result) {
        $_SESSION['success'] = "Document deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting document!";
    }
}else{
    $folder_id = $_GET['id'];
    $fstm = "DELETE FROM dir_folders where folder_id=$folder_id";
    $delete_stmt = $conn->prepare($fstm);
    $result = $delete_stmt->execute();
    
    if ($result) {
        $_SESSION['success'] = "Folder deleted successfully!";
    } else {
        $_SESSION['error'] = " unable to delete folder";
    }
}

header('location:../md_home');