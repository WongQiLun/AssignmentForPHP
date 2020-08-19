<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inputValidation
 *
 * @author user
 */
class inputValidation {

    function stringEquals($input1, $input2) {
        if (strcmp($input1, $input2) == 0) {
            return true;
        } else
            return false;
    }

    public function duplicateUsernameCheck($username) {
        //if true duplicates are found
        //todo write sql
        
        return !DatabaseConnection::checkUserName($username);
    }

    function lengthCheck($input, $desiredLength) {
        
    }

     public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
