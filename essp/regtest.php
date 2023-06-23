<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>nsitf ebs</title>
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
              <img src="ikl.png" alt="logo" class="light-logo" style="width:20%; padding:12px;" />
                
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">NSITF Employer RegistrationPortal</h3>
            
            
            <p>
             
             
             <p>
                
            <form  method="post" action="processor/filesize" enctype="multipart/form-data">
                
                 
 <div class="col-md-6 mb-4">
                               

                </div>
                
               
                 <div class="row">
                     
                <div class="col-md-6 mb-4">

                  <div class="">
                       <label class="form-label" for="lastName"> -Select Application Branch-<span style="color:red;">*</span></label>
                    <select  name="branch" id="lastName" class="form-control" required />
                
                     <?php
                                                                                        require_once "db.php";
                                                                                        $result = mysqli_query($conn,"SELECT * FROM all_branch ");
                                                                                        while($row = mysqli_fetch_array($result)) {
                                                                                        ?>
                                                                                  <option value="<?php echo $row['branch_id'];?>"><?php echo $row["branch_name"]. ' &nbsp; BRANCH';?></option>
<?php
}
?>
                                                                               
                    
                    </select>
                    
                 
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="lname" type="text" id="lastName" class="form-control form-control-lg" required  />
                    <label class="form-label" for="lastName">Last Name <span style="color:red;">*</span></label>
                  </div>

                </div>
              </div>
                
                 <div class="row">
                     
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="mname" type="text" id="firstName" class="form-control form-control-lg" required  />
                    <label class="form-label" for="firstName" >Middle Name <span style="color:red;">*</span></label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="fname" type="text" id="lastName" class="form-control form-control-lg" required  />
                    <label class="form-label" for="lastName">First Name <span style="color:red;">*</span></label>
                  </div>

                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="cemail" type="email" id="firstName" class="form-control form-control-lg" required  />
                    <label class="form-label" for="firstName" >Company/Organisation Email <span style="color:red;">*</span></label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="position" type="text" id="position" class="form-control form-control-lg" required  />
                    <label class="form-label" for="lastName">Position <span style="color:red;">*</span></label>
                  </div>

                </div>
              </div>
               <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="nin" type="text" id="nin" class="form-control form-control-lg" required  />
                    <label class="form-label" for="firstName">National Identification Number (NIN) <span style="color:red;">*</span></label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="password" type="password" id="lastName" class="form-control form-control-lg" required  />
                    <label class="form-label" for="lastName">Password <span style="color:red;">*</span></label>
                  </div>

                </div>
                
               
              </div>
              
                           <div class="row">
               <div class="col-md-6 mb-4">

                  <div class="">
                   <select class="form-select" aria-label="Default select example" id="country-dropdown" name="state" required >
  <option>-Select State-  <span style="color:red;">*</span></option>                                 <?php
                                                                                        require_once "db.php";
                                                                                        $result = mysqli_query($conn,"SELECT * FROM states ");
                                                                                        while($row = mysqli_fetch_array($result)) {
                                                                                        ?>
                                                                                  <option value="<?php echo $row['id'];?>"><?php echo $row["name"];?></option>
<?php
}
?>
                                                                                   
</select>
                 
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="">
                    <select name="lgvt" class="form-select" aria-label="Default select example" id="state-dropdown" required >
  
</select>
                 
                  </div>

                </div>
              </div>

             <hr/>
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="compName" type="text" id="compname" class="form-control form-control-lg" required  />
                    <label class="form-label" for="firstName" >Company Name<span style="color:red;">*</span></label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="rcnumber" type="text" id="rc" class="form-control form-control-lg" required  />
                    <label class="form-label" for="lastName">RC Number  <span style="color:red;">*</span></label>
                  </div>

                </div>
              </div>
               <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input name="cacDate" type="date" id="firstName" class="form-control form-control-lg" required  />
                    <label class="form-label" for="firstName" >CAC Registration Date   <span style="color:red;">*</span></label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="">
                    <select  name="bussi" id="lastName" class="form-control" required  />
                    <option><span >-Bussiness Type- <span style="color:red;">*</span></span></option>
                    <option value="Public / Private Limited Company">Public / Private Limited Company</option>
                    <option value="Informal Sector Employer">Informal Sector Employer</option>
                    <option value="Partnership">Partnership</option>
                    <option value="Sole Propriotor">Sole Propriotor</option>
                    
                    </select>
                 
                  </div>

                </div>
              </div>
<div class="row">
               
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" name="address" id="lastName" class="form-control form-control-lg" required  />
                    <label class="form-label" for="lastName">Address <span style="color:red;">*</span></label>
                  </div>

                </div>
                
                
                 <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" name="phone" id="lastName" class="form-control form-control-lg" required  />
                    <label class="form-label" for="lastName">Phone Number <span style="color:red;">*</span></label>
                  </div>

                </div>
              </div>
              
              <hr/>
              
               <div class="row">
                <div class="col-md-6 mb-4">

<label class="form-label" for="firstName">Certificate of Incorporation  <span style="color:red;">(PDF Only)*</span></label>
                  <div class="form-outline">
                    <input name="doc" required type="file" id=""  class="form-control form-control-lg" />
                    
                  </div>

                </div>
                <div class="col-md-6 mb-4">
     <label class="form-label" for="lastName">Other Documents</label>
                  <div class="form-outline">
                    <input  name="docuu" type="file" id="lastName" accept=".pdf" class="form-control form-control-lg" />
                   
                  </div>

                </div>
                
               
              </div>
 

             
              

              <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" style="background-color:#50664d; border-color:#50664d;" name="register"  type="submit" value="Submit" />
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
url: "localGvt.php",
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
