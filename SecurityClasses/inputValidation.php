<?php
require_once 'DatabaseConnection.php';

class inputValidation {


    static public function duplicateUsernameCheck($username) {
        //if true duplicates are found
        //todo write sql
        $db = DatabaseConnection::getInstance();
        $bool = !($db->checkUserName($username));
        $db->closeConnection();
        return $bool ;
    }

    static function lengthCheck($data, $desiredLength) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        if(strlen($data)>= $desiredLength){
            return false;
        }
        return true;
    }

    static public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
