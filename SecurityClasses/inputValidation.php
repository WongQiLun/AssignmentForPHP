<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inputValidation
 *
 * @author user
 */
class inputValidation {
    function completionValidation($input){
        if(empty($input)||$input == ""){
            return false;
        }
        return true;
    }
    function stringEquals($input1,$input2){
        if (strcmp($input1 ,$input2)==0){
            return true;
        }
        else 
            return false;
        
    }
    
}
