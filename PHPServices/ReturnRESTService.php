<?php

header("Content-Type:application/json");
require_once '../class/Return.php';
require_once '../SecurityClasses/DatabaseConnection.php';

if (!empty($_GET['rentalID']) && !empty($_GET['staffID']) && !empty($_GET['userID'])) {
    $bookID = $_GET['rentalID'];
    $staffID = $_GET['staffID'];
    $userID = $_GET['userID'];
//    $rentalID= 1;
//    $staffID=1;
//    $userID=1;
    $db = DatabaseConnection::getInstance();    
    //fetch info about rental and create return
    $rental = $db->retrieveRental($rentalID);
    $return = $db->AddReturn($staffID, $rentalID);
    $db->createRentXMLFile();
    $db->closeConnection();
    if (empty($return)) {
        response(200,"ERROR",null);
    } else {
        $DateOfReturn = $return ->getDateOfReturn();
        $overdueFee = $return ->getOverdueFee();
        $daysOverdue = $return ->getDaysOverdue();
        
        if ($overdueFee <= 0){
            $overdueFee = 0;
            $daysOverdue = 0;
        }response (200,$DateOfReturn,$overdueFee, $daysOverdue);        
    }
    
}else
{
    response(400,"Invalid Request",NULL);
}

function response( $status,$DateOfReturn,$overdueFee, $daysOverdue){
    header("HTTP/1.1".$status);
    $response['status']=$status;
    $response['dateReturned']=$DateOfReturn;
    $response['overdueFee']=$overdueFee;
    $response['daysOverdue']=$daysOverdue;
    
    
    
    $json_response= json_encode($response);
    echo $json_response;
}

