<?php

class Rental {
    private $rentalID;
    private $dateOfRental;
    private $duedate;
    private $staffID;
    
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

   function calculateDuedate (){
       $this->setDuedate(new DateTime('d-m-Y',$this->dateOfRental."+ 7 days"));
   }
   
}
