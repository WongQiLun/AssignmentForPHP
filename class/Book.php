<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Book
 *
 * @author user
 */
class Book {
    //put your code 
    private $bookID;
    private $bookName;
    private $bookAuthor;
    private $yearOfPublishing;
    private $status;
    private $description;
    private $location;
    
    function getBookID() {
        return $this->bookID;
    }

    function getBookName() {
        return $this->bookName;
    }

    function getBookAuthor() {
        return $this->bookAuthor;
    }

    function getYearOfPublishing() {
        return $this->yearOfPublishing;
    }

    function getStatus() {
        return $this->status;
    }

    function getDescription() {
        return $this->description;
    }

    function getLocation() {
        return $this->location;
    }

    function setBookID($bookID): void {
        $this->bookID = $bookID;
    }

    function setBookName($bookName): void {
        $this->bookName = $bookName;
    }

    function setBookAuthor($bookAuthor): void {
        $this->bookAuthor = $bookAuthor;
    }

    function setYearOfPublishing($yearOfPublishing): void {
        $this->yearOfPublishing = $yearOfPublishing;
    }

    function setStatus($status): void {
        $this->status = $status;
    }

    function setDescription($description): void {
        $this->description = $description;
    }

    function setLocation($location): void {
        $this->location = $location;
    }


}
