<?php
//require __DIR__.'/../classes/Database.php';
class Users extends Database{

    protected $db;
    protected $headers;
    //protected $token;
    public function __construct($db,$headers) {
        parent::__construct();
        $this->db = $db;
        $this->headers = $headers;
    }



    public function fetchUsers(){
        try{
            $fetch_user_by_id = "SELECT `name`,`email` FROM `users` ";
            $query_stmt = $this->db->prepare($fetch_user_by_id);
           // $query_stmt->bindValue(PDO::PARAM_INT);
            $query_stmt->execute();

            if($query_stmt->rowCount()):
                $row = $query_stmt->fetchAll(PDO::FETCH_ASSOC);
                return [
                    'success' => 1,
                    'status' => 200,
                    'user' => $row
                ];
            else:
                return null;
            endif;
        }
        catch(PDOException $e){
            return null;
        }
    }
}