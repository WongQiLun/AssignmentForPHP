<?php
require_once '../class/Return.php';
?>
<h2>Book Return Web Service Client</h2>
<form method="post">
    <p>
        Rental ID:<input type="text" name="rentalID" value="" /><br/>
        Staff ID:<input type="text" name="staffID" value="" /><br/>        
    </p>
    <input type="submit" value="Return" name="submit" />   
</form>


<?php
if (isset($_POST['submit'])){
    $rentalID = $_POST['rentalID'];
    $staffID = $_POST['staffID'];
    $userID = 1; //placeholder, session management is not working
    
    $url= "http://localhost/AssignmentforPHP/PHPServices/ReturnRESTService.php?rentalID=" . $rentalID .
            "&staffID=" . $staffID . "&userID=" . $userID;
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($client);
    $result = json_decode($response);
    
    echo "<p><h3>Date Returned :" .$result->dateReturned. "</h3></p>";
    echo "<p><h3>Days of overdue :" . $result-> daysOverdue. "</h3></p>";
    echo "<p><h3>Penalty for overdue :" . $result-> overdueFee. "</h3></p>";
}
