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

if (!$_POST['folder']) {
    $_SESSION['error'] = "Please enter a name for your folder.";
    header('location:../md_home');
}


require __DIR__ . '/../../classes/database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();


$dep = $_SESSION['path'];
$newFolder = $_POST['folder'];

$folder = "../../DOCUMENTS/$dep/$newFolder";

if (!file_exists("../../DOCUMENTS/$dep/$newFolder")) {
    mkdir("../../DOCUMENTS/$dep/$newFolder", 0777, true);
} else {

    $_SESSION['error'] =  "folder already exist";
    header('location:../md_home');
}


$depratment = $_POST['dpart'];
$staffId =    $_POST['staffId'];
$folderName =   $_POST['folder'];



try {

    $pin = rand(100000, 999999);

    $map = "RC" . $pin;

    $insert_query = "INSERT INTO `dir_folders`(`departId`, `folder_name`, `createdBy`, `folder_path`)VALUES(:department,
                :folder_name,:createdBy, :folder_path)";

    $insert_stmt = $conn->prepare($insert_query);

    // DATA BINDING

    $insert_stmt->bindValue(':department',  $depratment, PDO::PARAM_INT);
    $insert_stmt->bindValue(':createdBy', $staffId, PDO::PARAM_STR);

    $insert_stmt->bindValue(':folder_name', htmlspecialchars(strip_tags($folderName)), PDO::PARAM_STR);
    $insert_stmt->bindValue(':folder_path', $folder, PDO::PARAM_STR);


    $result = $insert_stmt->execute();
    $employer = $conn->lastInsertId();
    $file = 'CAC';

    if ($result) {
        $_SESSION['success'] = "Folder created successfully!";
    } else {
        $_SESSION['error'] = "ERROR: Folder not deleted!";
    }
} catch (PDOException $e) {
    //$returnData = msg(0, 500, 'fail', $e->getMessage());
    $_SESSION['error'] = $e->getMessage();
}

header('location:../md_home');

//echo json_encode($returnData);
