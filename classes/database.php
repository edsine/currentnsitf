<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Database{
    protected $data;
      public $isConnect;
      
   public function __construct($host="localhost", $dbname = "nsitfmai_essp", $user = "root", $pass = "", $options=[] ) {
          $this->isConnect = TRUE;
          try {
              $this->data = new PDO("mysql:host ={$host}; dbname={$dbname};",$user,$pass, $options);
              $this->data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $this->data->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
          } catch (Exception $e) {
              throw new Exception($e->getMessage());
          }
          
      }
    
}

