<?php session_start();
 $errors = [];
require_once 'classes/manage.php';
$query = new Manage();


if(empty($_SESSION['key']))
   $_SESSION['key'] = bin2hex(random_bytes(32));
 //  echo $_SESSION['key'];
 
 $csrf = hash_hmac('sha256', 'this is some string:index.php ', $_SESSION['key']);

if(isset($_POST['log'])){
       if(hash_equals($csrf, $_POST['csrf'])){
      
           if (empty($_POST['phone'])) {
        $errors['phone'] = 'Phone number or email required';
              }
        if (empty($_POST['password'])) {
        $errors['pass'] = 'Password required';
         }
              
        $phone = $_POST['phone'];
        $pass = $_POST['password'];
                 
        if (!empty($phone) and !empty($pass)){
          
               $row = $query->getArtisan($phone);
                 $hashpass = $row['password'];
           if (password_verify($pass, $hashpass )) {
                  session_regenerate_id();
	             	$_SESSION['loggedin'] = TRUE;
	             	
	             	
	             	
	                $_SESSION['state'] = $row['state'] ;
                    $_SESSION['name'] = $row['fname'];
                    $_SESSION['phone'] = $row['phone'];
                   
                      $_SESSION['service'] = $row['service_id'];
	             	
                $_SESSION['artisan'] = $row['cArt_id'];
             
                  header('location:../account');  
             
                 } else { 
                $errors['login_fail'] = "Wrong email / password";
            }
       
     } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }


    } else{
     header("location:clients-account");
     
}
    }
    
    


        
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="Sanaa is a secure place to find trusted and reliable artisans. Sanaa is open to both individuals and corporate organizations" />
	<meta property="og:title" content="sanaa " />
	<meta property="og:description" content="Sanaa is a secure place to find trusted and reliable artisans. Sanaa is open to both individuals and corporate organizations" />
	<meta property="og:image" content="Sanaa is a secure place to find trusted and reliable artisans. Sanaa is open to both individuals and corporate organizations" />
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
                  <img src="img/artisanPro.png" alt="homepage" class="light-logo" style="width:65%;" />
                
  <?php if (count($errors) > 0): ?>
       <div class="alert alert-danger">
      <?php foreach ($errors as $error): ?>
      <li>
      <?php echo $error; ?>
    </li>
    <?php endforeach;?>
  </div>
      <?php endif;?>
                
            <h4>Sign in ?</h4>
             <h5>To your account</h5>
              <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4"></p>
                <form class="mx-1 mx-md-4" method="post" action="">



           <input type="hidden" value="<?php echo $csrf ?>" name="csrf">

         
                 
                  
                  
 <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="phone" id="form3Example3c" class="form-control" />
                      
                      <label class="form-label" for="form3Example3c">Your Phone</label>
                    </div>
                  </div>
                  
                   <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input style="border:1px;" name="password" type="password" id="form3Example4cd" class="form-control" />
                      <label class="form-label" for="form3Example4cd"> password</label>
                    </div>
                  </div>
                  
                 
                 

                 

                  <div class="form-check d-flex justify-content-center mb-5">
                  
                    <label class="form-check-label" for="form2Example3">
                   Dont have account <a href="register">New Registration</a>
                    </label>
                  </div>
                  
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="log"  class="btn btn-primary btn-lg">Submit</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="img/signin.png"
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
url: "states-by-country.php",
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
$('#state-dropdown').on('change', function() {
var state_id = this.value;
$.ajax({
url: "cities-by-state.php",
type: "POST",
data: {
state_id: state_id
},
cache: false,
success: function(result){
$("#city-dropdown").html(result);
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
