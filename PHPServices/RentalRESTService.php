<?php

header("Content-Type:application/json");
require_once '../class/Rental.php';
require_once '../SecurityClasses/DatabaseConnection.php';
if (!empty($_GET['bookID']) && !empty($_GET['staffID']) && !empty($_GET['userID'])) {
    $bookID = $_GET['bookID'];
    $staffID = $_GET['rate'];
   $userID = $_GET['userID'];

    $db = DatabaseConnection::getInstance();
    $rental= $db->AddRental($userID, $staffID, $bookID) ;
    if (empty($rental)) {
        response(200,"ERROR",null);
    } else {
        $DateOfRental =$rental->getDateOfRental();
        $dueDate =$rental->getDuedate();
        
        response (200,$DateOfRental,$dueDate);
    }
    
}else
{
    response(400,"Invalid Request",NULL);
}

function response( $status,$DateOfRental,$dueDate){
    header("HTTP/1.1".$status);
    $response['status']=$status;
    $response['dateRented']=$DateOfRental;
    $response['dueDate']=$dueDate;
    $json_response= json_encode($response);
    echo $json_response;
}