<?php
session_start();
 
function msg($success,$status,$user,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
         'user' => $user,
        'message' => $message
    ],$extra);
}
        
// require __DIR__.' /../../classes/Database.php';

$conn=new mysqli('localhost','root','','ebsdb');

// $db_connection = new Database();
// $conn = $db_connection->data;
$id=$_GET['doc_dialogue'];


$document_name=$_POST['document_name'];


$document_desc=$_POST['document_desc'];
$doc_file= $_POST['doc_file'];

                    
        try{
             $update_query="UPDATE `document_manager` SET `document_name`='$document_name',`document_desc`='$document_desc', `doc_file`='$doc_file' WHERE  `documentId`=$id";
             
                
               if ($conn->query($update_query)===TRUE){
                   
                   echo ("updated ");

                   header('location:../md_home?suc');
               } else{
                   echo ("error updating :" .$conn->error);
               }

               $conn -> close();
            }catch(Exception $e){

            }
               
               ?>
