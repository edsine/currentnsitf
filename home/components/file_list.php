<?php 
session_start();




$employer = 1004033022 ;
require_once '../classes/manage.php';
$query = new Manage();



$staff = $_SESSION['staff'];




$files = $query->getRows("select * from document_manager where staffId = $staff limit 15"); 

        
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
                            
                            <div class="dropdown mb-4">
                              <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item"  data-toggle="modal" data-target="#modalLoginForm<?php echo $row['documentId'] ?>fr"><i class="bx bx-edit-alt me-1"></i> Edit </a
                                >
                                <a class="dropdown-item" href="processor/document_delete.php?id=<?php echo $row['documentId'] ?>"
                                  ><i class="bx bx-trash me-1"></i> Delete</a
                                >
                                <!-- <a class="dropdown-item" href=""data-toggle="modal" data-target="#staff_list" id="<?php echo $row['documentId'];?>"
                                  ><i class="bx bx-share-alt me-1"></i>Share</a
                                > -->
                              </div>
                            </div>
                          </td>
                        </tr>

                        <div class="modal fade" id="modalLoginForm<?php echo $row['documentId'] ?>fr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
      <h4 class="modal-title w-100 font-weight-bold">Edit Document   </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  method="post" class="form" action="processor/document_edit.php?doc_dialogue=<?php echo $row['documentId'] ?>"    enctype="multipart/form-data" >
      <div class="modal-body">
      
        <div class="md-form mb-5">
        <label data-error="wrong" data-success="right" for="docname">Document Name</label>
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="text" id="docname" name="document_name" value="<?php echo $row['document_name'] ?>" class="form-control validate " required />
       
        </div>

        <div class="md-form mb-4">
        <label data-error="wrong" data-success="right" for="docdes">Document Description</label>
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="text" id="docdes" name="document_desc" value="<?php echo $row['document_desc'] ?>" class="form-control validate" required />
         
        </div>
<hr />
        <div class="md-form mb-5">
        <label data-error="wrong" data-success="right" for="pdffile">PDF File</label>
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="file" name="doc_file"  id="pdffile" class="form-control validate">
      
        </div>
        <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-secondary">Save Changes</button>
      </div>
      </div>
                          </form>
    </div>
  </div>
</div>
   
                        
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              

              
    