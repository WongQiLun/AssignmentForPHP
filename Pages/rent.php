<?php
require_once 'Loan.php';
?>
<h2> Loan Web Service Client
</h2>
<form method = "post">
    <p>
        Loan amount :RM<input type="text" name = "amount" value="" size ="15"/><br/>
        Annual Interest Rate :RM<input type="text" name = "rate" value="" size ="15"/><br/>
        Duration : (years)<input type="text" name = "duration" value="" size ="15"/><br/>
    </p>
    <input type="submit" value="Submit" name="submit"/>
</form>
<?php
if (isset($_POST['submit'])) {
    $amount = $_POST['amount'];
    $rate = $_POST['rate'];
    $duration = $_POST['duration'];
    $url = "http://localhost/practical5/LoanRESTService.php?rate=" . $rate .
            "&duration=" . $duration . "&amount=" . $amount;
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response);

    echo "<p><h3>Monthly Payment: RM" . number_format($result->monthlyPayment, 2) . "</h3></p>";
    echo "<p><h3>Total Payment: RM" . number_format($result->totalPayment, 2) . "</h3></p>";
}
