<?php

require_once '../class/Users.php';
require_once '../class/Staff.php';
require_once '../class/Rental.php';
require_once '../class/Book.php';

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

    public function retrieveUser($username, $passwd) {
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
            return new Users($result['userID'], $result['userName'], $result['userAddr'], $result['phoneNumber']);
        }
    }

    public function checkUserName($username) {
        $query = "SELECT * FROM user WHERE userName = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();

        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
            //false meaning it doesnt exist
        }
    }

    public function addUser($username, $passwd, $phone, $address) {
        $query = "INSERT INTO user ( `userName`, `userAddr`, `phoneNumber`, `userPassword`)VALUES (?,?,?,?) ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $phone, PDO::PARAM_STR);
        $stmt->bindParam(3, $address, PDO::PARAM_STR);
        $stmt->bindParam(4, $password, PDO::PARAM_STR);
        $stmt->execute();
        //use Sha1 for the password
    }

    public function addStaff($userID, $staffName) {
        
    }

    function AddRental($userID, $staffID, $bookID) {

        //create rental item first due to the items 
        $rental = new Rental($userID, $staffID, $bookID);
        $query = "INSERT INTO `rental`( `dateOfRental`, `dueDate`, `userID`, `staffID`, `bookID`)"
                ." VALUES (?,?,?,?,?)";

        $stmt = $this->db->prepare($query);
        
        $date=$rental->getDateOfRental();
        $date2=$rental->getDuedate();
        
        $stmt->bindParam(1, $date, PDO::PARAM_STR);
        $stmt->bindParam(2, $date2, PDO::PARAM_STR);
        $stmt->bindParam(3, $userID, PDO::PARAM_STR);
        $stmt->bindParam(4, $staffID, PDO::PARAM_STR);
        $stmt->bindParam(5, $bookID, PDO::PARAM_STR);
        
     
        $stmt->execute();
        
        $last_id = $this->db->lastInsertId();
        
        $rental->setRentalID($last_id);
        
        return $rental;
    }

    public function retrieveStaff($userID) {
        $query = "SELECT * FROM staff WHERE userID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $userID, PDO::PARAM_STR);

        $stmt->execute();

        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return null;
        } else {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
            //returns array only for now
        }
    }

}
