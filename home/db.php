<?php
       $servername='localhost';
    $username='root';
    $password='Mkpanama1';
    $dbname = "ebs";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }
        
        
        