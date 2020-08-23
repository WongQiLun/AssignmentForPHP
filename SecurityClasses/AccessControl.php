<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccessControl
 *
 * @author user
 */
class AccessControl {

    static public function LoadStaffControl() {
        session_start();

        if (!empty($_SESSION['staffID'])) {
            echo " <input type=`button` value=`addNewBook` "
            . "onClick=`document.location.href = 'return.php'` />"
            ;
        }
    }

}
