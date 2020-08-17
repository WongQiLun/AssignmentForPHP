<?php

require_once 'DatabaseConnection.php';

class Authentication {

    //put your code here
    function AuthenticateUser($username, $password) {
        $query = "SELECT * FROM user WHERE username = ? AND passwd = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $passwd, PDO::PARAM_STR);
        $stmt->execute();
        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return null;
        } else {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);     
            return $username;
        }
    }

}
