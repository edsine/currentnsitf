<?php 
require_once './manage.php';
$db = new Manage();

$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : null);


switch($action){
    
   case 'deleteEmployee':
     
        $id =  trim($_POST['id']);
        $query = "DELETE FROM employees WHERE employee_id = ?";
        $params = [$id];
        $result = $db->delete($query, $params);
        
        if($result) {

             echo json_encode(["status"=>true,"message"=>"User deleted successfully"]);
        } else {
            
             echo json_encode(["status"=>false,"message"=>"Error deleting user"]);
        }
      
    break;
    
    
}





?>