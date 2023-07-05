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
$conn = $db_connection->data;




              
                  $staff =    $_SESSION['staff'] ;
                   $title=    $_POST['title'] ;
                  $destination =   $_POST['destination'] ;
                  $content=    $_POST['content'] ;
                  $id=$_POST['id'];
                
                    
        try{
            
            // $allowTypes = array('jpg','png','jpeg','pdf');
         // if(in_array($fileType, $allowTypes)){
      
       // if(move_uploaded_file($_FILES["doc"]["tmp_name"], $targetFilePath)){
 

                //  $update_query = "UPDATE  memo_data(`senderId`, `receiverId`, `title`, `content` )VALUES(:senderId,:receiverId,:title,
                // :content) where id= `senderId ";
                $update_query="UPDATE `memo_data` SET `title`='$title',`content`='$content',WHERE  `senderId`='$id'";
                
                   $insert_stmt = $conn->prepare($update_query);



                  $insert_stmt->bindValue(':senderId', $staff ,PDO::PARAM_INT);
                  $insert_stmt->bindValue(':title',  $title,PDO::PARAM_STR);
                  
                  
                     $insert_stmt->bindValue(':receiverId',$destination ,PDO::PARAM_INT);
                  
               
                
                 $insert_stmt->bindValue(':content', htmlspecialchars(strip_tags( $content)),PDO::PARAM_STR);
                
               
                
               
              
               $result = $insert_stmt->execute();
                $employer = $conn->lastInsertId();
                
               
                
                if($result){
                
                 
                    $_SESSION['mmoSuccess']= TRUE;
    
            header('location:../all-memos');
                    
               }


        
        
     //   }}


        }
        catch(PDOException $e){
            $returnData = msg(0,500,'fail',$e->getMessage());
        }
    


echo json_encode($returnData);


