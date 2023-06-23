<?php
 require_once 'manage.php';
   //require_once 'db.php';
   
    $query = new Manage();
        $status = 1;
       // $sl = $query->getRows("select a.*, b.* from bills as a, law_maker as b where a.law_id = b.law_id order by a.bill_id desc limit 8");
        $states = $query->getRows("select * from state ");
           $zone = $query->getRows("select * from geo_zone ");
              $local = $query->getRows("select * from local_govt ");
           $soil_type = $query->getRows("select * from soil_type ");
           
           
           $crop_know = $query->getRows("select * from knowldge_base");
           
           
           $soil_know = $query->getRows("select * from soil_knowledge");
           
           
           
           
           
           
         
         //$state = $query->getRows("select * from states");
          // $getCandidate= $query->getRows("select a.*,b.* from polls as a , poll_category as b where a.poll_cat = b.pollcat_id and b.status= $status");
         //    $poll_result= $query->getRows("select a.*,b.* from polls as a , poll_category as b where a.poll_cat = b.pollcat_id and b.status= 0 and b.result_status = 1 order by a.poll_id");
           
         //   $getCandidat= $query->getRow("select description from poll_category where status = 1 ");
            
            
            //lawmakers or legistlators
          
            
             function excerpts($string, $word_limit = 30) {
    $words = explode(" ", $string);
     

    return implode(" ", array_splice($words, 0, $word_limit));
}