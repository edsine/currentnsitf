<?php
    $servername='23.94.186.186';
    $username='ensitfco_nuru';
    $password='2338@nsitf';
    $dbname = "ensitfco_nsitf";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }
        
        
       echo 'local';
      
       
       
       