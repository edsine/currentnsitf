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

<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>EBS</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    
    <link rel="stylesheet" href="../../assets/hrm/css/bootstrap.min.css" />
  <link rel="stylesheet" href="jquery/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" type="text/css"    href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css"></link>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
../
    
    
    
     <link rel="stylesheet" href="../../fileStyle/css/dashlite.css?ver=3.1.3">
    <link id="skin-default" rel="stylesheet" href="../../fileStyle/css/theme.css?ver=3.1.3">
    
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
           <?php include("sidebar.php"); ?>
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <div class="form-element my-4">

            <form  method="post" class="form-control" action="../processor/document_edit."    enctype="multipart/form-data" >
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



    
          
           
           
   
            
        
            