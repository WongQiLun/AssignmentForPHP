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
        return $this->dateOfReturn;
    }

    function getOverdueFee() {
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
    function retrieveRental(){
        
    }
    function retrieveDueDate() {//toDO
    }

    function calculateOverdueFees() {//toDo
    }

    function returnBook() {
        $this->setDateOfReturn(date("Y-m-d"));
        $dayOfReturn = strtotime($this->$dateOfReturn);
        $duedate = strtotime($this->retrieveDueDate());
        $this->daysOverdue = $dayOfReturn - $duedate;
        if ($this->daysOverdue >= 1) {
            $this->calculateOverdueFees();
        }
    }

}
