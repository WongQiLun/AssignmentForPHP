<?php
require_once '../class/Users.php';
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
            return new Users($result['userID'],$result['userName'],$result['userAddr'],$result['phoneNumber']);
        }
    }
    public function checkUserName($username){
         $query = "SELECT * FROM user WHERE userName = ? ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->execute();

        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return false;
        }
    }
    public function addUser($username, $passwd){
        //use Sha1 for the password
    }
}
