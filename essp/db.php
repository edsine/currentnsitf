<?php
    $servername='178.159.5.249';
    $username='root';
    $password='';
    $dbname = "nsitfmai_essp";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }
        
        
       echo 'local';
      
       
       
       