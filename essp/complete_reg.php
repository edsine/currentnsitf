<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Sanaa Certification</title>
    <!-- MDB icon -->
    <link rel="icon" href="" type="image/x-icon" />
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

<section class="vh-100 gradient-custom" style="background-color:whitesmoke;">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
              <img src="img/artisanPro.png" alt="homepage" class="light-logo" style="width:30%;" />
                
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5"><?php echo $sname; ?> State</span > <span style="color:#16507b">&nbsp;Artisan Permit Application </span></h3>
            <form  method="post" action="../logJwt/artisan_reg" enctype="multipart/form-data">
                
                 
 <div class="col-md-6 mb-4">
                                <!--  <label class="form-label" for="lastName">Passport </label>
                  <div class="form-outline">
                <input name="passport" type="file" id="lastName" class="form-control form-control-lg" />
                    
                  </div> -->

                </div>
                
                 <div class="col-md-6 mb-4">

                  <div class="">
                    <select  name="address" id="lastName" class="form-control" />
                    <option style="color:red;"><span >Select Application Branch</span></option>
                    <option>Testing again</option>
                    <option>Testing again</option><option>Testing again</option>
                    
                    </select>
                 
                  </div>

                </div>
                
                 <div class="row">
                     
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="fname" type="text" id="firstName" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName" >First name <span style="color:red;">*</span></label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="phone" type="text" id="lastName" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">Last Name</label>
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="fname" type="email" id="firstName" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName" >Company/Organisation email</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="phone" type="text" id="lastName" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">Position</label>
                  </div>

                </div>
              </div>
               <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="email" type="text" id="firstName" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName">National Identification Number (NIN)</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="password" type="password" id="lastName" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">Password</label>
                  </div>

                </div>
                
               
              </div>
              
                           <div class="row">
               <div class="col-md-6 mb-4">

                  <div class="">
                    <select  name="address" id="lastName" class="form-control" />
                    <option style="color:red;"><span >Select Application Branch</span></option>
                    <option>Testing again</option>
                    <option>Testing again</option><option>Testing again</option>
                    
                    </select>
                 
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="">
                    <select  name="address" id="lastName" class="form-control" />
                    <option style="color:red;"><span >Select Application Branch</span></option>
                    <option>Testing again</option>
                    <option>Testing again</option><option>Testing again</option>
                    
                    </select>
                 
                  </div>

                </div>
              </div>

             <hr/>
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="fname" type="text" id="firstName" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName" >Company Name</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="phone" type="text" id="lastName" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">RC Number</label>
                  </div>

                </div>
              </div>
               <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="fname" type="date" id="firstName" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName" >CAC Registration Date</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="">
                    <select  name="address" id="lastName" class="form-control" />
                    <option style="color:red;"><span >-Bussiness Sector-</span></option>
                    <option>Testing again</option>
                    <option>Testing again</option><option>Testing again</option>
                    
                    </select>
                 
                  </div>

                </div>
              </div>
<div class="row">
               
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" name="address" id="lastName" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">Address</label>
                  </div>

                </div>
              </div>
              
              <hr/>
              
               <div class="row">
                <div class="col-md-6 mb-4">

<label class="form-label" for="firstName">Certificate of Incorporation</label>
                  <div class="form-outline">
                    <input name="email" type="text" id="firstName" class="form-control form-control-lg" />
                    
                  </div>

                </div>
                <div class="col-md-6 mb-4">
     <label class="form-label" for="lastName">Other Documents</label>
                  <div class="form-outline">
                    <input name="password" type="password" id="lastName" class="form-control form-control-lg" />
                   
                  </div>

                </div>
                
               
              </div>
 

             
              

              <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" type="submit" value="Continue" />
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
