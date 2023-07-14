<?php
session_start();

if (isset($_REQUEST["file"])) {
    // Get parameters
    $file = urldecode($_REQUEST["file"]); // Decode URL-encoded string

    //get the file by id and fetch actual from location
    require __DIR__ . '/../../classes/Database.php';
    $db_connection = new Database();
    $conn = $db_connection->dbConnection();

    $select_query = "SELECT  `path` FROM document_manager WHERE documentId=$file";
    $stmt = $conn->prepare($select_query);
    $stmt->execute();

    if ($stmt->rowCount()) {
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();

        $filepath = $result['path'];

        // Process download
        if (file_exists($filepath)) {
            $_SESSION['success'] = "File downloaded successfully!";
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
        } else {
            http_response_code(404);
            die();
        }

    } else {
        $_SESSION['error'] = "File for download does not exists.";
    }
} else {
    $_SESSION['error'] = "Please provide a file for download.";
}

header('location:../md_home');
