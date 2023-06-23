<?php
require_once 'database.php';
class Manage extends Database
{
    //put your code here


    /**
     * insert
     * generic insert function
     * accept query and params
     * @param  mixed $query
     * @param  mixed $params
     * @return void
     */
    public function insert($query, $params = [])
    {
        try {
            $insert = $this->data->prepare($query);
            $insert->execute($params);
            return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * validateString
     * validate string input from user
     *  accept string as input
     * @param  mixed $string
     * @return void
     */
    public function validateString($string)
    {
        $var = trim($string);
        $var = htmlentities($string);
        $var = htmlspecialchars($string);
        $filter_var = filter_var($var, FILTER_SANITIZE_STRING);
        $filter_var = filter_var($var, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        return $filter_var;
    }

    public function validateEmail($string)
    {
    }

    public function validateInt($int)
    {
        $intVal = filter_var($int, FILTER_VALIDATE_INT);
        return $intVal;
    }
    public function validateFloat($float)
    {
        $floatVal = filter_var($float, FILTER_VALIDATE_FLOAT);
        return $floatVal;
    }

    public function getFarmers($email)
    {

        try {

            $statement = $this->data->prepare("SELECT * FROM farmers_data WHERE f_email=:email or f_phone =:email ");
            $statement->execute(array(":email" => $email));
            $dataRows = $statement->fetch(PDO::FETCH_ASSOC);

            return $dataRows;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }



    public function getArtisan($phone)
    {

        try {

            $statement = $this->data->prepare("SELECT * FROM c_artisan WHERE phone=:phone");
            $statement->execute(array(":phone" => $phone));
            $dataRows = $statement->fetch(PDO::FETCH_ASSOC);

            return $dataRows;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSupply($email)
    {

        try {

            $statement = $this->data->prepare("SELECT * FROM supply_comp WHERE comp_email=:email or comp_phone =:email ");
            $statement->execute(array(":email" => $email));
            $dataRows = $statement->fetch(PDO::FETCH_ASSOC);

            return $dataRows;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }



    /**
     * getEmployer
     * get details of employer from database
     *  accept email as input
     * @param  mixed $email
     * @return void
     */
    public function getEmployer($email)
    {

        try {

            $statement = $this->data->prepare("SELECT employer_id, c_email, password FROM employer_tb  WHERE c_email=:email ");
            $statement->execute(array(":email" => $email));
            $dataRows = $statement->fetch(PDO::FETCH_ASSOC);

            return $dataRows;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }


    /**
     * getRow
     * get a single row from database
     * accept query and params
     * @param  mixed $query
     * @param  mixed $params
     * @return void
     */
    public function getRow($query, $params = [])
    {
        try {
            $row = $this->data->prepare($query);
            $row->execute($params);
            return $row->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * getRows
     * get multiple rows from database
     * accept query and params
     * @param  mixed $query
     * @param  mixed $params
     * @return void
     */
    public function getRows($query, $params = [])
    {
        try {
            $rows = $this->data->prepare($query);
            $rows->execute($params);
            return  $rows->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * updateRow
     * update row from users
     *  accept query and params
     * @param  mixed $query
     * @param  mixed $params
     * @return void
     */
    public function updateRow($query, $params = [])
    {

        $update = $this->insert($query, $params);
    }


    /**
     * delete
     * delete row from database
     *  accept query and params
     * @param  mixed $query
     * @param  mixed $params
     * @return void
     */
    public function delete($query, $params = [])
    {
        $delete = $this->insert($query, $params);
    }


    /**
     * getAdmin
     * function to get the admin details
     * accept the query and the params
     * @param  mixed $query
     * @param  mixed $params
     * @return void
     */
    public function getAdmin($query, $params = [])
    {

        try {

            $statement = $this->data->prepare($query);
            $statement->execute($params);
            $dataRows = $statement->fetch(PDO::FETCH_ASSOC);

            return $dataRows;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    // functions handling the posting system
    public function posts()
    {
        //global $pdo;
        $query = $this->data->prepare("SELECT * FROM `posts`ORDER BY `post_id` DESC");
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * add_user
     * function to handle the user registration
     *  accept the name, username, phone, password, work and the image
     * @param  mixed $name
     * @param  mixed $username
     * @param  mixed $phone
     * @param  mixed $pass
     * @param  mixed $work
     * @param  mixed $file_parh
     * @return void
     */
    public function add_user($name, $username, $phone, $pass, $work, $file_parh)
    {
        //global $pdo;
        if (empty($file_parh)) {
            $file_parh = 'NULL';
        }
        if (empty($tag)) {
            $tag = 'NULL';
        }

        $query = $this->data->prepare('INSERT INTO changers (full_name,`username`,phone_number,password,work, `user_image`) VALUES ( ?, ?,?,?,?,?)');
        $query->bindValue(1, $name);
        $query->bindValue(2, $username);
        $query->bindValue(3, $phone);
        $query->bindValue(4, $pass);
        $query->bindValue(5, $work);
        $query->bindValue(6, $file_parh);
        $query->execute();
        header('Location:login.php');
    }


    /**
     * reply
     * function to handle the reply system
     *  accept the story id, the name of the replier, the post and the image
     * @param  mixed $storyId
     * @param  mixed $rname
     * @param  mixed $post
     * @param  mixed $file_parh
     * @return void
     */
    public function reply($storyId, $rname, $post, $file_parh)
    {
        //global $pdo;
        if (empty($file_parh)) {
            $file_parh = 'NULL';
        }


        $query = $this->data->prepare('INSERT INTO replies(story_id,`rname`,post,`r_image`) VALUES ( ?, ?,?,?)');
        $query->bindValue(1, $storyId);
        $query->bindValue(2, $rname);
        $query->bindValue(3, $post);

        $query->bindValue(4, $file_parh);
        $query->execute();
        header("location:trying.php");
    }


    /**
     * add_post
     * want to add post to the database
     * accept tag, title and story as parameter
     * @param  mixed $tag
     * @param  mixed $title
     * @param  mixed $story
     * @return void
     */
    public function add_post($tag, $title, $story)
    {
        //global $pdo;

        if (empty($tag)) {
            $tag = 'NULL';
        }

        $query = $this->data->prepare('INSERT INTO `stories` (user_id,title,story_cont) VALUES ( ?,?,?)');

        $query->bindValue(1, $tag);
        $query->bindValue(2, $title);
        $query->bindValue(3, $story);
        $query->execute();
        //header('Location: ../index.php');
    }



    /**
     * add_comment
     * want to add commet to a post
     * accept post id and comment as parameter
     * @param  mixed $post_id
     * @param  mixed $comments
     * @return void
     */
    public function add_comment($post_id, $comments)
    {
        //global $pdo;


        $query = $this->data->prepare('INSERT INTO `comments` (post_id,`comment`) VALUES ( ?, ?)');
        $query->bindValue(1, $post_id);
        $query->bindValue(2, $comments);

        $query->execute();
        header('Location: comments.php');
    }
    /**
     * user_data
     * query to get user details
     * accept user id as parameter
     * @param  mixed $user_id
     * @return void
     */
    public function user_data($user_id)
    {
        //global $pdo;
        $query = $this->data->prepare('SELECT * FROM changers   WHERE change_users = ?');
        $query->bindvalue(1, $user_id);
        $query->execute();

        return $query->fetch();
    }


    /**
     * timeAgo
     * this format time to time ago
     * @param  mixed $time_ago
     * @return void
     */
    public function timeAgo($time_ago)
    {

        $time_ago = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed;
        $minutes    = round($time_elapsed / 60);
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400);
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640);
        $years      = round($time_elapsed / 31207680);
        // Seconds
        if ($seconds <= 60) {
            return "just now";
        }
        //Minutes
        else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "one minute ago";
            } else {
                return "$minutes minutes ago";
            }
        }
        //Hours
        else if ($hours <= 24) {
            if ($hours == 1) {
                return "an hour ago";
            } else {
                return "$hours hrs ago";
            }
        }
        //Days
        else if ($days <= 7) {
            if ($days == 1) {
                return "yesterday";
            } else {
                return "$days days ago";
            }
        }
        //Weeks
        else if ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "a week ago";
            } else {
                return "$weeks weeks ago";
            }
        }
        //Months
        else if ($months <= 12) {
            if ($months == 1) {
                return "a month ago";
            } else {
                return "$months months ago";
            }
        }
        //Years
        else {
            if ($years == 1) {
                return "one year ago";
            } else {
                return "$years years ago";
            }
        }
    }


    /**
     * getip
     * this get ip address of the user
     * @return void
     */
    public function getip()
    {
        function validip($ip)
        {
            if (!empty($ip) && ip2long($ip) != -1) {
                $reserved_ips = array(
                    array('0.0.0.0', '2.255.255.255'),
                    array('10.0.0.0', '10.255.255.255'),
                    array('127.0.0.0', '127.255.255.255'),
                    array('169.254.0.0', '169.254.255.255'),
                    array('172.16.0.0', '172.31.255.255'),
                    array('192.0.2.0', '192.0.2.255'),
                    array('192.168.0.0', '192.168.255.255'),
                    array('255.255.255.0', '255.255.255.255')
                );

                foreach ($reserved_ips as $r) {
                    $min = ip2long($r[0]);
                    $max = ip2long($r[1]);
                    if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
                }

                return true;
            } else {
                return false;
            }
        }
        if (validip($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        }

        foreach (explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
            if (validip(trim($ip))) {
                return $ip;
            }
        }

        if (validip($_SERVER["HTTP_PC_REMOTE_ADDR"])) {
            return $_SERVER["HTTP_PC_REMOTE_ADDR"];
        } elseif (validip($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (validip($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (validip($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } else {
            return $_SERVER["REMOTE_ADDR"];
        }
    }


    /**
     * getToken
     * this generate token
     * @param  mixed $length
     * @return void
     */
    public function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet);

        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }

        return $token;
    }

    /**
     * filter
     * this filter array input
     * @param  mixed $array
     * @return void
     */
    public function filter(&$array)
    {
        $clean = array();
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                filter($value);
            } else {
                $value = trim(strip_tags($value));
                if (get_magic_quotes_gpc()) {
                    $data = stripslashes($value);
                }
                $data = htmlspecialchars($value);
            }
        }
    }
}
//require_once 'classes/likes.php';
