<?php
require_once 'DatabaseConnection.php';
class SessionManagement {
//author :Wong Qi Lun
    static public function Logout() {
        session_start();
        session_destroy();
        header('Location: login.php');
        exit;
    }

   static public function login($user) {
       session_start();
        session_destroy();
        session_start();
       $_SESSION['user'] = serialize($user);
       $db = DatabaseConnection::getInstance();

       $staff =$db->retrieveStaff($user->getUserID());
       if (!empty($staff) ){
           $_SESSION['staffID'] = $staff['staffID'];
       }
       $db->closeConnection();
   }
}
