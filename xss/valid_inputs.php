<?php

    function validName($name) {
        if(preg_match ("/^[a-zA-Z\s]+$/", $name)) return true;
        else {
            createErrorMessage("Invalid Format for Name! Name can only contain letters or spaces!");
            return false;
        }
    }

    function validLocation($location) {
        if(preg_match ("/^[a-zA-Z\s\-]*$/", $location)) return true;
        else {
            createErrorMessage("Invalid Format for Location! Location can only contain letters, spaces or this special charater: -!");
            return false;
        }
    }

    function validDescription($description) {
        if(preg_match ("/^[a-zA-Z\s\-\?!.,\d]*$/", $description)) return true;
        else {
            createErrorMessage("Invalid Format for Description! Description can only contain letters, digits, spaces or this special charaters: -!?.,");
            return false;
        }
    }

    function validUsername($username) {
        if(preg_match ("/^[a-zA-Z_\d]{3,}$/", $username)) return true;
        else {
            createErrorMessage("Invalid Format for Username! Username should have at least 3 charaters and can only contain letters, digits or this special charater: _");
            return false;
        }
    }

    function validPassword($password) {
        if(preg_match ("/^[a-zA-Z_\d]{6,}$/", $password)) return true;
        else {
            createErrorMessage("Invalid Format for Password! Password should have at least 6 charaters and can only contain letters, digits or this special charater: _");
            return false;
        }
    }

?>