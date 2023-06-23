<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Professional Info</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    
    <!-- ajax -->
     <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<!-- Styles -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
  </head>
  <body>


  

<section class="vh-100" style="background-color: #fff; ">

  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius:3px;">
        <!-- Navbar -->

<!-- Navbar -->
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                   <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4"><img src="../assets/img/sanaa.png" style="width:30%;" ></p>
                   <h3>Professional Info</h3>
                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4"></p>

                <form class="mx-1 mx-md-4" method="post" action="../logJwt/artisan_reg">

                  
               
                  
                 <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-globe fa-lg me-3 fa-fw"></i>
                  
                    <select name="industry" class="form-control"   id="country-dropdown" >
                                                   
                                                   <option>Related service industry</option>                                 <?php
                                                                                        require_once "../../db.php";
                                                                                        $result = mysqli_query($conn,"SELECT * FROM industries where status = 1");
                                                                                        while($row = mysqli_fetch_array($result)) {
                                                                                        ?>
                                                                                  <option value="<?php echo $row['ids_id'];?>"><?php echo $row["ids_name"];?></option>
<?php
}
?>
                                                                                   
                                                                                    </select>
               
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-globe fa-lg me-3 fa-fw"></i>
                   
                     
                    <select name="service" class="form-control" id="state-dropdown">
                      
                                                                               </select>
                 
                  </div>

                 <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="number" name="exp" id="form3Example3c" class="form-control" />
                      <label class="form-label" for="form3Example3c">Years of experience</label>
                    </div>
                  </div>

                 

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-globe fa-lg me-3 fa-fw"></i>
                    <div class="mb-3">
  <label for="exampleFormControlTextarea1" name ="address" class="form-label">Current Working Address</label>
  <textarea class="form-control" name ="address" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
                  </div>

                 

                
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="img/regg.png"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
$(document).ready(function() {
$('#country-dropdown').on('change', function() {
var country_id = this.value;
$.ajax({
url: "inds_list.php",
type: "POST",
data: {
country_id: country_id
},
cache: false,
success: function(result){
$("#state-dropdown").html(result);
$('#city-dropdown').html('<option value="">Select Local government</option>'); 
}
});
});    
$('#states').on('change', function() {
var state_id = this.value;
$.ajax({
url: "localGvt.php",
type: "POST",
data: {
state_id: state_id
},
cache: false,
success: function(result){
$("#local").html(result);
}
});
});
});
</script>

<script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
  </body>
</html>
