<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of likes
 *
 * @author Mijinyawa
 */
class Likes extends Database {
    //put your code here
    function runQuery($query,$param=[]) {
             try{
		$row =$this->data->prepare($query);
                $row->execute($param);
                return $row->fetchAll(PDO::FETCH_ASSOC);
             } catch (Exception $e){
                 throw new Exception($e->getMessage());
             }
		
	}
	
	function numRows($query,$param=[]) {
                   try{
                       $row = $this->data->prepare($query);
                       $row->execute($param);
                       //$count= $row->fetch(PDO::FETCH_ASSOC);
                       return $row->rowCount();
                   } catch (Exception $e){
                       throw new Exception($e->getMessage());
                   }
		
	}
	
	function updateQuery($query,$param=[]) {
        try{
           $row = $this->data->prepare($query);
           $row->execute($param);
           return TRUE;
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
	
	}
	
	function insertQuery($query,$param=[]) {
             try{
            $row = $this->data->prepare($query);
            $row->execute($param);
            return True;
             } catch (Exception $e){
                 throw new Exception($e->getMessage());
             }
		
	}
	
	function deleteQuery($query) {
              try{
                  $row=$this->data->prepare($query);
                  $row->execute($param);
              } catch (Exception $e){
                  throw new Exception($e->getMessage());
              }
		
	}
}
