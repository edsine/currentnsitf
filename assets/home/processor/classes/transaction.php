<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of transaction
 *
 * @author Nuru
 */
require_once 'database.php';
class Transaction extends Database {
    public function transact($query,$params = [])
{
    try {
        $this->data->beginTransaction();
         $insert = $this->data->prepare($query);
          $insert->execute($params);
             return TRUE;
        

        $commitCode = $this->data->commit();  
    }
    catch (PDOException $ex) {
        header("locatio:reception.php");

        $roalBackCode = $this->data->rollBack();
    }

    return array('errorInfo' => $errorInfo, 'commitCode' => $commitCode, 'roalBackCode' => $roalBackCode);
    //put your code here
}
}
