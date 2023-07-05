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

require __DIR__.'/../../classes/database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();


if(empty($_FILES["file"]["name"])){


  $_FILES["file"]["name"]= "local";    

}    

$targetDir = "../../DOCUMENTS/DTA/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);





$branch = $_SESSION['branch'];

$der =   $_SESSION['department'] ;

$staff =    $_SESSION['staff'] ;
$purpose_travel =    $_POST['p_travel'] ;
$destination =   $_POST['destination'] ;
$number_days=    $_POST['number_days'] ;
$travel_date = $_POST['tv_date'] ;
$arrival_date = $_POST['arr_date'] ;
$estimated_expenses = $_POST['estimated_expenses'] ;


                //  echo $staff;

try{

   $allowTypes = array('jpg','png','jpeg','pdf');
   if(in_array($fileType, $allowTypes)){

    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){



       $insert_query = "INSERT INTO dta_request(`staffId`,branchId, departmentId,  `purpose_travel`, `destination`, `number_days`, `travel_date`, `arrival_date`, `estimated_expenses`,`uploaded_doc` )VALUES(:staffId,:branchId,:departmentId,:purpose_travel,:destination,
        :number_days,:travel_date, :arrival_date, :estimated_expenses, :uploaded_doc)";

       $insert_stmt = $conn->prepare($insert_query);

       $insert_stmt->bindValue(':staffId', $staff ,PDO::PARAM_INT);
       $insert_stmt->bindValue(':branchId', $branch ,PDO::PARAM_INT);
       $insert_stmt->bindValue(':departmentId', $der ,PDO::PARAM_INT);
       $insert_stmt->bindValue(':purpose_travel',  $purpose_travel ,PDO::PARAM_STR);

       $insert_stmt->bindValue(':destination', htmlspecialchars(strip_tags($destination)),PDO::PARAM_STR);


       $insert_stmt->bindValue(':number_days', htmlspecialchars(strip_tags($number_days)),PDO::PARAM_INT);


       $insert_stmt->bindValue(':travel_date', htmlspecialchars(strip_tags($travel_date)),PDO::PARAM_STR);

       $insert_stmt->bindValue(':arrival_date', htmlspecialchars(strip_tags($arrival_date)),PDO::PARAM_STR);

       $insert_stmt->bindValue(':estimated_expenses', htmlspecialchars(strip_tags($estimated_expenses)),PDO::PARAM_STR);


       $insert_stmt->bindValue(':uploaded_doc', ($targetFilePath),PDO::PARAM_STR);






       $result = $insert_stmt->execute();
       $employer = $conn->lastInsertId();



       if($result){


        $_SESSION['dtaSuccess']= TRUE;

        header('location:../submitted_dtas');

    }




}}


}
catch(PDOException $e){
    $returnData = msg(0,500,'fail',$e->getMessage());
}



echo json_encode($returnData);