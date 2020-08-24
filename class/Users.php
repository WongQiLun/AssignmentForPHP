<?php

//author :Wong Qi Lun
class Users {

    protected $userID;
    protected $userName;
    protected $userAddr;
    protected$phoneNumber;
    protected$password;
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
