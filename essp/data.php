<?php  
session_start();

//if (!isset($_SESSION['loggedin'])) {
//	header('Location: index');
//	exit;
//}
 
  $id = $_SESSION['s_id']; 

  require_once '../classes/manage.php';
  $query = new Manage();
  
  
   $request = $query->getRows("select * from c_artisan where status = 1 ");
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>navsa input | supplier</title>  
           <script src=" https://code.jquery.com/jquery-3.5.1.js"></script>  
          
           <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>  
           <script src=" https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>     
             <script src="  https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>     
           <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />  
            <link rel="stylesheet" href="  https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" />  
      </head>  
      <body>  
           <br /><br />  
           <div class="container">  
            <center> <img  src="../assets/img/logos/NITDA.png" alt="NAVSA LOGO" style="width:100px; height:100px;"> </center>
         
                <br />  
                <div class="table-responsive">  
           <table id="example" class="display" style="width:100%; padding:25px; ">
        <thead>
            <tr>
      <th>Farmer Name</th>
       <th>Farmer number</th>
         <th>Farmer state</th>
                                                
                                                
                                               
                                                <th>Paid product</th>
                                              
                                             
                                                <th>Total Amount </th>
                                                 <th>Paid Date/Time</th>
                                              
    </tr>
        </thead>
        <tbody>
             <?php foreach(  $request as $row){
                                              $total = $row['product_price'] * $row['p_quantity'];
                                            
                                            ?>
    <tr>
      
      <td><?php echo $row['f_name'].' '. $row['fname']  ?></td>
      <td><?php echo $row['phone'] ?></td>
         <td><?php echo $row['state'] ?></td>
     
      
      <td><?php echo $row['email']?></td>
   
   
      <td>₦<?php echo $row['expererience'] ?></td>
      
       <td><?php echo $row['createdAt'] ?></td>
       
       
            <td><a href="">Approve</a></td>
      
    </tr>                                                                                                 
   <?php } ?>
       
        </tbody>
        <tfoot>
            <tr>
      <th>Farmer Name</th>
       <th>Farmer number</th>
           <th>Farmer state</th>
                                                
                                                
                                               
                                                <th>Paid product</th>
                                              
                                             
                                                <th>Total Amount </th>
                                                 <th>Paid Date/Time</th>
                                              
    </tr>
        </tfoot>
    </table>
                      <button ><a href="dashboard">Go Back</a></button>
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
} );
 
 </script>  