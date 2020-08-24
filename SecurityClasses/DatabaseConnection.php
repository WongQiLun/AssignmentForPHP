<?php

require_once '../class/Users.php';
require_once '../class/Staff.php';
require_once '../class/Rental.php';
require_once '../class/Book.php';

//author :Wong Qi Lun, See E Jet
class DatabaseConnection {

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

    public function addUsers($username, $passwd, $phone, $address) {
        $query = " INSERT INTO `user`(`userName`, `userAddr`, `phoneNumber`, `userPassword`)"
                . " VALUES (?,?,?,?)";
//i have no idea why this is but if you remove this the pdo is null despite you already establishing it elsewhere :)
        $host = 'localhost';
        $dbName = 'assignment_db';
        $dbuser = 'root';
        $dbpassword = '';

// set up DSN
        $dsn = "mysql:host=$host;dbname=$dbName";


        $this->db = new PDO($dsn, $dbuser, $dbpassword);
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $address, PDO::PARAM_STR);
        $stmt->bindParam(3, $phone, PDO::PARAM_STR);
        $stmt->bindParam(4, $passwd, PDO::PARAM_STR);
        $stmt->execute();

        $this->closeConnection();
//use Sha1 for the password
    }

    public function addStaff($userID, $staffName) {
        
    }

    function AddRental($userID, $staffID, $bookID) {

//create rental item first due to the items 
        $rental = new Rental($userID, $staffID, $bookID);
        $query = "INSERT INTO `rental`( `dateOfRental`, `dueDate`, `userID`, `staffID`, `bookID`)"
                . " VALUES (?,?,?,?,?)";

        $stmt = $this->db->prepare($query);

        $date = $rental->getDateOfRental();
        $date2 = $rental->getDuedate();

        $stmt->bindParam(1, $date, PDO::PARAM_STR);
        $stmt->bindParam(2, $date2, PDO::PARAM_STR);
        $stmt->bindParam(3, $userID, PDO::PARAM_STR);
        $stmt->bindParam(4, $staffID, PDO::PARAM_STR);
        $stmt->bindParam(5, $bookID, PDO::PARAM_STR);


        $stmt->execute();

        $last_id = $this->db->lastInsertId();

        $rental->setRentalID($last_id);
        $this->rentBook($bookID);
        return $rental;
    }

    function rentBook($bookID) {
        $query = "Update `book` SET `status`=\"Rented\" WHERE bookID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $bookID, PDO::PARAM_STR);

        $stmt->execute();
    }

    function retrieveRental($rentalID) {
        $query = "SELECT * FROM `rental` WHERE rentalID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $rentalID, PDO::PARAM_STR);
        $stmt->execute();

        $totalrows = $stmt->rowCount();
        if ($totalrows == 0) {
            return null;
        } else {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Rental($result['dateOfRental'], $result['dueDate'], $result['userID'], $result['staffID'], $result['bookID']);
        }
    }

    function addReturn($staffID, $rentalID) {

        $return = new Returns($staffID, $rentalID);
        $query = "INSERT INTO `bookReturn`( `dateOfReturn`, `daysOverdue`, `overdueFee`, `returnID`, `rentalID`, `staffID`)"
                . " VALUES (?,?,?,?,?)";

        $rental = $db->retrieveRental($rentalID);
        $return->returnBook($rental);

        $stmt = $this->db->prepare($query);
        $date = $return->getDateOfReturn();
        $date2 = $return->getDaysOverdue();
        $overdue = $return->getOverdueFee();

        $last_id = $this->db->lastInsertId();
        $return->setReturnID($last_id);


        $stmt->bindParam(1, $date, PDO::PARAM_STR);
        $stmt->bindParam(2, $date2, PDO::PARAM_STR);
        $stmt->bindParam(3, $overdue, PDO::PARAM_STR);
        $stmt->bindParam(4, $return->getReturnID(), PDO::PARAM_STR);
        $stmt->bindParam(5, $rentalID, PDO::PARAM_STR);
        $stmt->bindParam(6, $staffID, PDO::PARAM_STR);


        $stmt->execute();

        $bookID = $rental->getbookID();
        $this->returnBook(bookID);
        return $return;
    }

    function returnBook($bookID) {
        $query = "Update `book` SET `status`=\"Available\" WHERE bookID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $bookID, PDO::PARAM_STR);

        $stmt->execute();
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

    public function retrieveBook($bookID) {
        $query = "SELECT * FROM book WHERE bookID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $bookID, PDO::PARAM_STR);

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

    public function retrieveStaffWithStaffID($staffID) {
        $query = "SELECT * FROM staff WHERE staffID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $staffID, PDO::PARAM_STR);

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

    public function createBookXMLFile() {
        $query = "SELECT * FROM `book` WHERE 1";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $booksArray = $stmt->fetchAll();
        /* fetch associative array */

        if (count($booksArray) > 0) {
            $this->createXMLfile($booksArray);
        }
        /* free result set */
    }

    /* close connection */

    function createXMLfile($booksArray) {
        $filePath = '../xmlFiles/books.xml';
        $dom = new DOMDocument('1.0', 'utf-8');
        //creating an xslt adding processing line
        $xslt = $dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="books.xsl"');

//adding it to the xml
        $dom->appendChild($xslt);
        $root = $dom->createElement('books');

        for ($i = 0; $i < count($booksArray); $i++) {

            $bookId = $booksArray[$i]['bookID'];
            $bookName = htmlspecialchars($booksArray[$i]['bookName']);
            $bookAuthor = $booksArray[$i]['bookAuthor'];
            $bookYearOfPub = $booksArray[$i]['yearOfPub'];
            $bookStatus = $booksArray[$i]['status'];
            $bookDescription = $booksArray[$i]['description'];
            $bookLocation = $booksArray[$i]['location'];
            $book = $dom->createElement('book');

            $book->setAttribute('bookID', $bookId);
            $name = $dom->createElement('title', $bookName);
            $book->appendChild($name);
            $author = $dom->createElement('author', $bookAuthor);
            $book->appendChild($author);
            $yearOfPub = $dom->createElement('yearOfPub', $bookYearOfPub);
            $book->appendChild($yearOfPub);
            $status = $dom->createElement('status', $bookStatus);
            $book->appendChild($status);

            $description = $dom->createElement('description', $bookDescription);
            $book->appendChild($description);

            $location = $dom->createElement('location', $bookLocation);
            $book->appendChild($location);

            $root->appendChild($book);
        }
        $dom->appendChild($root);
        $dom->save($filePath);
    }

    function createRentXMLFile() { //fetch all rental from database
        $query = "SELECT * FROM `rental` WHERE 1";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $rentalArray = $stmt->fetchAll();

        if (count($rentalArray) > 0) {
            $this->createSAXXMLfile($rentalArray);
        }
    }

    function createSAXXMLfile() {
        $filename = '../xmlFiles/rental.xml';
        $rentalXML = new SAXParser($filename);
    }

}
