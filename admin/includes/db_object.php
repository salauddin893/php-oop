<?php


class Db_object {

    protected static $db_table = 'users';

    public static function find_all() {
        return static::find_this_query("SELECT * FROM " . static::$db_table . " ");
    }


    public static function find_by_id($user_id) {
        global $database;

        $tehe_result_array = static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE id = $user_id ");
        
        return !empty($tehe_result_array) ? array_shift($tehe_result_array) : false;

    }


    public static function find_this_query($sql) {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantion($row);
        }

        return $the_object_array;
    }


    
    public static function instantion($the_recode) {

        $called_class = get_called_class();
        $the_opjact = new $called_class;

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

    protected function properties() {
        // return get_object_vars($this);
        $properties = array();
        foreach(static::$db_table_fields as $db_field) {
            if(property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    public function clean_propertise() {
        global $database;

        $clean_propertise = array();

        foreach($this->properties() as $key => $value) {
            $clean_propertise[$key] = $database->escape_string($value);
        }

        return $clean_propertise;

    }

    public function save() {
        return isset($this->id) ? $this->update() : $this->creat();
    }


    public function creat() {
        global $database;

        $properties = $this->clean_propertise();

        $sql = "INSERT INTO " . static::$db_table . " (" . implode(',', array_keys($properties)) . ") ";
        $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";

        if($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        }else{
            return false;
        }

    }

    public function update() {
        global $database;

        $properties = $this->clean_propertise();
        $properties_pairs = array();

        foreach($properties as $key => $value) {
            $properties_pairs[] = "{$key} = '{$value}'";
        }

        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= "WHERE id = " . $database->escape_string($this->id);

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public function delete() {
        global $database;

        $sql = "DELETE FROM " . static::$db_table . " ";
        $sql .= "WHERE id = " . $database->escape_string($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);

        return (mysqli_affected_rows() == 1) ? true : false;

    }




}





?>