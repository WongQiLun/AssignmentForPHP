<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Returns
 *
 * @author user
 */
class Returns {

    private $dateOfReturn;
    private $daysOverdue;
    private $overdueFee;
    private $returnID;
    private $rentalID;

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

    function retrieveDueDate() {//toDO
    }

    function calculateOverdueFees() {//toDo
    }

    function returnBook() {
        $this->setDateOfReturn(date("d/m/Y"));
        $dayOfReturn = strtotime($this->$dateOfReturn);
        $duedate = strtotime($this->retrieveDueDate());
        $this->daysOverdue = $dayOfReturn - $duedate;
        if ($this->daysOverdue >= 1) {
            $this->calculateOverdueFees();
        }
    }

}
