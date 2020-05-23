<?php

class User {

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    public static function find_all_users() {
        return self::find_this_query("SELECT * FROM users");
    }


    public static function find_user_by_id($user_id) {
        global $database;

        $tehe_result_array = self::find_this_query("SELECT * FROM users WHERE id = $user_id ");
        
        return !empty($tehe_result_array) ? array_shift($tehe_result_array) : false;

    }

    public static function find_this_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = self::instantion($row);
        }

        return $the_object_array;
    }

    public static function instantion($the_recode) {

        $the_opjact = new self;

        foreach($the_recode as $the_attribute => $value) {

            if($the_opjact->has_the_attribute($the_attribute)) {
                $the_opjact->$the_attribute = $value;
            }

        }

        return $the_opjact;
    }


    private function has_the_attribute($the_attribute) {
       $opjact_propertige = get_object_vars($this);

       return array_key_exists($the_attribute, $opjact_propertige);
    }



}



?>