<?php  
session_start();
//creating connection
$conn = new mysqli('localhost', 'root', '', 'ebsdb');

if ($conn->connect_error){
    die('connection failed:' .$conn->connect_error);
}



$id=$_GET['id'];

$sql= "SELECT * FROM document_manager Where documentId=$id";

$results=$conn->query($sql);

$result= mysqli_fetch_assoc($results);



$conn->close();

?> 
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-element my-4">

            <form  method="post" class="form-control" action="../processor/document_edit.php"    enctype="multipart/form-data" >
                <div class="form-element my-4">
                    <input class="form-control" type="text" name="document_name" value=<?php echo $result['document_name'] ?>>
                </div>
                <div class="form-element">

                    <input type="hidden" name='documentId' value=<?php echo $result['documentId'] ?>>
                </div>
<div class="form-element my-4">
    
    <input class="form-control" type="text" name="document_desc" value=<?php echo $result['document_desc'] ?>>
</div>

<div class="form-control my-4">
    
    <input   class="form-control"   type="file" name="doc_file" >
</div>
<div class="form-element my-4 ">
    
    <input  type="submit" value="Update" class=" btn btn-primary">
</div>
</form>

</div>
</div>
</div>



    
          
           
           
   
            
        
            