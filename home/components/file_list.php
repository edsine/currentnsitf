<?php 
session_start();




$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();



$staff = $_SESSION['staff'];




$files = $query->getRows("select * from document_manager where staffId = $staff limit 15"); 


//$uploadCount = $query->getRow("select count(rc_uploadId) as upCount from upload_requirement where artisan_id = $artisan"); 

//$rcount = $recCount['recCount'];
//$ucount = $uploadCount['upCount'];

//$prequest = $query->getRows("select a.*, b.* from service_request as a, states as b where a.clientId = b.id and  a.artisanId=$artisan");

//if($payment !=1){
  //if ($rcount===$ucount){
       //     header("location:invoice");
    
     //   }
        
//}

?>
         <div class="card">
              
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table id="tabulka_kariet1" class="table ">
                      <thead>
                        <tr>
                            <th>Document Name</th>
                          <th>Document Description</th>
                          <th>Document Size</th>
                         
                           
                         
                           <th>Manage</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         

                          <?php foreach($files as $row){ ?>
                        <tr>
                         
                          <td><?php echo $row['document_name'] ?></td>
                          <td><?php echo $row['document_desc'] ?></td>
                            <td><?php echo $row['doc_size'] ?></td>
                             
                        
                          <td>
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="components/document_edit.php?id=<?php echo $row['documentId'] ?>"
                                  ><i class="bx bx-edit-alt me-1"></i> Edit </a
                                >
                                <a class="dropdown-item" href="processor/document_delete.php?id=<?php echo $row['documentId'] ?>"
                                  ><i class="bx bx-trash me-1"></i> Delete</a
                                >
                                <a class="dropdown-item" href=""data-toggle="modal" data-target="#staff_list" id="<?php echo $row['documentId'];?>"
                                  ><i class="bx bx-share-alt me-1"></i>Share</a
                                >
                              </div>
                            </div>
                          </td>
                        </tr>
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
              
             