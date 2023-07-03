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



            //     $nin =  $_POST['nin'];


                      //$insId = $_POST['inspId'] ;
$officer =    $_POST['officer'] ;
$review =    $_POST['review'] ;
$leave =   $_POST['leaveId'] ;
$approveDays = $_POST['app_days'] ;
$app_date =   $_POST['app_date'];
$comment =   $_POST['comment'];
$logged_in_user_role =   $_POST['logged_in_user_role'];

$staff_role = $logged_in_user_role ;
$stage = 3;
$leave_officer = $_SESSION['staff'];



try{




 $update_query = "UPDATE leave_review SET officer_id =:officer_id, leave_id =:leave_id, approved_days=:approved_days,
 approved_date =:approved_date, comments =:comments";
 $update_stmt = $conn->prepare($update_query);
 $conn->begintransaction();
             // DATA BINDING
 $update_stmt->bindValue(':officer_id',$officer,PDO::PARAM_INT);
 $update_stmt->bindValue(':leave_id',$leave,PDO::PARAM_INT);
 $update_stmt->bindValue(':approved_days', $approveDays,PDO::PARAM_STR);
 $update_stmt->bindValue(':approved_date', $app_date,PDO::PARAM_STR);
 $update_stmt->bindValue(':comments', $comment,PDO::PARAM_STR);
 $result = $update_stmt->execute();
 $leave_review_id = $conn->lastInsertId();

 $file = 'CAC';

 $update_leave_stage = "UPDATE leave_stage SET stage =:stage where leave_id=:leave_id";
 $update_stmt = $conn->prepare($update_leave_stage);
 $update_stmt->bindValue(':leave_id',$leave,PDO::PARAM_INT);
 $update_stmt->bindValue(':stage',$stage,PDO::PARAM_INT);
 $update_stmt->execute();

 $update_query3 = "Update leave_request set md_hr = :md_hr where leaveId =:leave_id";
 $update_stmt3 = $conn->prepare($update_query3);
 $update_stmt3->bindValue(':md_hr',$leave_officer,PDO::PARAM_INT);
 $update_stmt3->bindValue(':leave_id', $leave,PDO::PARAM_INT);
 $update_stmt3->execute();
 $conn->commit();

 $_SESSION['rvSuccess'] = TRUE;
 header('location:../hod_reviewed');
}
catch(PDOException $e){
    $returnData = msg(0,500,'fail',$e->getMessage());
    $conn->rollback();
}



echo json_encode($returnData);