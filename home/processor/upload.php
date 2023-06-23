<?php
session_start();
require_once './classes/manage.php';
$db = new Manage();

$user_id= $_SESSION['staff'];
$uploadDir = '../document_uploads/'.$user_id;


if (!empty($_FILES)) {  

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    
 $tmpFile = $_FILES['file']['tmp_name'];  
 $filename = $uploadDir.'/'.time().'-'. $_FILES['file']['name'];  
 move_uploaded_file($tmpFile,$filename);  

 $NOW = new DateTime();
 $date = $NOW->format('Y-m-d');
 $time = date("M-d-Y h:i A",strtotime("+0 HOURS"));
 $FileLoc = $filename;
 $name = $_FILES['file']['name'];
 $size = $_FILES['file']['size'];

 $q = "INSERT INTO file_uploads (user_id, `FileName`, FileDate, FileTime, Size, FileLoc) VALUES (?, ?, ?, ?, ?, ?)";

 $params = array($user_id, $name, $date,  $time, $size , $FileLoc);
 
 $insert_success = $db->insert($q, $params);
 
}

$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : null);

switch($action){
    
   case 'deleteFile':
     
        $id =  trim($_POST['id']);
        
        $query = "SELECT * FROM file_uploads WHERE FileID = ?";
        $file = $db->getRow($query, [$id]);

        // $query = "DELETE FROM file_uploads WHERE FileID = ?";
        // $params = [$id];
        // $result = $db->delete($query, $params);
        
        // delete the file from the file system
         $filePath = $file['FileLoc']; // replace with actual file path

     //   if (unlink($filePath)) {
            // file deleted successfully
            // delete the file record from the database
            $deleteQuery = "DELETE FROM file_uploads WHERE FileID = ?";
            $deleteParams = [$id];
            $result = $db->delete($deleteQuery, $deleteParams);
        
            if ($result) {
                // file record deleted successfully
                echo json_encode(["status" => true, "message" => "File deleted successfully"]);
            } else {
                // error deleting file record
                echo json_encode(["status" => false, "message" => "Error deleting file record"]);
            }
        // } else {
        //     // error deleting file
        //     echo json_encode(["status" => false, "message" => "Error deleting file"]);
        // }
      
    break;

    case "search" :

        //Get the search and login values from the request body
        $requestData = json_decode(file_get_contents('php://input'));
        $id = $requestData->search;
        $user_id = $requestData->login;
        $current_user_id= $_SESSION['staff'];

        $result = $db->getRow("SELECT * FROM staff_tb WHERE staffId = ? OR staff_email = ?", [$user_id, $user_id]);
        
        //check existence of user
        if(!$result){
           // http_response_code(404);
            echo json_encode(["status" => false, "message" => "User does not exist"]);
            return;
        }
        

        // Perform your database query or other logic here to get the data you need
        // For example:
        $sql = "SELECT * FROM file_uploads WHERE FileID  = ? AND user_id = ?";
        $file = $db->getRow($sql, [$id , $current_user_id]);

        if(!$file){
           // http_response_code(404);
            echo json_encode(["status" => false, "message" => "You have no file with this ID"]);
            return;
        }
        
        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    break;
    
    
}

?>