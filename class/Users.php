<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 *
 * @author user
 */
class Users {

    private $userID;
    private $userName;
    private $userAddr;
    private $phoneNumber;
    private $password;
    public function getUserID() {
        return $this->userID;
    }
    function __construct($userID, $userName, $userAddr, $phoneNumber) {
        $this->userID = $userID;
        $this->userName = $userName;
        $this->userAddr = $userAddr;
        $this->phoneNumber = $phoneNumber;
        
    }

    function getUserName() {
        return $this->userName;
    }

    function getUserAddr() {
        return $this->userAddr;
    }

    function getPhoneNumber() {
        return $this->phoneNumber;
    }

        public function __serialize(): array {
        return [
            'userID' => $this->userID,
            'userName' => $this->userName,
            'pass' => $this->password,
            'userAddr' => $this->userAddr,
            'phone' => $this->phoneNumber,
        ];
    }

    public function __unserialize(array $data): void {
        $this->userID = $data['userID'];
        $this->userName = $data['userName'];
        $this->password = $data['pass'];
        $this->userAddr = $data['userAddr'];
        $this->phoneNumber = $data['phone'];

        
    }

}
