<?php
require_once 'Users.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Staff
 *
 * @author user
 */
class Staff extends Users{
    private $staffID;
    private $staffName;
    function getStaffID() {
        return $this->staffID;
    }

    function getStaffName() {
        return $this->staffName;
    }

    function setStaffID($staffID): void {
        $this->staffID = $staffID;
    }

    function setStaffName($staffName): void {
        $this->staffName = $staffName;
    }


}
