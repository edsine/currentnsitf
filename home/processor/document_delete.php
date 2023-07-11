<?php
session_start();
$conn= new mysqli('localhost','root','root','ebsdb');
$id= $_GET['id'];
$folder_id=$_GET['id'];
 
$sql= "DELETE  FROM document_manager WHERE documentId =$id ";

$fstm="DELETE FROM dir_folders where folder_id=$folder_id";

if($conn->query($fstm)){
    $_SESSION['success'];
    header('Location: ../md_home');
} else {
    echo " unable to delete folder";
}

if ($conn->query($sql)){
echo "deleted successfully";
header('Location');
}else{
    echo " error " .$conn->connect_error;

}





?>