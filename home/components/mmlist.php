<?php 
session_start();

if(!isset($_SESSION['admin-log'])){
    header("location:../");
}


require_once '../classes/manage.php';
$query = new Manage();








//$employees = $query->getRows("select firstname, lastname, phone, branchId, roles   from staff_tb"); 


//$uploadCount = $query->getRow("select count(rc_uploadId) as upCount from upload_requirement where artisan_id = $artisan"); 

//$rcount = $recCount['recCount'];
//$ucount = $uploadCount['upCount'];

//$employees = $query->getRows("select a.*, b.staffId. b.firstname, b.roles, c.*  from momo_data as a , staff_tb as b, roles as c where a.senderId = b.staffId  ");
$employees = $query->getRows("select * from memo_data ");

//if($payment !=1){
  //if ($rcount===$ucount){
       //     header("location:invoice");
    
     //   }
        
//}

?>
         <div class="card">
                <h5 class="card-header" style="font-size:30px;">Memo list</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Title</th>
                            
                             <th>Content</th>
                             
                    
                          <th>Date Created</th>
                        
                            
                        
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($employees as $row){ 
                          
                          $ap = $row['approve_status']
                          ?>
                        <tr>
                         
                               <td><? echo $row['title'] ?></td>
                               
                               
                               <td><? echo $row['content'] ?></td>
                   
                           
                            <td><?php echo $row['createdAt'] ?></td>
                            
                            
                    
                          
                          <td>
                            <div class="dropdown">
                                  <a href="" type="button" class="btn btn-primary" >Read</a>
                                   
                                   

                                   
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>