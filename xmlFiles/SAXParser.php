<?php

require_once '../class/Users.php';
require_once '../class/Staff.php';
require_once '../class/Rental.php';
require_once '../class/Book.php';
require_once '../SecurityClasses/DatabaseConnection.php';
//author : See E Jet

class SAXParser {

    private $rentals; // list of rental
    private $filename;
    private $rentalTmp; // rental object
    private $tmpValue;

    public function __construct($filename) {
        $this->filename = $filename;
        $this->rentals = array();
        $this->parseDocument();
        $this->printData();
    }

    public function startElement($parser, $name, $attr) {
        if (!empty($name)) {
            if ($name == 'rental') {
                // if current element is employee, create new Employee object
                $this->rentalTmp = new Employee();
                if (!empty($attr['rentalID'])) {
                    $this->rentalTmp->setRentalID($attr['rentalID']);
                }
            }
        }
    }

    public function endElement($parser, $name) {
        if ($name == 'rental') {
            $this->rentals[] = $this->rentalTmp;
        } elseif ($name == 'dateOfRental') {
            $this->rentalTmp->setDateOfRental($this->tmpValue);
        } elseif ($name == 'duedate') {
            $this->rentalTmp->setDuedate($this->tmpValue);
        } elseif ($name == 'userID') {
            $this->rentalTmp->setUserID($this->tmpValue);
        }elseif ($name == 'staffID') {
            $this->rentalTmp->setStaffID($this->tmpValue);
        }elseif ($name == 'bookID') {
            $this->rentalTmp->setBookID($this->tmpValue);
        }
    }
    
    private function parseDocument() {
    $parser = xml_parser_create();
    xml_set_element_handler($parser, 
                            array($this, "startElement"), 
                            array($this, "endElement"));
    
    xml_set_character_data_handler($parser, array($this, "characters"));
    
    if (!($handle = fopen($this->filename, "r"))) {
      die("could not open XML input");
    }

    while ($data = fread($handle, 4096)) {
      xml_parse($parser, $data);
    }

  }
  
  public function printData() {
    foreach ($this->rentals as $rent) {
      print $rent . "<br />";
    }
  }

}


