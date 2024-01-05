<?php
namespace App\Validation;

class CustomRules{

  // Rule is to validate mobile number digits
  public function mobileValidation(string $str, string $fields, array $data){
    if($data['header']['dial_code'] == '+63'){
        //Philippines

        /*Checking: Number must start from 5-9{Rest Numbers}*/
        if(preg_match( '/^[5-9]{1}[0-9]+/', $data['header']['contact_number'])){
          
          /*Checking: Mobile number must be of 10 digits*/
          $bool = preg_match('/^[0-9]{10}+$/', $data['header']['contact_number']);
          return $bool == 0 ? false : true; 
          
        }else{
          
          return false;
        }//end if
    }else if($data['header']['dial_code'] == '+62'){
        //Indonesia

        /*Checking: Number must start from 5-9{Rest Numbers}*/
        if(preg_match( '/^[1-9]{1}[0-9]+/', $data['header']['contact_number'])){
          
          /*Checking: Mobile number must be of 8 to 10 digits*/
          $bool = preg_match('/^[0-9]{8,10}+$/', $data['header']['contact_number']);
          return $bool == 0 ? false : true; 
          
        }else{
          
          return false;
        }//end if
    }else if($data['header']['dial_code'] == '+66'){
        //Thailand

        /*Checking: Number must start from 5-9{Rest Numbers}*/
        if(preg_match( '/^[6|8|9]{1}[0-9]+/', $data['header']['contact_number'])){
          
          /*Checking: Mobile number must be of 9 digits*/
          $bool = preg_match('/^[0-9]{9}+$/', $data['header']['contact_number']);
          return $bool == 0 ? false : true; 
          
        }else{
          
          return false;
        }//end if
    }else if($data['header']['dial_code'] == '+61'){
        //Australia

        /*Checking: Number must start from 5-9{Rest Numbers}*/
        if(preg_match( '/^[4]{1}[0-9]+/', $data['header']['contact_number'])){
          
          /*Checking: Mobile number must be of 9 digits*/
          $bool = preg_match('/^[0-9]{9}+$/', $data['header']['contact_number']);
          return $bool == 0 ? false : true; 
          
        }else{
          
          return false;
        }//end if
    }else{
        //Other Countries

        /*Checking: Number must start from 5-9{Rest Numbers}*/
        if(preg_match( '/^[0-9]{1}[0-9]+/', $data['header']['contact_number'])){
          
          /*Checking: Mobile number must be of 8 digits*/
          $bool = preg_match('/^[0-9]{8,12}+$/', $data['header']['contact_number']);
          return $bool == 0 ? false : true; 
          
        }else{
          
          return false;
        }//end if
    }//end if
    
  }//end function
  
}//end class