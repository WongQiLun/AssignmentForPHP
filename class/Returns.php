<?php
require_once 'Rental.php';
class Returns {

    private $dateOfReturn;
    private $daysOverdue;
    private $overdueFee;
    private $returnID;
    private $rentalID;
    private $staffID;
    function __construct($dateOfReturn, $daysOverdue, $overdueFee, $returnID, $rentalID) {
        $this->dateOfReturn = $dateOfReturn;
        $this->daysOverdue = $daysOverdue;
        $this->overdueFee = $overdueFee;
        $this->returnID = $returnID;
        $this->rentalID = $rentalID;
    }

    function getDaysOverdue() {
        return $this->daysOverdue;
    }

    function getRentalID() {
        return $this->rentalID;
    }

    function setDaysOverdue($daysOverdue): void {
        $this->daysOverdue = $daysOverdue;
    }

    function setRentalID($rentalID): void {
        $this->rentalID = $rentalID;
    }

    function getDateOfReturn() {
        if ($this->dateOfRental == null){
            $this->dateOfRental = new date("Y-m-d");
        }
        return $this->dateOfReturn;
    }

    function getOverdueFee() {
        if (overdueFee == null){
            $this->overdueFee = 0;
        }
        return $this->overdueFee;
    }

    function getReturnID() {
        return $this->returnID;
    }

    function setDateOfReturn($dateOfReturn): void {
        $this->dateOfReturn = $dateOfReturn;
    }

    function setOverdueFee($overdueFee): void {
        $this->overdueFee = $overdueFee;
    }

    function setReturnID($returnID): void {
        $this->returnID = $returnID;
    }
    function retrieveRental(){  //declared on DatabaseConnection.php        
    }
    
    function retrieveDueDate($rental) {//retrieve dueDate based on the rental that is putted into the parameter
        $rental = new Rental();
        $this->$rental = $rental;
        return $this->$rental->getDuedate();
    }

    function calculateOverdueFees($daysOverdue) {//toDo
        $rate = 2;
        $this->overdueFee = $rate * $this->daysOverdue;
    }

    function returnBook($rental) {
        $this->setDateOfReturn(date("Y-m-d"));
        $dayOfReturn = strtotime($this->$dateOfReturn);
        $duedate = strtotime($this->retrieveDueDate($rental));
        $this->daysOverdue = $dayOfReturn - $duedate;
        if ($this->daysOverdue >= 1) {
            $this->calculateOverdueFees($this->daysOverdue);
        }
        // insert into database
    }

}
