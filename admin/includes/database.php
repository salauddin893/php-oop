
<?php

require_once("config.php");

class Database {

    public $connection;

    public function __construct() {
        $this->open_db_connection();
    }


    public function open_db_connection() {

        // $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($this->connection->connect_errno){
            die("Database connection failed" . $this->connection->connect_error);
        }

    }

    public function query($sql) {
        $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;
    }

    private function confirm_query($result) {
        if(!$result) {
            die("QUERY FAILED" . $this->connection->error);
        }
    }

    private function escape_string($strings) {
        $escape_string = $this->connection->real_escape_string($strings);
        return $escape_string;
    }

    private function insert_id() {
        return $this->connection->insert_id;
    }
    

}


$database = new Database();


?>