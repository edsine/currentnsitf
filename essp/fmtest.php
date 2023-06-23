<?php
session_start();
require_once '../../classes/manage.php';
$query = new Manage();

$pistate = $_SESSION['state'];
$plocal = $_SESSION['local'];

//echo $pistate;

$pstate = $query->getRow("select * from states where id = $pistate"); 
$logo = $pstate['state_logo'];
$sname = $pstate['name'];


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Sanaa Certification</title>
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
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    
    
     <!-- ajax -->
     
     <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<!-- Styles -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
    .card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;
}
.card-registration .select-arrow {
top: 13px;
}
</style>
  </head>
  <body>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5"><?php echo $sname; ?></span> &nbsp;Artisan Permit Application</h3>
            <form  method="post" action="../logJwt/artisan_reg">

              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="fname" type="text" id="firstName" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName">Fullname</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="phone" type="text" id="lastName" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">Phone Number</label>
                  </div>

                </div>
              </div>
               <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="email" type="text" id="firstName" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName">Email</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="password" type="text" id="lastName" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">Password</label>
                  </div>

                </div>
              </div>

              <div class="row">
               
                <div class="col-md-6 mb-4">

                  <h6 class="mb-2 pb-1">Gender: </h6>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" name="gendar" type="radio" name="gendar" id="femaleGender"
                      value="Female" checked />
                    <label class="form-check-label" for="femaleGender">Female</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gendar" id="maleGender"
                      value="Male" />
                    <label class="form-check-label" for="maleGender">Male</label>
                  </div>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gendar" id="otherGender"
                      value="Other" />
                    <label class="form-check-label" for="otherGender">Other</label>
                  </div>

                </div>
              </div>
<div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="number" name="exp" id="firstName" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName">Years Of experience</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" name="address" id="lastName" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">Working Address</label>
                  </div>

                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                  <select class="form-select" aria-label="Default select example" id="country-dropdown" name="industry">
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

                </div>
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                  <select name="service" class="form-select" aria-label="Default select example" id="state-dropdown">
  
</select>
                  </div>

                </div>
              </div>

             
              

              <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
              </div>

            </form>
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
