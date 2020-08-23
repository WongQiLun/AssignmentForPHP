<?php

class AccessControl {
    static public function checkUser(){
       session_start();
       if(empty($_SESSION['user'])){
           header("Location : login.php");
       }
    }

    static public function LoadStaffControl() {
        session_start();

        if (!empty($_SESSION['staffID'])) {
            echo " <input type='button' value='addNewBook' "
            . "onClick=\"document.location.href = 'AddNewBook.php'\" />"
            ;
                        echo " <input type='button' value='UserList' "
            . "onClick=\"document.location.href = 'UserList.php'\" />"
            ;
        }
    }

}
