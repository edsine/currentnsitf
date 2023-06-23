<?php
       $servername='178.159.5.249';
    $username='nsitfmai_ebs2';
    $password='ebs@nsitf';
    $dbname = "nsitfmai_essp";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }
        
        
        