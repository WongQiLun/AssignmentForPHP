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
        if(trim($input)==""){
            return false;
        }
        return true;
    }
}