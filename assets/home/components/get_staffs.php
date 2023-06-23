<?php 
session_start();

require_once '../classes/manage.php';
$query = new Manage();

if(isset($_POST['id'])){
  $id = $_POST['id'];
  
     $output['id'] =  $id ;
    
  echo json_encode($output);
  }
  else
  {
    $output['failed'] = '<font color="#ff0000" style="font-size: 20px;">Data not available</font>';
    echo json_encode($output);
  }
  exit;
  
  