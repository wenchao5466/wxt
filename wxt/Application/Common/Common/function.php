<?php

function generation_guid_string() {
    $charid = strtolower(md5(uniqid(mt_rand(), true)));
    $hyphen = '';//chr(45);// "-"
    $uuid = ''//chr(123)// "{"
    .substr($charid, 0, 8).$hyphen
    .substr($charid, 8, 4).$hyphen
    .substr($charid,12, 4).$hyphen
    .substr($charid,16, 4).$hyphen
    .substr($charid,20,12)
    ;//.chr(125);// "}"
    return $uuid;
}


function validateMobile($mobilephone){
    //if(preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/",$mobilephone)){    
    if(preg_match("/^1[0-9][0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/",$mobilephone)){    
          return true;

    }else{    
          return false;

    }
}

