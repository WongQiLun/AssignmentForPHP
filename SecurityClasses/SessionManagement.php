<?php

class SessionManagement {

    static public function Logout() {
        session_start();
        session_destroy();
        header('Location: login.php');
        exit;
    }

}
