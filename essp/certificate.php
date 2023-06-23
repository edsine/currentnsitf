 <?php 
session_start();
require_once '../classes/manage.php';
$query = new Manage();

$pistate = $_SESSION['pstate'];
$plocal = $_SESSION['plocal'];
$artName = $_SESSION['name'];
$artPhone = $_SESSION['phone'];
$address = $_SESSION['address'];
$service = $_SESSION['service'];
$artisan =  $_SESSION['artisan'];




$pstate = $query->getRow("select * from states where id = $pistate"); 
$plocal = $query->getRow("select * from local_governments where id = $plocal"); 
 
 
$serviceDetails = $query->getRow("select * from const_services where service_id = $service"); 

  $sme = $serviceDetails['service_name'];
 $sname = $pstate['name'];


$pslocal = $plocal['local_name'];


?>
 
 <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    

<style>
    .outer-border{
    width:800px; height:650px; padding:20px; text-align:center; border: 10px solid #673AB7;    margin-left: 21%;
}

.inner-dotted-border{
    width:750px; height:600px; padding:20px; text-align:center; border: 5px solid #673AB7;border-style: dotted;
}

.certification{
    font-size:50px; font-weight:bold;    color: #663ab7;
}

.certify{
    font-size:25px;
}

.name{
    font-size:30px;    color: green;
}

.fs-30{
    font-size:30px;
}

.fs-20{
    font-size:20px;
}
</style>
<div class="outer-border">
<div class="inner-dotted-border">
       <span class="certification">Certificate of Permission</span>
       <br><br>
       <span class="certify"><i>This is to certify that</i></span>
       <br><br>
       <span class="name"><b><?php echo  $artName ?></b></span><br/><br/>
       <span class="certify"><i>Has been permitted to practice in <?php echo $sname. '->'. $pslocal  ?>  </i></span> <br/><br/>
       <span class="fs-30"> <?php echo  $sme ?></span> <br/><br/>
       <span class="fs-20">Permitted by <b>(the permission partner) </b></span> <br/><br/><br/><br/>
       <span class="certify"><i>dated</i></span><br>
      
      <span class="fs-30">29 DEC,2022</span>

</div>
</div>
