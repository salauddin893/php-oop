<?php

class Session {


    private $singed_in = false;
    public $user_id;
    public $message;

    function __construct() {

        session_start();

        $this->check_the_login();
        $this->check_message();

    }

    public function message($mes = "") {
        if(!empty($mes)) {
            $_SESSION['message'] = $mes;
        }else{
            return $this->message;
        }
    }

    private function check_message() {
        if(isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }else{
            return $this->message = "";
        }
    }

    public function is_sing_in() {

        return $this->singed_in;

    }



    public function login($user) {

            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->singed_in = true;
        

    }



    public function logout() {
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->singed_in = false;
    }



    private function check_the_login() {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->singed_in = true;
        }
    }


}


$session = new Session();




?>