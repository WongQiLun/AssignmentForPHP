<?php

require_once 'Users.php';
require_once 'userDecorator.php';
//author :Wong Qi Lun
class Staff extends userDecorator {

    private $staffID;
    private $staffName;

    function __construct($staffID, $staffName, $userID, $userName, $userAddr, $phoneNumber) {
        $this->staffID = $staffID;
        $this->staffName = $staffName;

        parent::__construct(new Users($userID, $userName, $userAddr, $phoneNumber));
    }

    function castParent($staffID, $staffName, $parentclass) {
        try {
            parent::__construct($parentclass);

            $this->staffID = $staffID;
            $this->staffName = $staffName;
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

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
