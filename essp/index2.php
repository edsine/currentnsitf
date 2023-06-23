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
  </head>
  <body>


<section class="vh-100" style="background-color: #fff; ">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius:3px;">
   <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                
            <p><span style="font-size:20px; color:#16507b;"><?php echo $sname; ?></span> &nbsp;Artisan Certification Application</p>
              <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4"></p>
                <form class="mx-1 mx-md-4" method="post" action="../logJwt/artisan_reg">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i         style="color:#16507b;" class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="fname" id="form3Example1c" class="form-control" />
                      <label class="form-label" for="form3Example1c">Fullname</label>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i         style="color:#16507b;" class="fas fa-phone fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="phone" id="form3Example3c" class="form-control" />
                      <label class="form-label" for="form3Example3c">Phone number</label>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i         style="color:#16507b;" class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" name="email" id="form3Example3c" class="form-control" />
                      <label class="form-label" for="form3Example3c">Your Email</label>
                    </div>
                  </div>
                  
                   <div class="d-flex flex-row align-items-center mb-4">
                    <i         style="color:#16507b;" class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input style="border:1px;" name="password" type="password" id="form3Example4cd" class="form-control" />
                      <label class="form-label" for="form3Example4cd"> password</label>
                    </div>
                  </div>
                  
                   <div class="d-flex flex-row align-items-center mb-4">
                    <i         style="color:#16507b;" class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                    <select class="form-select" name="gendar" aria-label="Default select example">
                      <option selected>Gendar</option>
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                      <option value="3">Others</option>
                    </select>
                    </div>
                  </div>
                  
                  
                       <div class="d-flex flex-row align-items-center mb-4">
                    <i         style="color:#16507b;" class="fas fa-globe fa-lg me-3 fa-fw"></i>
                  
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
                    <i         style="color:#16507b;" class="fas fa-globe fa-lg me-3 fa-fw"></i>
                   
                     
                    <select name="service" class="form-control" id="state-dropdown">
                      
                                                                               </select>
                 
                  </div>
                  
                   <div class="d-flex flex-row align-items-center mb-4">
                    <i         style="color:#16507b;" class="fas fa-user fa-lg me-3 fa-fw"></i>
                 
                      <input type="number" name="exp" id="form3Example3c" class="form-control" placeholder="Years of experience" />
                     
                
                  </div>
                  
                  
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i         style="color:#16507b;" class="fas fa-user fa-lg me-3 fa-fw"></i>
                   <textarea class="form-control" id="exampleFormControlTextarea3" name="address" placeholder="Working address" rows="3"></textarea>
                     
                
                  </div>
                  
                  
                  

               

                  <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit"  class="btn btn-primary btn-lg">Submit</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4"><img src="state-logo/<?php echo $logo ?>" style="width:30%;" ></p>
      
<p>
              Ambitioni dedisse scripsisse iudicaretur. Cras mattis iudicium purus sit amet fermentum. Donec sed odio operae, eu vulputate felis rhoncus. Praeterea iter est quasdam res quas ex communi. At nos hinc posthac, sitientis piros Afros. Petierunt uti sibi concilium totius Galliae in diem certam indicere. Cras mattis iudicium purus sit amet fermentum.
              </p>

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
