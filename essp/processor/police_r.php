<?php
session_start();


  
  
   $_SESSION['subType'] = $plan;
function msg($success,$status,$user,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
         'user' => $user,
        'message' => $message
    ],$extra);
}
 require __DIR__.'/classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();
 


    
   $user =  $_SESSION['artisan'];

    $allowed_image_extension = array(
        "pdf",
        "doc",
        "jpeg",
        "png"
    );
    
    // Get image file extension
    $file_extension = pathinfo($_FILES["file-input"]["name"], PATHINFO_EXTENSION);
    
    // Validate file input to check if is not empty
    if (! file_exists($_FILES["file-input"]["tmp_name"])) {
        $response = array(
            "type" => "error",
            "message" => "Choose image file to upload."
        );
    }    // Validate file input to check if is with valid extension
    else if (! in_array($file_extension, $allowed_image_extension)) {
        $response = array(
            "type" => "error",
            "message" => "Upload valiid images. Only PNG and JPEG are allowed."
        );
       // echo $result;
    }    // Validate image file size
    else if (($_FILES["file-input"]["size"] > 2000000)) {
        $response = array(
            "type" => "error",
            "message" => "Image size exceeds 2MB"
        );
    }    // Validate image file dimension
    
        
    
  else {
        $filename =  $_FILES["file-input"]["name"];
        $target = "../background-files/" . basename($_FILES["file-input"]["name"]);
        if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target)) {
              
              $unique = 121333;
          
            $insert_query = "INSERT INTO `background_report`(artisan,bg_report, unique_id) VALUES(:user,:file,:unique)";

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                  $insert_stmt->bindValue(':user',$user,PDO::PARAM_STR);
                $insert_stmt->bindValue(':file',$filename,PDO::PARAM_STR);
                   $insert_stmt->bindValue(':unique',$unique,PDO::PARAM_STR);
        
            $insert_stmt->execute();
            
            $response = array(
                "type" => "success",
                "message" => "Image uploaded successfully."
            );
            header("location:success-message");
        } else {
            $response = array(
                "type" => "error",
                "message" => "Problem in uploading image files."
            );
        }
    }

?>