<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__.'/classes/Database.php';
//require __DIR__.'/middlewares/Pass.php';

$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->dbConnection();
//$auth = new Pass($conn,$allHeaders);

// CHECK GET ID PARAMETER OR NOT
if(isset($_GET['id']))
{
    //IF HAS ID PARAMETER
    $id = filter_var($_GET['id']);
        
}

$returnData = [
    "success" => 0,
    "status" => 401,
    "message" => "Unauthorized"
];

// MAKE SQL QUERY
// IF GET POSTS ID, THEN SHOW POSTS BY ID OTHERWISE SHOW ALL POSTS
//$rqst = $query->getRows("select a.*, b.*, c.* from request as a, artisan_tb as b ,  const_services as c where a.client_id = b.artisan_id and a.skill_id =c.service_id and a.provider_id = $id order by request_id desc limit 3");
$sql = "select a.*, b.*, c.* from request as a, artisan_tb as b, const_services as c where a.skill_id =c.service_id and a.client_id=b.artisan_id and a.client_id =$id  and a.progress_status=1 and payment_status =1 order by a.request_id desc "; 

$stmt = $conn->prepare($sql);

$stmt->execute();

//CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
if($stmt->rowCount() > 0){
    // CREATE POSTS ARRAY
    $posts_array = [];
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        $progress =$row['progress_status'];
        if($progress==='2'){
            $progress = "In Progress";
        }elseif($progress==='1'){
            $progress = "Completed";
        }else{
            $progress = "Waiting artisan";
        }
       
            $amount = $row['assigned_amount'];
            
            //$progress =$row['progress_status'];
        if($amount==='0.00'){
            $amount = "Not Set";
        }else{
            $amount = $row['assigned_amount'];
        }
        $datee = $db_connection->timeAgo($row['request_date']);
        $post_data = [
            'id' => $row['request_id'],
            'c_name' => $row['surname'],
             'c_contact' => $row['phone'],
              'progress' => $progress,
              'requested_service' => $row['service_name'],
              'r_date' =>$datee,
                'amount' =>$amount,
            'image' => html_entity_decode($row['service_image']),
            
        ];
        // PUSH POST DATA IN OUR $posts_array ARRAY
        array_push($posts_array, $post_data);
    }
    //SHOW POST/POSTS IN JSON FORMAT
    echo json_encode($posts_array);
 

}
else{
    //IF THER IS NO POST IN OUR DATABASE
    echo json_encode($posts_array);
}


?>