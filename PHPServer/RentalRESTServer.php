<?php

header("Content-Type:application/json");
require_once 'Loan.php';
if (!empty($_GET['amount']) && !empty($_GET['rate']) && !empty($_GET['duration'])) {
    $amount = $_GET['amount'];
    $rate = $_GET['rate'];
    $duration = $_GET['duration'];
    $loan = new Loan($rate, $duration, $amount);
    if (empty($loan)) {
        response(200,"ERROR",null);
    } else {
        $monthlyPayment =$loan->getMonthlyPayment();
        $totalPayment =$loan->getTotalPayment();
        response (200,$monthlyPayment,$totalPayment);
    }
    
}else
{
    response(400,"Invalid Request",NULL);
}

function response( $status,$monthlyPayment,$totalPayment){
    header("HTTP/1.1".$status);
    $response['status']=$status;
    $response['monthlyPayment']=$monthlyPayment;
    $response['totalPayment']=$totalPayment;
    $json_response= json_encode($response);
    echo $json_response;
}