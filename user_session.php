<?php

class user_session {

    private $logged_in_user = false;
    public $user_id;

    function __construct() {

        session_start();
        $this->check_login();

        if($this->logged_in_user) {

            // actions to take right away if user is logged in

        } else {

            echo("$this->logged_in_user");
           header("Location: http://localhost/facebook/facebook_sign_out.php?");

        }
    }

    public function is_logged_in() {

        return $this->logged_in_user;
    }



    public function login($user) {

        // database should find user based on username/password
        if($user){
            $this->user_id = $_SESSION['id'] = $user['id'];
            $this->logged_in_user = true;
        }


    }

    public function logout() {
        unset($_SESSION['id']);
        unset($this->user_id);
        $this->logged_in_user = false;
    }

    private function check_login() {
        if(isset($_SESSION['id'])) {
            $this->user_id = $_SESSION['id'];
            $this->logged_in_user = true;
        } else {
            unset($this->user_id);
            $this->logged_in_user = false;
        }
    }

}

$user_session = new user_Session();

?>
