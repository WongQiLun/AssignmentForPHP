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
    private $overdate;
    private $overdueFee;
    private $returnID;
    
    function getDateOfReturn() {
        return $this->dateOfReturn;
    }

    function getOverdate() {
        return $this->overdate;
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

    function setOverdate($overdate): void {
        $this->overdate = $overdate;
    }

    function setOverdueFee($overdueFee): void {
        $this->overdueFee = $overdueFee;
    }

    function setReturnID($returnID): void {
        $this->returnID = $returnID;
    }


}
