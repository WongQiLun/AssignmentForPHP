<?php
//Author : Wong Qi Lun

header("Content-Type:application/json");
require_once '../class/Rental.php';
require_once '../SecurityClasses/DatabaseConnection.php';
if (!empty($_GET['bookID']) && !empty($_GET['staffID']) && !empty($_GET['userID'])) {
    $bookID = $_GET['bookID'];
    $staffID = $_GET['staffID'];
   $userID = $_GET['userID'];

    $db = DatabaseConnection::getInstance();
    $rental= $db->AddRental($userID, $staffID, $bookID) ;
    $staff=$db->retrieveStaffWithStaffID($staffID);
    $book=$db->retrieveBook($bookID);
    $db-> createBookXMLFile() ;
    $db->closeConnection();
    $staffName="";
    $bookName="";
    
    if (is_null($staff)){
        $staffName= "notSpecified";
    }else{
    $staffName =$staff['staffName'];
    }
        if (is_null($book)){
        $bookName = "not specified";
    }else{
    $bookName=$book['bookName'];
    }
    if (empty($rental)) {
        response(200,"ERROR","NotSpecified","NotSpecified","NotSpecified");
    } else {
        $DateOfRental =$rental->getDateOfRental();
        $dueDate =$rental->getDuedate();
        
        response (200,$DateOfRental,$dueDate,$staffName,$bookName);
    }
    
}else
{
    response(400,"Invalid Request",NULL);
}

function response( $status,$DateOfRental,$dueDate,$staffName,$bookName){
    header("HTTP/1.1".$status);
    $response['status']=$status;
    $response['dateRented']=$DateOfRental;
    $response['dueDate']=$dueDate;
    $response['bookName']=$bookName;
    $response['staffName']=$staffName;
    
    $json_response= json_encode($response);
    echo $json_response;
}