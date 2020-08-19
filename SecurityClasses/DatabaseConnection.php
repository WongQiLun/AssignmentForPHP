<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatabaseConnection
 *
 * @author user
 */
class DatabaseConnection {

    //put your code here
    private static $instance = null;
    private $db;

    protected function __construct() {
        $host = 'localhost';
        $dbName = 'assignment_db';
        $dbuser = 'root';
        $dbpassword = '';

        // set up DSN
        $dsn = "mysql:host=$host;dbname=$dbName";

        try {
            $this->db = new PDO($dsn, $dbuser, $dbpassword);
            echo "<p>Connection to database successful</p>";
        } catch (PDOException $ex) {
            echo "<p>ERROR: " . $ex->getMessage() . "</p>";
            exit;
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }

    public function closeConnection() {
        $this->db = null;
    }
   public function retrieveUser($username, $passwd){
       $query = "SELECT * FROM user WHERE userName = ? AND userPassword = ?";
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
