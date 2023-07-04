<?php

$conn= new mysqli('localhost','root','','ebsdb');
$id= $_GET['id'];

$sql= "DELETE  FROM document_manager WHERE documentId =$id ";

if ($conn->query($sql)){
echo "deleted successfully";
header('Location');
}else{
    echo " error " .$conn->connect_error;

}





?>