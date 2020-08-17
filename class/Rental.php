<?php

class Rental {
    private $rentalID;
    private $dateOfRental;
    private $duedate;
    private $staffID;
    private $bookID;
    function getBookID() {
        return $this->bookID;
    }

    function setBookID($bookID): void {
        $this->bookID = $bookID;
    }

        function getRentalID() {
        return $this->rentalID;
    }

    function getDateOfRental() {
        return $this->dateOfRental;
    }

    function getDuedate() {
        return $this->duedate;
    }

    function getStaffID() {
        return $this->staffID;
    }

    function setRentalID($rentalID): void {
        $this->rentalID = $rentalID;
    }

    function setDateOfRental($dateOfRental): void {
        $this->dateOfRental = $dateOfRental;
    }

    function setDuedate($duedate): void {
        $this->duedate = $duedate;
    }

    function setStaffID($staffID): void {
        $this->staffID = $staffID;
    }

    function __construct($staffID,$bookID){
        $this->setStaffID($staffID) ;
        $this->setbookID($bookID);
        $this->setDateOfRental(date("Y-m-d"));
        $this->setDuedate($this->calculateDuedate());
        //rental ID is incremented
        //todo : addinto  database
        //todo : make xml into printable ticket
    }
    
   function calculateDuedate(){
       $date=   new DateTime(   $this->getDateOfRental());
       $date->add(new DateInterval('P14D'));
       return $date->format('Y-m-d');
      
   }
   
}
