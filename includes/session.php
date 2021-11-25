<?php
// Start the session
session_start();

function session_message(){
    if(isset($_SESSION["message"])){
        $output=htmlentities($_SESSION["message"]);
        
        //after refresh session will be null
        $_SESSION["message"]=null;

        return $output;
    }
}

function errors_message(){
    if(isset($_SESSION["errors"])){
        $errors=$_SESSION["errors"];
        //clear message after use
        $_SESSION["errors"]=null;

        return $errors;
    }
}
?>