<?php
require_once '../class/Rental.php';
?>
<h2> Book Rental Web Service Client
</h2>
<form method = "post">
    <p>
        Book ID:<input type="number" name = "bookID" value="" /><br/>
        Staff ID:<input type="number" name = "staffID" value="" /><br/>
    </p>
    <input type="submit" value="Remt" name="submit"/>
    <a href="../xmlFiles/books.xml" target="_blank">
        click me to see the catalog
    </a>
</form>

<?php
if (isset($_POST['submit'])) {
    $bookID= $_POST['bookID'];
    $staffID= $_POST['staffID'];
    //$user=  unserialize($_SESSION['user']);
    //$userID = $user->getUserID();
    $userID = 1;
    $url = "http://localhost/AssignmentforPHP/PHPServices/RentalRESTService.php?bookID=" . $bookID .
            "&staffID=" . $staffID . "&userID=" . $userID;
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($client);
    $result = json_decode($response);

    echo "<p><h3>Date Rented :" .$result->dateRented. "</h3></p>";
    echo "<p><h3>Date to return :" . $result-> dueDate. "</h3></p>";
}
// DOM PARSER HERE